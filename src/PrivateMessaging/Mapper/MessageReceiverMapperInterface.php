<?php

namespace PrivateMessaging\Mapper;

use PrivateMessaging\Entity\MessageInterface;
use PrivateMessaging\Entity\MessageReceiverInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

interface MessageReceiverMapperInterface
{
    public function findById($id);

    public function findByMessageId($messageId);

    public function findByMessage(MessageInterface $message);

    public function findByReceiverId($receiverId, $paginated = false);

    public function findStarredMessagesByReceiverId($receiverId, $paginated = false);

    public function findImportantMessagesByReceiverId($receiverId, $paginated = false);

    public function findUnreadMessagesByReceiverId($receiverId, $paginated = false);

    public function findByReceiverIdAndMessageId($messageId, $receiverId, $joinWithMessage = false);

    public function deleteById($id) ;

    public function remove(MessageReceiverInterface $messageReceiver);
}
