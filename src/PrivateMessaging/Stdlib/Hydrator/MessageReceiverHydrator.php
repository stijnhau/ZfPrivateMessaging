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

        $data['sent_date_time'] = new DateTime($data['sent_date_time']);

        return parent::hydrate($data, $object);
    }

    public function extract($message)
    {
        if (!$message instanceof MessageReceiverInterface) {
            throw new Exception\InvalidClassException('Instance of `PrivateMessaging\Entity\MessageReceiverInterface` expected!');
        }

        $data = parent::extract($message);

        $data['sent_date_time'] = $data['sent_date_time']->format(static::DATETIME_MYSQL);

        unset($data['is_received']);
        unset($data['is_starred']);
        unset($data['is_important']);

        return $data;
    }
}
