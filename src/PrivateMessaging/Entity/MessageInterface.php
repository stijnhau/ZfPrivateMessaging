<?php
namespace PrivateMessaging\Entity;

use DateTime;

interface MessageInterface
{
    public function setId($id);

    public function getId();

    public function setSenderId($senderId);

    public function getSenderId();

    public function setSubject($subject);

    public function getSubject();

    public function setMessageText($messageText);

    public function getMessageText();

    public function setCreatedDateTime(DateTime $createdDateTime);

    public function getCreatedDateTime();
}
