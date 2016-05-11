<?php

namespace Product\Form;
use Zend\Form\Form;


class ShippingForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('product');

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
            'name' => 'shipping_address1',
            'type' => 'text',
            'attributes' => array(
                'required' => true,
                'placeholder' => 'Address 1',
                'class' => 'form-control',
                'id' => 'address1',
            ),
            // 'options' => array(
                // 'label' => 'Last Name',
            // ),
        ));
        $this->add(array(
            'name' => 'shipping_address2',
            'type' => 'text',
            'attributes' => array(
                'placeholder' => 'Address 2',
                'class' => 'form-control',
                'id' => 'address2',
            ),
        ));
        $this->add(array(
            'name' => 'shipping_address3',
            'type' => 'text',
            'attributes' => array(
                'placeholder' => 'Address 3',
                'class' => 'form-control',
                'id' => 'address3',
            ),
        ));
        $this->add(array(
            'name' => 'shipping_city',
            'type' => 'text',
            'attributes' => array(
                'required' => true,
                'placeholder' => 'City',
                'class' => 'form-control',
                'id' => 'city',
            ),
        ));
        $this->add(array(
            'name' => 'shipping_state',
            'type' => 'text',
            'attributes' => array(
                'required' => true,
                'placeholder' => 'State',
                'class' => 'form-control',
                'id' => 'state',
            ),
        ));
        $this->add(array(
            'name' => 'shipping_country',
            'type' => 'text',
            'attributes' => array(
                'required' => true,
                'placeholder' => 'Country',
                'class' => 'form-control',
                'id' => 'country',
            ),
        ));

        $this->add(array(
            'name' => 'shipping_mehod',
            'type' => 'hidden',
            'attributes' => array(
                'required' => true,
                'class' => 'shippingmethod',
            ),
        ));

        $this->add(array(
            'name' => 'total_weight',
            'type' => 'hidden',
            'attributes' => array(
                'required' => true,
            ),
        ));

        $this->add(array(
            'name' => 'shipping_total',
            'type' => 'hidden',
            'attributes' => array(
                'required' => true,
                'class' => 'shipping_total',
            ),
        ));

        $this->add(array(
            'name' => 'sub_total',
            'type' => 'hidden',
            'attributes' => array(
                'required' => true,
                'class' => 'sub_total',
            ),
        ));
        $this->add(array(
            'name' => 'continue',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Continue',
                'id' => 'Continuebutton',
                'class' => 'btn btn-success',
            ),
        ));
    }
}