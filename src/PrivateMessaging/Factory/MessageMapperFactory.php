<?php

namespace PrivateMessaging\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use PrivateMessaging\Mapper\MessageMapper;
use PrivateMessaging\Stdlib\Hydrator\MessageHydrator;

class MessageMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('PrivateMessaging\ModuleOptions');
        $mapper = new MessageMapper();
        $mapper->setDbAdapter($serviceLocator->get('PrivateMessaging\DbAdapter'));
        $entityClass = $options->getMessageEntityClass();
        $mapper->setEntityPrototype(new $entityClass);
        $mapper->setHydrator(new MessageHydrator);
        $mapper->setSortDirection($options->getSortDirection());

        return $mapper;
    }
}
