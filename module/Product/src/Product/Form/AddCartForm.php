<?php

namespace Customer\Form;
use Zend\Form\Form;


class RegistrationForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('product');

        $this->add(array(
            'name' => 'productname',
            'type' => 'hidden',
            'attributes' => array(
                //'hidden' => true,
            ),
        ));
        $this->add(array(
            'name' => 'productdescription',
            'type' => 'hidden',
            'attributes' => array(
                //'hidden' => true,
            ),
        ));
        $this->add(array(
            'name' => 'unitprice',
            'type' => 'hidden',
        ));
        $this->add(array(
            'name' => 'pricequantity',
            'type' => 'hidden',
            'attributes' => array(
                //'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'totalpricequantity',
            'type' => 'hidden',
            'attributes' => array(
               // 'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'productimg',
            'type' => 'hidden',
            'attributes' => array(
                //'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'addCartbutton',
            ),
        ));
    }
}
