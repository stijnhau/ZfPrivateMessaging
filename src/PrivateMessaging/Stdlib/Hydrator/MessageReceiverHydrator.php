<?php

namespace PrivateMessaging\Stdlib\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use PrivateMessaging\Entity\MessageReceiverInterface;
use DateTime;

class MessageReceiverHydrator extends AbstractMessageHydrator
{

    public function hydrate(array $data, $object)
    {
        if (!$object instanceof MessageReceiverInterface) {
            throw new Exception\InvalidClassException('Instance of `PrivateMessaging\Entity\MessageReceiverInterface` expected!');
        }

        return parent::hydrate($data, $object);
    }

    public function extract($message)
    {
        if (!$message instanceof MessageReceiverInterface) {
            throw new Exception\InvalidClassException('Instance of `PrivateMessaging\Entity\MessageReceiverInterface` expected!');
        }

        $data = parent::extract($message);

        unset($data['is_received']);
        unset($data['is_starred']);
        unset($data['is_important']);

        return $data;
    }
}
