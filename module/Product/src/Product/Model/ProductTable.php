<?php

namespace Product\Model;
use Album\Filter\ProductFilter;
use Album\Form\ProductForm;
use Zend\Db\TableGateway\TableGateway;



class ProductTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function viewProduct($id)
    {
       // make sure $id is int not done
        $resultSet = $this->tableGateway->select(array('product_id' => $id));

        return $resultSet;
    }

    public function getProductById($id)
    {
        echo $id;
    }
}