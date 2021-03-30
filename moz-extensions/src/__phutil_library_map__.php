<?php

/**
 * This file is automatically generated. Use 'arc liberate' to rebuild it.
 *
 * @generated
 * @phutil-library-version 2
 */
phutil_register_library_map(array(
  '__library_version__' => 2,
  'class' => array(
    'BMOExternalAccountSearchConduitAPIMethod' => 'conduit/BMOExternalAccountSearchConduitAPIMethod.php',
    'BugStore' => 'email/adapter/BugStore.php',
    'BugzillaAccountSearchConduitAPIMethod' => 'conduit/BugzillaAccountSearchConduitAPIMethod.php',
    'CreatePolicyConduitAPIMethod' => 'conduit/CreatePolicyConduitAPIMethod.php',
    'DifferentialBugzillaBugIDCommitMessageField' => 'differential/customfield/DifferentialBugzillaBugIDCommitMessageField.php',
    'DifferentialBugzillaBugIDCustomFieldTestCase' => 'differential/customfield/__tests__/DifferentialBugzillaIdCustomFieldTestCase.php',
    'DifferentialBugzillaBugIDField' => 'differential/customfield/DifferentialBugzillaBugIDField.php',
    'DifferentialBugzillaBugIDValidator' => 'differential/customfield/DifferentialBugzillaBugIDValidator.php',
    'DifferentialRevisionWarning' => 'differential/view/DifferentialRevisionWarning.php',
    'EmailAPIAuthorization' => 'email/EmailAPIAuthorization.php',
    'EmailAffectedFile' => 'email/model/EmailAffectedFile.php',
    'EmailBug' => 'email/model/EmailBug.php',
    'EmailCodeContext' => 'email/model/EmailCodeContext.php',
    'EmailCommentMessage' => 'email/model/EmailCommentMessage.php',
    'EmailDiffLine' => 'email/model/EmailDiffLine.php',
    'EmailEndpointResponse' => 'email/model/EmailEndpointResponse.php',
    'EmailEndpointResponseCursor' => 'email/model/EmailEndpointResponseCursor.php',
    'EmailEndpointResponseData' => 'email/model/EmailEndpointResponseData.php',
    'EmailEvent' => 'email/model/EmailEvent.php',
    'EmailInlineComment' => 'email/model/EmailInlineComment.php',
    'EmailMetadataEditedReviewer' => 'email/model/EmailMetadataEditedReviewer.php',
    'EmailRecipient' => 'email/model/EmailRecipient.php',
    'EmailReplyContext' => 'email/model/EmailReplyContext.php',
    'EmailReviewer' => 'email/model/EmailReviewer.php',
    'EmailRevision' => 'email/model/EmailRevision.php',
    'EmailRevisionAbandoned' => 'email/model/EmailRevisionAbandoned.php',
    'EmailRevisionAccepted' => 'email/model/EmailRevisionAccepted.php',
    'EmailRevisionCommentPinged' => 'email/model/EmailRevisionCommentPinged.php',
    'EmailRevisionCommented' => 'email/model/EmailRevisionCommented.php',
    'EmailRevisionCreated' => 'email/model/EmailRevisionCreated.php',
    'EmailRevisionLanded' => 'email/model/EmailRevisionLanded.php',
    'EmailRevisionReclaimed' => 'email/model/EmailRevisionReclaimed.php',
    'EmailRevisionRequestedChanges' => 'email/model/EmailRevisionRequestedChanges.php',
    'EmailRevisionRequestedReview' => 'email/model/EmailRevisionRequestedReview.php',
    'EmailRevisionUpdated' => 'email/model/EmailRevisionUpdated.php',
    'EventKind' => 'email/adapter/EventKind.php',
    'ExternalAccountsSearchEngineAttachment' => 'conduit/ExternalAccountsSearchEngineAttachment.php',
    'ExternalAccountsSearchEngineExtension' => 'conduit/ExternalAccountsSearchEngineExtension.php',
    'FeedForEmailQueryAPIMethod' => 'email/FeedForEmailQueryAPIMethod.php',
    'FeedForEmailStatusAPIMethod' => 'email/FeedForEmailStatusAPIMethod.php',
    'FeedQueryIDConduitAPIMethod' => 'conduit/FeedQueryIDConduitAPIMethod.php',
    'GroupPhabricatorReviewer' => 'email/adapter/GroupPhabricatorReviewer.php',
    'LandoLinkEventListener' => 'lando/events/LandoLinkEventListener.php',
    'MinimalEmailContext' => 'email/model/MinimalEmailContext.php',
    'MinimalEmailRevision' => 'email/model/MinimalEmailRevision.php',
    'MozLogger' => 'logging/MozLogger.php',
    'MozillaExtraReviewerDataSearchEngineAttachment' => 'differential/conduit/MozillaExtraReviewerDataSearchEngineAttachment.php',
    'MozillaMOTD' => 'motd/view/MozillaMOTD.php',
    'MozillaMOTDConfigOptions' => 'motd/config/MozillaMOTDConfigOptions.php',
    'MozillaSearchEngineExtension' => 'differential/conduit/MozillaSearchEngineExtension.php',
    'NewChangesLinkEventListener' => 'differential/events/NewChangesLinkEventListener.php',
    'PhabricatorBMOAuthProvider' => 'auth/provider/PhabricatorBMOAuthProvider.php',
    'PhabricatorBugzillaConfigOptions' => 'bugzilla/config/PhabricatorBugzillaConfigOptions.php',
    'PhabricatorDiffStore' => 'email/adapter/PhabricatorDiffStore.php',
    'PhabricatorDifferentialReviewersPolicyRule' => 'differential/policyrule/PhabricatorDifferentialReviewersPolicyRule.php',
    'PhabricatorEmailConfigOptions' => 'email/config/PhabricatorEmailConfigOptions.php',
    'PhabricatorFeedIDQuery' => 'feed/query/PhabricatorFeedIDQuery.php',
    'PhabricatorLandoConfigOptions' => 'lando/config/PhabricatorLandoConfigOptions.php',
    'PhabricatorReviewer' => 'email/adapter/PhabricatorReviewer.php',
    'PhabricatorStory' => 'email/adapter/PhabricatorStory.php',
    'PhabricatorStoryBuilder' => 'email/adapter/PhabricatorStoryBuilder.php',
    'PhabricatorUserStore' => 'email/adapter/PhabricatorUserStore.php',
    'PhutilBMOAuthAdapter' => 'auth/adapter/PhutilBMOAuthAdapter.php',
    'PolicyQueryConduitAPIMethod' => 'conduit/PolicyQueryConduitAPIMethod.php',
    'PublicEmailBody' => 'email/model/PublicEmailBody.php',
    'PublicEmailContext' => 'email/model/PublicEmailContext.php',
    'PublicEventPings' => 'email/adapter/PublicEventPings.php',
    'PublicPing' => 'email/adapter/PublicPing.php',
    'PublicRevisionComments' => 'email/adapter/PublicRevisionComments.php',
    'ResolveCodeChange' => 'email/resolve/ResolveCodeChange.php',
    'ResolveComments' => 'email/resolve/ResolveComments.php',
    'ResolveRevisionStatus' => 'email/resolve/ResolveRevisionStatus.php',
    'ResolveUsers' => 'email/resolve/ResolveUsers.php',
    'ReviewersTransaction' => 'email/adapter/ReviewersTransaction.php',
    'RevisionCreatedHeuristic' => 'email/adapter/RevisionCreatedHeuristic.php',
    'SecureEmailBody' => 'email/model/SecureEmailBody.php',
    'SecureEmailBug' => 'email/model/SecureEmailBug.php',
    'SecureEmailContext' => 'email/model/SecureEmailContext.php',
    'SecureEmailRevision' => 'email/model/SecureEmailRevision.php',
    'SecureEmailRevisionAbandoned' => 'email/model/SecureEmailRevisionAbandoned.php',
    'SecureEmailRevisionAccepted' => 'email/model/SecureEmailRevisionAccepted.php',
    'SecureEmailRevisionCommentPinged' => 'email/model/SecureEmailRevisionCommentPinged.php',
    'SecureEmailRevisionCommented' => 'email/model/SecureEmailRevisionCommented.php',
    'SecureEmailRevisionCreated' => 'email/model/SecureEmailRevisionCreated.php',
    'SecureEmailRevisionLanded' => 'email/model/SecureEmailRevisionLanded.php',
    'SecureEmailRevisionMetadataEdited' => 'email/model/SecureEmailRevisionMetadataEdited.php',
    'SecureEmailRevisionReclaimed' => 'email/model/SecureEmailRevisionReclaimed.php',
    'SecureEmailRevisionRequestedChanges' => 'email/model/SecureEmailRevisionRequestedChanges.php',
    'SecureEmailRevisionRequestedReview' => 'email/model/SecureEmailRevisionRequestedReview.php',
    'SecureEmailRevisionUpdated' => 'email/model/SecureEmailRevisionUpdated.php',
    'SecureEventPings' => 'email/adapter/SecureEventPings.php',
    'SecureRevisionComments' => 'email/adapter/SecureRevisionComments.php',
    'SentryConfigOptions' => 'logging/SentryConfigOptions.php',
    'SentryLoggerPlugin' => 'logging/SentryLoggerPlugin.php',
    'StoryQueryResult' => 'email/adapter/StoryQueryResult.php',
    'TransactionList' => 'email/adapter/TransactionList.php',
    'UserPhabricatorReviewer' => 'email/adapter/UserPhabricatorReviewer.php',
  ),
  'function' => array(
    'isRevisionPrivate' => 'differential/view/DifferentialRevisionWarning.php',
  ),
  'xmap' => array(
    'BMOExternalAccountSearchConduitAPIMethod' => 'UserConduitAPIMethod',
    'BugzillaAccountSearchConduitAPIMethod' => 'UserConduitAPIMethod',
    'CreatePolicyConduitAPIMethod' => 'ConduitAPIMethod',
    'DifferentialBugzillaBugIDCommitMessageField' => 'DifferentialCommitMessageCustomField',
    'DifferentialBugzillaBugIDCustomFieldTestCase' => 'PhabricatorTestCase',
    'DifferentialBugzillaBugIDField' => 'DifferentialStoredCustomField',
    'DifferentialBugzillaBugIDValidator' => 'Phobject',
    'DifferentialRevisionWarning' => 'Phobject',
    'EmailRevisionAbandoned' => 'PublicEmailBody',
    'EmailRevisionAccepted' => 'PublicEmailBody',
    'EmailRevisionCommentPinged' => 'PublicEmailBody',
    'EmailRevisionCommented' => 'PublicEmailBody',
    'EmailRevisionCreated' => 'PublicEmailBody',
    'EmailRevisionLanded' => 'PublicEmailBody',
    'EmailRevisionReclaimed' => 'PublicEmailBody',
    'EmailRevisionRequestedChanges' => 'PublicEmailBody',
    'EmailRevisionRequestedReview' => 'PublicEmailBody',
    'EmailRevisionUpdated' => 'PublicEmailBody',
    'ExternalAccountsSearchEngineAttachment' => 'PhabricatorSearchEngineAttachment',
    'ExternalAccountsSearchEngineExtension' => 'PhabricatorSearchEngineExtension',
    'FeedForEmailQueryAPIMethod' => 'ConduitAPIMethod',
    'FeedForEmailStatusAPIMethod' => 'ConduitAPIMethod',
    'FeedQueryIDConduitAPIMethod' => 'FeedQueryConduitAPIMethod',
    'GroupPhabricatorReviewer' => 'PhabricatorReviewer',
    'LandoLinkEventListener' => 'PhabricatorEventListener',
    'MozLogger' => 'Phobject',
    'MozillaExtraReviewerDataSearchEngineAttachment' => 'PhabricatorSearchEngineAttachment',
    'MozillaMOTD' => 'Phobject',
    'MozillaMOTDConfigOptions' => 'PhabricatorApplicationConfigOptions',
    'MozillaSearchEngineExtension' => 'PhabricatorSearchEngineExtension',
    'NewChangesLinkEventListener' => 'PhabricatorEventListener',
    'PhabricatorBMOAuthProvider' => 'PhabricatorOAuth2AuthProvider',
    'PhabricatorBugzillaConfigOptions' => 'PhabricatorApplicationConfigOptions',
    'PhabricatorDifferentialReviewersPolicyRule' => 'PhabricatorPolicyRule',
    'PhabricatorEmailConfigOptions' => 'PhabricatorApplicationConfigOptions',
    'PhabricatorFeedIDQuery' => 'PhabricatorFeedQuery',
    'PhabricatorLandoConfigOptions' => 'PhabricatorApplicationConfigOptions',
    'PhutilBMOAuthAdapter' => 'PhutilOAuthAuthAdapter',
    'PolicyQueryConduitAPIMethod' => 'ConduitAPIMethod',
    'SecureEmailRevisionAbandoned' => 'SecureEmailBody',
    'SecureEmailRevisionAccepted' => 'SecureEmailBody',
    'SecureEmailRevisionCommentPinged' => 'SecureEmailBody',
    'SecureEmailRevisionCommented' => 'SecureEmailBody',
    'SecureEmailRevisionCreated' => 'SecureEmailBody',
    'SecureEmailRevisionLanded' => 'SecureEmailBody',
    'SecureEmailRevisionMetadataEdited' => array(
      'SecureEmailBody',
      'PublicEmailBody',
    ),
    'SecureEmailRevisionReclaimed' => 'SecureEmailBody',
    'SecureEmailRevisionRequestedChanges' => 'SecureEmailBody',
    'SecureEmailRevisionRequestedReview' => 'SecureEmailBody',
    'SecureEmailRevisionUpdated' => 'SecureEmailBody',
    'SentryConfigOptions' => 'PhabricatorApplicationConfigOptions',
    'SentryLoggerPlugin' => 'Phobject',
    'UserPhabricatorReviewer' => 'PhabricatorReviewer',
  ),
));
