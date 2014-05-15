<?php

namespace PrivateMessaging\Entity;

use DateTime;

class MessageReceiver extends AbstractMessageEntity implements MessageReceiverInterface
{

    protected $messageId;

    protected $receiverId;

    protected $sentDateTime;

    protected $receivedOrNot = self::NOT_RECEIVED;

    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
    }

    public function getMessageId()
    {
        return $this->messageId;
    }

    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function setSentDateTime(DateTime $sentDateTime)
    {
        $this->sentDateTime = $sentDateTime;
    }

    public function getSentDateTime()
    {
        return $this->sentDateTime;
    }

    public function setReceivedOrNot($receivedOrNot)
    {
        $this->receivedOrNot = $receivedOrNot;
    }

    public function getReceivedOrNot()
    {
        return $this->receivedOrNot;
    }

    public function setReceived()
    {
        $this->setReceivedOrNot(static::RECEIVED);
    }

    public function isReceived()
    {
        return $this->getReceivedOrNot() === static::RECEIVED;
    }

}
