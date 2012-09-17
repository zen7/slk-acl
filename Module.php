<?php

namespace SlkAcl;

use Traversable;
use Zend\Mvc\MvcEvent;
use Zend\Permissions\Acl\Exception\ExceptionInterface;
use Zend\Stdlib\ArrayUtils;

use SlkAcl\Entity\User;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    /*
    
    /**
     * After the route is evaluated attach an event to check if the acl allows it
     * @param unknown_type $event
     */
    public function onBootstrap($event) 
    {
    	$application = $event->getTarget();
    	$manager = $application->getEventManager();
    	$manager->attach('route', array($this, 'onRoutePost'), -100);
    }
    
    /**
     * Checks if the current user is allowed to access the current controller and action
     * @param unknown_type $event
     */
    public function onRoutePost(MvcEvent $event) 
    {
    	$matches = $event->getRouteMatch();
    	if(!$matches) {
    		return;
    	}
    	
    	$controller = $matches->getParam('controller');
    	$action     = $matches->getParam('action');
    	
    	$application = $event->getTarget();
    	$services = $application->getServiceManager();
    	$auth = $services->get('zfcuser_auth_service');
    	
    	$config  = $services->get('config');
    	if ($config instanceof Traversable) {
    		$config = ArrayUtils::iteratorToArray($config);
    	}
    	
    	$role = $config['slk_acl']['default_guest_role'];
    	if ($auth->hasIdentity()) {
    		$user = $auth->getIdentity();
    		if (!$user instanceof User) {
    			throw new \DomainException("Invalid user");	
    		}
    		
    		$role = $user->getRole();
    		if (empty($role)) {
    			$role = $config['slk_acl']['default_member_role'];
    		}
    	}
    	
    	$acl = $services->get('slk_acl_service');
    	try {
    		$isAllowed = $acl->isAllowed($role, $controller, $action);
    	}
    	catch(ExceptionInterface $ex) {
    		if ($config['slk_acl']['undefined'] == 'allow') {
    			$isAllowed = true;
    		}
    		else {
    			$log = $services->get('slk_acl_log_service');
    			$log->warn('Acl rule failed with error:'.$ex->getMessage());
    			$isAllowed = false;
    		}
    	} 
    	
    	if (!$isAllowed) {
    		$response = $event->getResponse();
    		$response->setStatusCode(401);
    		
    		$matches->setParam('controller','slk-acl-access');
    		$matches->setParam('action','denied');
    		
    		return ;
    	}
    }
}
