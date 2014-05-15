<?php

namespace PrivateMessaging\Stdlib\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use PrivateMessaging\Entity\MessageInterface;
use DateTime;

class MessageHydrator extends AbstractMessageHydrator
{

    public function hydrate(array $data, $object)
    {
        if (!$object instanceof MessageInterface) {
            throw new Exception\InvalidClassException('Instance of `PrivateMessaging\Entity\MessageInterface` expected!');
        }

        $data['created_date_time'] = new DateTime($data['created_date_time']);

        return parent::hydrate($data, $object);
    }

    public function extract($message)
    {
        if (!$message instanceof MessageInterface) {
            throw new Exception\InvalidClassException('Instance of `PrivateMessaging\Entity\MessageInterface` expected!');
        }

        $data = parent::extract($message);

        $data['created_date_time'] = $data['created_date_time']->format(static::DATETIME_MYSQL);

        unset($data['is_starred']);
        unset($data['is_important']);

        return $data;
    }
}
