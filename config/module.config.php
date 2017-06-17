<?php
namespace PrivateMessaging;

use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;

return array(
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),

    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                __DIR__ . '/../public',
            ),
        ),
    ),
    'service_manager' => array(
        'aliases' => array(
            'PrivateMessaging\DbAdapter' => 'zfcuser_zend_db_adapter'
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'privatemessaging' => 'PrivateMessaging\Controller\MessagingController',
        )
    ),
    'router' => array(
        'routes' => array(
            'privatemessaging' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/messaging',
                    'defaults' => array(
                        'controller' => 'privatemessaging',
                        'action' => 'list'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'list' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route' => '/:type[/][page/:page[/]]',
                        ),
                        'defaults' => array(
                            'type' => 'inbox',
                            'page' => 1
                        )
                    ),
                    'compose' => array(
                        'type' => Literal::class,
                        'options' => array(
                            'route' => '/compose',
                            'defaults' => array(
                                'action' => 'compose'
                            )
                        )
                    ),
                    'info' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route' => '/:message_id',
                            'defaults' => array(
                                'action' => 'info'
                            ),
                            'constraints' => array(
                                'message_id' => '[0-9]*'
                            ),
                        )
                    ),
                    'delete_receiver' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route' => '/delete-receiver/:message_id[/]',
                            'defaults' => array(
                                'action' => 'deleteReceiver'
                            )
                        )
                    ),
                    'delete_sender' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route' => '/delete-sender/:message_id[/]',
                            'defaults' => array(
                                'action' => 'deleteSender'
                            )
                        )
                    ),
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'PrivateMessaging' => __DIR__."/../view/"
        )
    )

);
