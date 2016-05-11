<?php

namespace Customer\Form;
use Zend\Form\Form;


class LoginForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('customer');

        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'Email',
                'class' => 'form-control',
                'id' => 'inputEmail3',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'Password',
                'class' => 'form-control',
                'id' => 'loginpassword',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Login',
                'id' => 'loginbutton',
            ),
        ));
    }
}
