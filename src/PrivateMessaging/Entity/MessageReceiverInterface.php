<?php
namespace PrivateMessaging\Entity;

interface MessageReceiverInterface
{
    const RECEIVED = 1;

    const NOT_RECEIVED = 0;

    public function setId($id);

    public function getId();

    public function setMessageId($messageId);

    public function getMessageId();

    public function setReceiverId($receiverId);

    public function getReceiverId();

    public function setReceivedOrNot($receivedOrNot);

    public function getReceivedOrNot();

    public function isReceived();

    public function setStarredOrNot($starredOrNot);

    public function getStarredOrNot();

    public function isStarred();

    public function setImportantOrNot($importantOrNot);

    public function getImportantOrNot();

    public function isImportant();
}
