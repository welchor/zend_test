<?php

namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CustomerController extends AbstractActionController
{
	public $msg;
	
    public function indexAction ()
    {
        $sm = $this->getServiceLocator();

        $LoginForm = $sm->get('LoginForm');
        $RegistrationForm = $sm->get('RegistrationForm');

        echo $this->layout()->first_name;
       return new ViewModel(array("Login" => $LoginForm, 'Registration' => $RegistrationForm));
    }

    public function loginAction ()
    {
        $sm = $this->getServiceLocator();
        $LoginForm = $sm->get('LoginForm');
        $RegistrationForm = $sm->get('RegistrationForm');


        $request = $this->getRequest();

        $this->msg = $this->params()->fromRoute('error', '');
        if ($this->msg == '') {
        } else {
            if($this->msg == 'email-error') {
                $this->msg = 'Account does not exist!';
            } else {
                $this->msg = 'Invalid password!';
            }
        }
        
        if ($request->isPost()) {

            $LoginFilter = $sm->get('LoginFilter');
            $LoginForm->setInputFilter($LoginFilter);
            $LoginForm->setData($request->getPost());

            if ($LoginForm->isValid()) {
                $Customer = $sm->get('Customer');
                $CustomerTable = $sm->get('CustomerTable');
                $Customer->exchangeArray($LoginForm->getData());
                $CustomerTable->loginUser($Customer);
                $customerData = $CustomerTable->loginUser($Customer);

                if(is_null($customerData)) {
                    $this->redirect()->toRoute('customer', array('action' => 'login', 'error' => 'email-error'));
                } else {
                    $passwordInput = $LoginForm->getInputFilter()->getValue('password');
                    
                        $userPassword = $customerData->password;
						$customerId = $customerData->customer_id;
						$customerFirstName = $customerData->first_name;

                    if ($userPassword != $passwordInput) {
                        $this->redirect()->toRoute('customer', array('action' => 'login', 'error' => 'password-error'));
                    } else {
						$Session = $sm->get('UserSessionContainer');
						$Session->customer_id = $customerId;
						$Session->first_name = $customerFirstName;
						
						if (isset($this->layout()->cart_id)) {
							$this->redirect()->toRoute('product', array('action' => 'shipping'));
						} else {
							$this->redirect()->toRoute('home');
						}	
                    }
                }

            }
        }
        return new ViewModel(array("Login" => $LoginForm, 'errorMessage' => $this->msg, 'Registration' => $RegistrationForm));
    }

    public function registrationAction()
    {

        $sm = $this->getServiceLocator();
		$LoginForm = $sm->get('LoginForm');
        $RegistrationForm = $sm->get('RegistrationForm');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $RegistrationFilter = $sm->get('RegistrationFilter');
            $RegistrationForm->setInputFilter($RegistrationFilter);
            $RegistrationForm->setData($request->getPost());

			if($RegistrationForm->isValid()) {
				$password = $request->getPost('password');
				$confirmedpassword = $request->getPost('confirmpassword');
				if ($password != $confirmedpassword) {
					$this->msg = "Password Mismatch!";
					return new ViewModel(array("Login" => $LoginForm, 'errorMessage' => $this->msg, 'Registration' => $RegistrationForm));
				} else {
					$CustomerRegistration = $sm->get('Customer');
					$CustomerTable = $sm->get('CustomerTable');
					$CustomerRegistration->exchangeArray($RegistrationForm->getData());
					$isEmailExist = $CustomerTable->loginUser($CustomerRegistration);
					
					if (!is_null($isEmailExist)) {
						$this->msg = "Email already exist!";
						return new ViewModel(array("Login" => $LoginForm, 'errorMessage' => $this->msg, 'Registration' => $RegistrationForm));
					} else {
						echo $customerId = $CustomerTable->registerUser($CustomerRegistration);
						$Session = $sm->get('UserSessionContainer');
						$Session->customer_id = $customerId;
						$Session->first_name = $CustomerRegistration->first_name;
						
						if (isset($this->layout()->cart_id)) {
							$this->redirect()->toRoute('product', array('action' => 'shipping'));
						} else {
                            $this->redirect()->toRoute('home');
                        }
					}
				}
            }
        }
		return new ViewModel(array("Login" => $LoginForm, 'errorMessage' => $this->msg, 'Registration' => $RegistrationForm));
    }
	
	public function logoutAction()
	{
		if (!isset($this->layout()->customer_id)) {
			$this->redirect()->toRoute('home');
		}
		
		$sm = $this->getServiceLocator();
        $CartItemTable = $sm->get('CartItemTable');
        $CartTable = $sm->get('CartTable');
		
		$CartTable->deleteCart($this->layout()->cart_id);
		$CartItemTable->deleteCartItem($this->layout()->cart_id);
		
		session_destroy();
		$this->redirect()->toRoute('home');
	}
}