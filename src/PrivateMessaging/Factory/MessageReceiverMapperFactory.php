<?php

namespace PrivateMessaging\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use PrivateMessaging\Mapper\MessageReceiverMapper;
use PrivateMessaging\Stdlib\Hydrator\MessageReceiverHydrator;

class MessageReceiverMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('PrivateMessaging\ModuleOptions');
        $mapper = new MessageReceiverMapper();
        $mapper->setDbAdapter($serviceLocator->get('PrivateMessaging\DbAdapter'));
        $entityClass = $options->getMessageReceiverEntityClass();
        $mapper->setEntityPrototype(new $entityClass);
        $mapper->setHydrator(new MessageReceiverHydrator);

        return $mapper;        
    }   
}
