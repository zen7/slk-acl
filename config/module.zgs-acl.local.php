<?php
/**
 * This is a sample "local" configuration for your application. To use it, copy 
 * it to your config/autoload/ directory of your application, and edit to suit
 * your application.
 *
 *
 */

/*
return array(
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
);

*/