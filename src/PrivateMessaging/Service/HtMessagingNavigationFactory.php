<?php

namespace PrivateMessaging\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

class PrivateMessagingNavigationFactory extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'PrivateMessaging';
    }
}