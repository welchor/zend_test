<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Customer;

use Customer\Filter\loginFilter;
use Customer\Form\LoginForm;
use Customer\Filter\RegistrationFilter;
use Customer\Form\RegistrationForm;
use Customer\Model\Customer;
use Customer\Model\CustomerTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;
use Zend\Session\Container;


class Module
{
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

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'CustomerTable' => function ($sm) {
                    $CustomerTableGateway = $sm->get('CustomerTableGateway');
                    return new CustomerTable($CustomerTableGateway);
                },
                'CustomerTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Customer());
                    return new TableGateway('customers', $dbAdapter, null, $resultSetPrototype);
                },
                'Customer' => function () {
                    return new Customer();
                },
                'UserSessionContainer' => function () {
                    return new Container();
                },
                'LoginForm' => function () {
                    return new LoginForm();
                },
                'loginFilter' => function () {
                    return new loginFilter();
                },
                'RegistrationForm' => function () {
                    return new RegistrationForm();
                },
                'RegistrationFilter' => function () {
                    return new RegistrationFilter();
                }
            )
        );
    }
}
