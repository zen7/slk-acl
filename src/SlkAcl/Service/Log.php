<?php

namespace SlkAcl\Service;

use Traversable;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;
use Zend\Permissions\Acl\Acl as ZendAcl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use Zend\Log\Logger;
use Zend\Log\Writer;
use Zend\Log\Filter;


/**
 * Acl Service Definition
 * @author slavey
 *
 */
class Log implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        
        $config = $services->get('config');
        	
        $log    = new Logger();
        $writer = new Writer\Stream($config['slk_acl']['log']['file']);
        if (isset($config['slk_acl']['log']['priority'])) {
        	$filter = new Filter\Priority($config['slk_acl']['log']['priority']);
        	$writer->addFilter($filter);
        }
        	
        $log->addWriter($writer);
        
        return $log;
    }
}
