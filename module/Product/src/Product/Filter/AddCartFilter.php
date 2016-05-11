<?php

namespace Product\Filter;
use Zend\InputFilter\InputFilter;

class addCartFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name'     => 'productname',
            //'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 6,
                        'max'      => 100,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'productdescription',
            //'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 10,
                        'max'      => 100,
                    ),
                ),
            ),
        ));

        $this->add(
            array(
                'name'     => 'unitprice',
                'required' => false,
                /*'filters'  => array(
                    array('name' => 'Digits'),
                ),*/
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                            \Zend\Validator\NotEmpty::FLOAT  => '"Invalid Format!"'
                            ), 
                        ),
                    ),
                ),
            )
        );

        $this->add(array(
            'name'     => 'quantity',
            //'required' => true,
            'filters'  => array(
                array('name' => 'Int'),
               // array('name' => 'StringTrim'),
            ),
        ));

        $this->add(array(
            'name'     => 'price',
            'required' => true,
            /*'filters'  => array(
                array('name' => 'Digits'),
            ),*/
            'validators' => array(
                array(
                    'name'    => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                        \Zend\Validator\NotEmpty::FLOAT  => '"Invalid Format!"'
                        ), 
                    ),
                ),
            ),
        ));
    }
}