<?php

namespace Customer\Form;
use Zend\Form\Form;


class RegistrationForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('customer');

        $this->add(array(
            'name' => 'first_name',
            'type' => 'text',
            'attributes' => array(
				'required' => true,
                'placeholder' => 'First Name',
                'class' => 'form-control',
                'id' => 'firstname',
            ),
        ));
        $this->add(array(
            'name' => 'last_name',
            'type' => 'text',
            'attributes' => array(
                'required' => true,
				'placeholder' => 'Last Name',
                'class' => 'form-control',
                'id' => 'lastname',
            ),
            // 'options' => array(
                // 'label' => 'Last Name',
            // ),
        ));
        $this->add(array(
            'name' => 'phone',
            'type' => 'text',
			'attributes' => array(
				'placeholder' => 'Phone',
                'class' => 'form-control',
                'id' => 'phone',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'attributes' => array(
				'required' => true,
				'placeholder' => 'Email',
                'class' => 'form-control',
                'id' => 'registrationemail',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'attributes' => array(
				'required' => true,
				'placeholder' => 'Password',
                'class' => 'form-control',
                'id' => 'registrationpassword',
            ),
        ));
        $this->add(array(
            'name' => 'confirmpassword',
            'type' => 'password',
            'attributes' => array(
				'required' => true,
				'placeholder' => 'Confirm Password',
                'class' => 'form-control',
                'id' => 'confirmpassword',
            ),
        ));
		
		$this->add(array(
            'name' => 'company_name',
            'type' => 'text',
            'attributes' => array(
				'required' => true,
				'placeholder' => 'Company Name',
                'class' => 'form-control',
                'id' => 'companyname',
            ),
        ));
        $this->add(array(
            'name' => 'register',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Register',
                'id' => 'Registerbutton',
            ),
        ));
    }
}
