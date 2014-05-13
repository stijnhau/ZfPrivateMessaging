<?php
namespace HtMessaging;

use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', MvcEvent::EVENT_DISPATCH, function($e) use ($sm) {
            $controller      = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            if ($moduleNamespace === __NAMESPACE__ && !$sm->get('zfcuser_auth_service')->hasIdentity()) {
                return $controller->plugin("redirect")->toRoute($sm->get('HtMessaging\ModuleOptions')->getLoginRoute());
            }
        }, 100);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return include __DIR__ . '/config/services.config.php';
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'htSmartTime'           => 'HtMessaging\View\Helper\SmartTime',
                'htmessagingComparer'   => 'HtMessaging\View\Helper\Comparer',
                'menu_helper'           => 'HtMessaging\View\Helper\Menuhelper'
            )
        );
    }
}
