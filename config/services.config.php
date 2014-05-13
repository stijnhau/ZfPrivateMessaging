<?php

return array(
    'factories' => array(
        'PrivateMessaging\ModuleOptions' => 'PrivateMessaging\Factory\ModuleOptionsFactory',
        'PrivateMessaging\MessageForm' => 'PrivateMessaging\Factory\MessageFormFactory',
        'PrivateMessaging\MessageMapper' => 'PrivateMessaging\Factory\MessageMapperFactory',
        'PrivateMessaging\MessageReceiverMapper' => 'PrivateMessaging\Factory\MessageReceiverMapperFactory',
        'privatemessaging_user_mapper' => 'PrivateMessaging\Factory\UserMapperFactory',
        'PrivateMessaging\Service\MessagingService' => 'PrivateMessaging\Factory\MessagingServiceFactory',
        'PrivateMessaging_navigation' => 'PrivateMessaging\Service\PrivateMessagingNavigationFactory',
    ),
    'invokables' => array(
        'PrivateMessaging\Service\EmailSender' => 'PrivateMessaging\Service\EmailSender',
    )
);