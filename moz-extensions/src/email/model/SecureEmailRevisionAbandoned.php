<?php


class SecureEmailRevisionAbandoned implements SecureEmailBody
{
  /** @var EmailRecipient[] */
  public array $reviewers;
  public int $commentCount;
  public string $transactionLink;

  /**
   * @param EmailRecipient[] $reviewers
   * @param int $commentCount
   * @param string $transactionLink
   */
  public function __construct(array $reviewers, int $commentCount, string $transactionLink) {
    $this->reviewers = $reviewers;
    $this->commentCount = $commentCount;
    $this->transactionLink = $transactionLink;
  }
}