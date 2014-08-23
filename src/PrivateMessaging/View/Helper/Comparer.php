<?php

namespace PrivateMessaging\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ArrayObject;
use PrivateMessaging\Entity\AbstractMessageEntity;
use PrivateMessaging\Entity\MessageReceiverInterface;

class Comparer extends AbstractHelper
{
    public function isReceived(ArrayObject $message)
    {
        return isset($message->received_or_not) && $message->received_or_not == MessageReceiverInterface::RECEIVED;
    }

    public function isStarred(ArrayObject $message)
    {
        return isset($message->starred_or_not) && $message->starred_or_not == AbstractMessageEntity::STARRED;
    }

    public function isImportant(ArrayObject $message)
    {
        return isset($message->important_or_not) && $message->important_or_not == AbstractMessageEntity::IMPORTANT;
    }
}
