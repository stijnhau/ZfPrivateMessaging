<?php

namespace PrivateMessaging\Entity;

use DateTime;

class Message implements MessageInterface
{
    /**
     * @var int id
     */
    protected $id;

    protected $senderId;

    protected $subject;

    protected $messageText;

    protected $createdDateTime;

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;
    }

    public function getMessageText()
    {
        return $this->messageText;
    }

    public function setCreatedDateTime(DateTime $createdDateTime)
    {
        $this->createdDateTime = $createdDateTime;
    }

    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

}
