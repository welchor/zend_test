<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Product;

use Product\Filter\ShippingFilter;
use Product\Form\ShippingForm;
use Product\Filter\addCartFilter;
use Product\Form\addCartForm;
use Product\Model\Product;
use Product\Model\ProductTable;
use Product\Model\Cart;
use Product\Model\CartTable;
use Product\Model\JobTable;
use Product\Model\JobItemTable;
use Product\Model\CartItemTable;
use Product\Model\ShippingTable;
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
                'ProductTable' => function ($sm) {
                    $ProductTableGateway = $sm->get('ProductTableGateway');
                    return new ProductTable($ProductTableGateway);
                },
                'ProductTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Product());
                    return new TableGateway('products', $dbAdapter, null, $resultSetPrototype);
                },
                'Product' => function () {
                    return new Product();
                },
				'CartTable' => function ($sm) {
					$CartTableGateway = $sm->get('CartTableGateway');
					return new CartTable($CartTableGateway);
				},
				'CartTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Cart());
                    return new TableGateway('carts', $dbAdapter, null, $resultSetPrototype);
                },
                'JobTable' => function ($sm) {
                    $JobTableGateway = $sm->get('JobTableGateway');
                    return new JobTable($JobTableGateway);
                },
                'JobTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Cart());
                    return new TableGateway('job_orders', $dbAdapter, null, $resultSetPrototype);
                },
				'JobItemTable' => function ($sm) {
                    $JobItemTableGateway = $sm->get('JobItemTableGateway');
                    return new JobItemTable($JobItemTableGateway);
                },
                'JobItemTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Cart());
                    return new TableGateway('job_items', $dbAdapter, null, $resultSetPrototype);
                },
                'ShippingTable' => function ($sm) {
                    $ShippingTableGateway = $sm->get('ShippingTableGateway');
                    return new ShippingTable($ShippingTableGateway);
                },
                'ShippingTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Cart());
                    return new TableGateway('shipping', $dbAdapter, null, $resultSetPrototype);
                },
                'CartItemTable' => function ($sm) {
                    $CartItemTableGateway = $sm->get('CartItemTableGateway');
                    return new CartItemTable($CartItemTableGateway);
                },
                'CartItemTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Cart());
                    return new TableGateway('cart_items', $dbAdapter, null, $resultSetPrototype);
                },
				'Cart' => function () {
					return new Cart();
				},
                'AddCartForm' => function () {
                    return new AddCartForm();
                },
                'AddCartFilter' => function () {
                    return new AddCartFilter();
                },
                'ShippingForm' => function () {
                    return new ShippingForm();
                },
                'ShippingFilter' => function () {
                    return new ShippingFilter();
                },
                'CartSessionContainer' => function () {
                    return new Container();
                },
            )
        );
    }
}
