<?php

final class FeedForEmailQueryAPIMethod extends ConduitAPIMethod {
  private static $DEFAULT_LIMIT = 100;

  public function getAPIMethodName() {
    return 'feed.for_email.query';
  }

  public function getMethodDescription() {
    return 'Query the feed for events that trigger email notifications';
  }

  protected function defineParamTypes() {
    return array(
      'storyLimit' => 'optional int (default ' . self::$DEFAULT_LIMIT . ')',
      'after' => 'string',
    );
  }

  protected function defineReturnType() {
    return 'list';
  }

  public function getMethodStatus() {
    return self::METHOD_STATUS_UNSTABLE;
  }

  protected function execute(ConduitAPIRequest $request) {
    EmailAPIAuthorization::assert($request->getUser());

    $limit = $request->getValue('storyLimit') ?? self::$DEFAULT_LIMIT;
    $after = $request->getValue('after');
    $storyErrors = 0;

    $bugStore = new BugStore();
    $diffStore = new PhabricatorDiffStore();
    $userStore = new PhabricatorUserStore();
    $reviewerStore = new PhabricatorReviewerStore($userStore);

    $result = PhabricatorStory::queryStories($userStore, $limit, $after);
    $emailEvents = [];
    foreach ($result->stories as $story) {
      try {
        $rawRevision = $story->revision;

        /** @var array $revisionProjects */
        $revisionProjects = PhabricatorEdgeQuery::loadDestinationPHIDs(
          $rawRevision->getPHID(),
          PhabricatorProjectObjectHasProjectEdgeType::EDGECONST
        );

        if (!$revisionProjects) {
          $isSecure = false;
        } else {
          $secureTag = (new PhabricatorProjectQuery())
            ->setViewer(PhabricatorUser::getOmnipotentUser())
            ->withNames(['secure-revision'])
            ->executeOne();
          $isSecure = in_array($secureTag->getPHID(), $revisionProjects);
        }

        $actorEmail = $story->actor->loadPrimaryEmailAddress();
        $resolveRecipients = new ResolveUsers($rawRevision, $actorEmail, $userStore, $reviewerStore);
        $resolveComments = new ResolveComments($story->transactions, $rawRevision, $userStore);
        $resolveCodeChange = new ResolveCodeChange($story->transactions, $rawRevision, $diffStore);
        $resolveRevisionStatus = new ResolveRevisionStatus($rawRevision);

        // I don't really like this stateful-ness (using $securePings in the "if ($isSecure)" blocks, using
        // $publicPings in the "else {}" down below). However, I don't want to duplicate the big
        // "if ($eventKind->publicKind == ...)" tree.
        // We _could_ do some magic where we add a
        // "static function build($resolveRecipients, $resolveComments, ...): EventClass" to each event, then
        // reflect on the EventKind to dynamically call this static method. However, this would be pretty "magical" and
        // hard to understand, so  I'm not sure it's worth doing to remove this small bit of method state.
        if ($isSecure) {
          $securePings = new SecureEventPings();
        } else {
          $publicPings = new PublicEventPings();
        }

        $eventKind = $story->eventKind;
        if ($eventKind->publicKind == EventKind::$ABANDON) {
          if ($isSecure) {
            $comments = $resolveComments->resolveSecureComments($securePings);
            $body = new SecureEmailRevisionAbandoned(
              $resolveRecipients->resolveReviewersAsRecipients(),
              $comments->count,
              $story->getTransactionLink()
            );
          } else {
            $comments = $resolveComments->resolvePublicComments($publicPings);
            $body = new EmailRevisionAbandoned(
              $comments->mainCommentMessage,
              $comments->inlineComments,
              $story->getTransactionLink(),
              $resolveRecipients->resolveReviewersAsRecipients()
            );
          }
        } else if ($eventKind->publicKind == EventKind::$RECLAIM) {
          $reviewers = $reviewers = $resolveRecipients->resolveReviewers(true);
          if ($isSecure) {
            $comments = $resolveComments->resolveSecureComments($securePings);
            $body = new SecureEmailRevisionReclaimed(
              $reviewers,
              $comments->count,
              $story->getTransactionLink()
            );
          } else {
            $comments = $resolveComments->resolvePublicComments($publicPings);
            $body = new EmailRevisionReclaimed(
              $comments->mainCommentMessage,
              $comments->inlineComments,
              $story->getTransactionLink(),
              $reviewers
            );
          }
        } else if ($eventKind->publicKind == EventKind::$COMMENT) {
          if ($isSecure) {
            $resolveComments->resolveSecureComments($securePings);
            $body = new SecureEmailRevisionCommented(
              $resolveRecipients->resolveReviewersAsRecipients(),
              $resolveRecipients->resolveAuthorAsRecipient(),
              $story->getTransactionLink()
            );
          } else {
            $comments = $resolveComments->resolvePublicComments($publicPings);
            $body = new EmailRevisionCommented(
              $story->getTransactionLink(),
              $comments->mainCommentMessage,
              $comments->inlineComments,
              $resolveRecipients->resolveReviewersAsRecipients(),
              $resolveRecipients->resolveAuthorAsRecipient()
            );
          }
        } else if ($eventKind->publicKind == EventKind::$CLOSE) {
          if ($isSecure) {
            $comments = $resolveComments->resolveSecureComments($securePings);
            $body = new SecureEmailRevisionLanded(
              $resolveRecipients->resolveReviewersAsRecipients(),
              $resolveRecipients->resolveAuthorAsRecipient(),
              $comments->count,
              $story->getTransactionLink()
            );
          } else {
            $comments = $resolveComments->resolvePublicComments($publicPings);
            $body = new EmailRevisionLanded(
              $comments->mainCommentMessage,
              $comments->inlineComments,
              $story->getTransactionLink(),
              $resolveRecipients->resolveReviewersAsRecipients(),
              $resolveRecipients->resolveAuthorAsRecipient()
            );
          }
        } else if ($eventKind->publicKind == EventKind::$REJECT) {
          if ($isSecure) {
            $comments = $resolveComments->resolveSecureComments($securePings);
            $body = new SecureEmailRevisionRequestedChanges(
              $story->getTransactionLink(),
              $resolveRecipients->resolveReviewersAsRecipients(),
              $resolveRecipients->resolveAuthorAsRecipient(),
              $comments->count
            );
          } else {
            $comments = $resolveComments->resolvePublicComments($publicPings);
            $body = new EmailRevisionRequestedChanges(
              $story->getTransactionLink(),
              $comments->mainCommentMessage,
              $comments->inlineComments,
              $resolveRecipients->resolveReviewersAsRecipients(),
              $resolveRecipients->resolveAuthorAsRecipient()
            );
          }
        } else if ($eventKind->publicKind == EventKind::$REQUEST_REVIEW) {
          $reviewers = $resolveRecipients->resolveReviewers(true);
          if ($isSecure) {
            $comments = $resolveComments->resolveSecureComments($securePings);
            $body = new SecureEmailRevisionRequestedReview(
              $reviewers,
              $comments->count,
              $story->getTransactionLink()
            );
          } else {
            $comments = $resolveComments->resolvePublicComments($publicPings);
            $body = new EmailRevisionRequestedReview(
              $comments->mainCommentMessage,
              $comments->inlineComments,
              $story->getTransactionLink(),
              $reviewers
            );
          }
        } else if ($eventKind->publicKind == EventKind::$CREATE) {
          $reviewers = $resolveRecipients->resolveReviewers(true);
          if ($isSecure) {
            $body = new SecureEmailRevisionCreated($reviewers);
          } else {
            $body = new EmailRevisionCreated($resolveCodeChange->resolveAffectedFiles(), $reviewers);
          }
        } else if ($eventKind->publicKind == EventKind::$ACCEPT) {
          if ($isSecure) {
            $comments = $resolveComments->resolveSecureComments($securePings);
            $body = new SecureEmailRevisionAccepted(
              $resolveRevisionStatus->resolveLandoLink(),
              $resolveRevisionStatus->resolveIsReadyToLand(),
              $resolveRecipients->resolveReviewersAsRecipients(),
              $resolveRecipients->resolveAuthorAsRecipient(),
              $comments->count,
              $story->getTransactionLink()
            );
          } else {
            $comments = $resolveComments->resolvePublicComments($publicPings);
            $body = new EmailRevisionAccepted(
              $comments->mainCommentMessage,
              $comments->inlineComments,
              $story->getTransactionLink(),
              $resolveRevisionStatus->resolveLandoLink(),
              $resolveRevisionStatus->resolveIsReadyToLand(),
              $resolveRecipients->resolveReviewersAsRecipients(),
              $resolveRecipients->resolveAuthorAsRecipient()
            );
          }
        } else if ($eventKind->publicKind == EventKind::$UPDATE) {
          $reviewers = $resolveRecipients->resolveReviewers($resolveRevisionStatus->resolveIsNeedingReview());
          if ($isSecure) {
            $body = new SecureEmailRevisionUpdated(
              $resolveRevisionStatus->resolveLandoLink(),
              $resolveCodeChange->resolveNewChangesLink(),
              $resolveRevisionStatus->resolveIsReadyToLand(),
              $reviewers
            );
          } else {
            $body = new EmailRevisionUpdated(
              $resolveCodeChange->resolveAffectedFiles(),
              $resolveRevisionStatus->resolveLandoLink(),
              $resolveCodeChange->resolveNewChangesLink(),
              $resolveRevisionStatus->resolveIsReadyToLand(),
              $reviewers
            );
          }
        } else if ($eventKind->publicKind == EventKind::$METADATA_EDIT) {
          // There's no secret information in this event itself, so we don't differentiate
          // between "secure" and "insecure" variants
          $body = SecureEmailRevisionMetadataEdited::from(
            $resolveRecipients,
            $resolveRevisionStatus,
            $story->transactions,
            $rawRevision,
            $reviewerStore,
            $actorEmail
          );
        } else {
          continue;
        }

        $createSecureEmail = function($kind, $body) use ($story, $rawRevision, $bugStore) {
          return new SecureEmailEvent($kind, $story->actor->getUserName(), $rawRevision, $body, $bugStore, $story->key, $story->timestamp);
        };
        $createPublicEmail = function($kind, $body) use ($story, $rawRevision, $bugStore) {
          return new EmailEvent($kind, $story->actor->getUserName(), EmailRevision::from($rawRevision, $bugStore), $body, $story->key, $story->timestamp);
        };

        if ($isSecure) {
          $emailEvents[] = $createSecureEmail($eventKind->publicKind, $body);
          foreach ($securePings->intoBodies($actorEmail, $story->getTransactionLink()) as $body) {
            $emailEvents[] = $createSecureEmail(EventKind::$PINGED, $body);
          }
        } else {
          $emailEvents[] = $createPublicEmail($eventKind->publicKind, $body);
          foreach ($publicPings->intoBodies($actorEmail, $story->getTransactionLink()) as $body) {
            $emailEvents[] = $createPublicEmail(EventKind::$PINGED, $body);
          }
        }
      }
      catch (Throwable $e) {
        // Report error to sentry, but attempt to recover and continue sending email events that don't cause exceptions
        SentryLoggerPlugin::handleError(PhutilErrorHandler::EXCEPTION, $e, []);
        error_log($e);
        $storyErrors++;
      }
    }

    $response = new EmailEndpointResponse(
      new EmailEndpointResponseData($emailEvents, $storyErrors),
      new EmailEndpointResponseCursor($limit, $result->lastKey)
    );
    return json_encode($response);
  }


}

