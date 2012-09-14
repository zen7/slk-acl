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
		
		'router' => array(
				'routes' => array(
						'access' => array(
								'type' => 'Literal',
								'options' => array(
										'route' => '/access/denied[/]',
										'defaults' => array(
												'__NAMESPACE__' => 'SlkAcl\Controller',
												'controller'    => 'Access',
												'action'        => 'denied',
										),
								),
						),
				)
		),
		
		'controllers' => array(
				'invokables' => array(
						'SlkAcl\Controller\Access' => 'SlkAcl\Controller\AccessController'
				),
		),
		
		'view_manager' => array(
				'template_map' => array(
						'SlkAcl/access/denied' => __DIR__ . '/../view/SlkAcl/access/denied.phtml',
				),
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
		
		
);