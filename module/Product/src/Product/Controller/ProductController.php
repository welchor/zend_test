<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class ProductController extends AbstractActionController
{
    public function indexAction ()
    {
        $sm = $this->getServiceLocator();
        $ProductTable = $sm->get('ProductTable');
        $product = $ProductTable->fetchAll();

        $viewData = array(
            "products" => $product
        );

        return new ViewModel($viewData);
    }

    public function viewAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $sm = $this->getServiceLocator();
        $ProductTable = $sm->get('ProductTable');
        $product = $ProductTable->viewProduct($id);

        $viewData = array(
            "products" => $product
        );
        
        return new ViewModel($viewData);
    }
	
	public function addCartAction ()
	{
		$sm = $this->getServiceLocator();
        $CartTable = $sm->get('CartTable');
        $CartItemTable = $sm->get('CartItemTable');
        $ProductTable = $sm->get('ProductTable');
        $Session = $sm->get('CartSessionContainer');
		
		$request = $this->getRequest();

        $cartdata = $request->getPost();

		if ($request->isPost()) {
            $cartid = $this->layout()->cart_id;

            if (isset($this->layout()->cart_id)) {
                $cartid = $cartid;
            } else {
                $cartid = $CartTable->addToCart($cartid);
                $Session->cart_id = $cartid;
            }
            
            $productDetails = $ProductTable->getProductById($cartdata->product_id);
            exit;

            $checkCartItem = $CartItemTable->checkCartItem($cartid, $cartdata->product_id);
          
            $CartItemTable->addToCartItem($cartid, $cartdata);
            $this->redirect()->toRoute('product', array('action' => 'cart'));
		} else {
			 $this->redirect()->toRoute('home');
		}
	}

    public function cartAction()
    {
        
        $sm = $this->getServiceLocator();
        $CartItemTable = $sm->get('CartItemTable');        
        
        $cartdetail = $CartItemTable->cartdetails($this->layout()->cart_id);

        $viewData = array(
            "cartitem" => $cartdetail
        );
        
        return new ViewModel($viewData);
    }

    public function shippingAction()
    {
        if (!isset($this->layout()->customer_id) AND !isset($this->layout()->cart_id)) {
            $this->redirect()->toRoute('home');
        }

        $sm = $this->getServiceLocator();
        $ShippingTable = $sm->get('ShippingTable');
        $CartItemTable = $sm->get('CartItemTable');
        $ShippingnForm = $sm->get('ShippingForm');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $ShippingFilter = $sm->get('ShippingFilter');
            $ShippingnForm->setInputFilter($ShippingFilter);
            $ShippingnForm->setData($request->getPost());
            
            if($ShippingnForm->isValid()) {
                $ShippingRegistration = $sm->get('Cart');
                $CartTable = $sm->get('CartTable');
                $CustomerTable = $sm->get('CustomerTable');
                $ShippingRegistration->exchangeArray($ShippingnForm->getData());
                $custommerInfo = $CustomerTable->getCustomerInfo($this->layout()->customer_id);
                $CartTable->updateCart($custommerInfo,$ShippingRegistration,$this->layout()->cart_id);
                
                $this->redirect()->toRoute('product', array('action' => 'payment'));
            }
        }

        $cartweight = $CartItemTable->getCartTotalWeight($this->layout()->cart_id);
        $cartprice = $CartItemTable->getCartTotalPrice($this->layout()->cart_id);
        $cartweight = ceil($cartweight);

        $shippingpriceground = $ShippingTable->shippingpriceground($this->layout()->cart_id, $cartweight, $shippingamount=0);
        $shippingpriceexpedited = $ShippingTable->shippingpriceexpedited($this->layout()->cart_id, $cartweight, $shippingamount=0);

        $viewData = array(
            "subtotal" => $cartprice,
            "Shipping" => $ShippingnForm, 
            "ground" =>  $shippingpriceground,
            "expedited" => $shippingpriceexpedited,
            "totalweight" => $cartweight
        );
        
        return new ViewModel($viewData);
    }

    public function paymentAction()
    {
        if (!isset($this->layout()->customer_id)) {
            $this->redirect()->toRoute('home');
        }

        $sm = $this->getServiceLocator();
        $CartItemTable = $sm->get('CartItemTable');
        $CartTable = $sm->get('CartTable');
        $cartItemdetail = $CartItemTable->cartdetails($this->layout()->cart_id);
        $cartdetail = $CartTable->cartsdetails($this->layout()->cart_id);

        $viewData = array(
            "cartItemdetails" => $cartItemdetail,
            "cartDetails" => $cartdetail
        );

         return new ViewModel($viewData);
    }

    public function orderconfirmationAction()
    {
        if (!isset($this->layout()->customer_id)) {
            $this->redirect()->toRoute('home');
        }

        $sm = $this->getServiceLocator();
        $JobTable = $sm->get('JobTable');
        $JobItemTable = $sm->get('JobItemTable');
        $CartItemTable = $sm->get('CartItemTable');
        $CartTable = $sm->get('CartTable');
        $cartItemdetail = $CartItemTable->cartdetails($this->layout()->cart_id);
        $cartdetail = $CartTable->cartsdetails($this->layout()->cart_id);
        $joborder = $JobTable->insertToJob($cartdetail);
		$jobitem = $JobItemTable->insertToJobItem($cartItemdetail);
        
		$viewData = array(
            "cartItemdetails" => $cartItemdetail,
            "cartDetails" => $cartdetail
        );

        return new ViewModel($viewData);
    }
}