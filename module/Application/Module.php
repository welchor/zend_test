<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;
use Zend\Session\Container;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $sessionManager = new SessionManager();
        $sessionManager->start();



        $application = $e->getParam('application');
        $Session = new Container();
        // $Session->first_name = 'testing';
        // $Session->offsetSet('cart_id', '1234');
        $viewModel = $application->getMvcEvent()->getViewModel();
        $viewModel->setVariable('customer_id', $Session->customer_id);
        $viewModel->setVariable('first_name', $Session->first_name);
		$viewModel->setVariable('cart_id', $Session->cart_id);
		// if (isset($Session->cart_id)) {
		// }
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
}
