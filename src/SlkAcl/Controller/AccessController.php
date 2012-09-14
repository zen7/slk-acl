<?php

namespace SlkAcl\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AccessController extends AbstractActionController
{
    public function deniedAction()
    {
        return array();
    }    
}
