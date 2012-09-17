<?php

return array (
		'zfcuser' => array(
				'user_entity_class' => 'SlkAcl\Entity\User',
		),
		
		'slk_acl' => array (
				'default_guest_role' => 'guest',
				'default_member_role' => 'member',
				'roles' => array (
							'guest' => null,
							'member' => 'guest',
							'admin'  => 'member'
						),
				'resources' => array (
							# 'resource-name' => 'parent-name|null',
						),
				'allow' => array (
							array (
									'role'   => 'guest',
									'resource'=> 'Application\Controller\Index',
									'permission' => 'index'
								  ),
						   array (
						   			'role' => 'guest',
						   			'resource' => 'zfcuser',
						   			'permission' => null, # null
						   		)
				),
				'undefined'    => 'deny', # allow or deny acl rules that are not defined
				'rules'        => array(),
				'log'          => array (
						'file' => '/tmp/slk_acl.log',
						'priority' => Zend\Log\Logger::DEBUG,
				)
		),
		'service_manager' => array (
				'factories' => array (
						'slk_acl_service' => 'SlkAcl\Service\Acl',
						'slk_acl_log_service' => 'SlkAcl\Service\Log',
				) 
		),
		
		'router' => array (
				'routes' => array (
						'slk-acl-access' => array (
								'type' => 'Segment',
								'options' => array (
										'route' => '/access[/:action][/]',
										'constraints' => array (
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*' 
										),
										'defaults' => array (
												'__NAMESPACE__' => 'SlkAcl\Controller\Access',
												'controller' => 'slk-acl-access',
												'action' => 'denied' 
										) 
								),
								'may_terminate' => true,
						)
				) 
		),
		
		'controllers' => array(
				'invokables' => array(
						'slk-acl-access' => 'SlkAcl\Controller\AccessController'
				),
		),
		
		'view_manager' => array(
				'template_map' => array(
						'slk-acl/access/denied' => __DIR__ . '/../view/SlkAcl/access/denied.phtml',
				),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
		
		
);