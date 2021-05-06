<?php


class SecureEmailRevisionCreated implements SecureEmailBody
{
  /** @var EmailReviewer[] */
  public array $reviewers;

  /**
   * @param EmailReviewer[] $reviewers
   */
  public function __construct(array $reviewers) {
    $this->reviewers = $reviewers;
  }
}