<?php

namespace SlkAcl\Service;

use Traversable;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;
use Zend\Permissions\Acl\Acl as ZendAcl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;


/**
 * Acl Service Definition
 * @author slavey
 *
 */
class Acl implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        
        $acl = new ZendAcl();
        
        if (isset($config['slk_acl']['roles']) && is_array($config['slk_acl']['roles'])) {
        	foreach($config['slk_acl']['roles'] as $role=>$parent) {
        		$acl->addRole($role, $parent);
        	}
        }
        
        if (isset($config['slk_acl']['resources']) && is_array($config['slk_acl']['resources'])) {
        	foreach($config['slk_acl']['resources'] as $resource => $parent) {
        		$acl->addResource($resource, $parent);
        	}
        }
        
        
        $rules = @array (
        		'allow'=> $config['slk_acl']['allow'],
        		'deny' => $config['slk_acl']['deny'],
        );
        
        foreach($rules as $method=> $definitions) {
        	if (is_array($definitions)) {
        		foreach($definitions as $definition) {
        			if (isset($definition['role']) && !$acl->hasRole($definition['role'])) {
        				$acl->addRole($definition['role']);
        			}
        			
        			if (isset($definition['resource']) && !$acl->hasResource($definition['resource'])) {
        				$acl->addResource($definition['resource']);
        			}
        			
        			call_user_func_array(array($acl,$method), $definition);
        		}
        	}
        }
                
        return $acl;
    }
}
