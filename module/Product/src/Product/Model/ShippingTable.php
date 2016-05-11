<?php

namespace Product\Model;
use Zend\Db\TableGateway\TableGateway;
use \Zend\Db\Sql\Expression;

class ShippingTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	
	   public function shippingpriceground($id,$weight,$shippingamount)
     {

          $select = $this->tableGateway->getSql()->select();
          $select->columns(array('maxweight' => new \Zend\Db\Sql\Expression('MAX(max_weight)'), 'rate' => new \Zend\Db\Sql\Expression('MAX(shipping_rate)')));
          $select->where(array('shipping_method' => 'ground'));
          
          $resultSet = $this->tableGateway->selectWith($select);

          foreach ($resultSet as $r) {
              $maxweight = $r->maxweight;
              $rate = $r->rate;
          }

          return $this->shippingcomputation($resultSet, $weight, $shippingamount, $shippingtype = 'ground', $maxweight, $rate);
     }

     public function shippingpriceexpedited($id,$weight,$shippingamount)
     {

          $select = $this->tableGateway->getSql()->select();
          $select->columns(array('maxweight' => new \Zend\Db\Sql\Expression('MAX(max_weight)'), 'rate' => new \Zend\Db\Sql\Expression('MAX(shipping_rate)')));
          $select->where(array('shipping_method' => 'expedited'));
          
          $resultSet = $this->tableGateway->selectWith($select);

          foreach ($resultSet as $r) {
              $maxweight = $r->maxweight;
              $rate = $r->rate;
          }

          return $this->shippingcomputation($resultSet, $weight, $shippingamount, $shippingtype = 'expedited', $maxweight, $rate);

     }

     private function shippingcomputation($resultSet, $weight, $shippingamount, $shippingtype,$maxweight, $rate)
     {
          if ($weight > $maxweight) {
                $weight = ($weight - $maxweight);
                $shippingamount = ($shippingamount + $rate);
                $this->shippingcomputation($resultSet, $weight, $shippingamount, $shippingtype, $maxweight, $rate);
          } else {
                $resultSetweight = $this->tableGateway->select(array('shipping_method' => $shippingtype));
                foreach ($resultSetweight as $value) {
                    if ($weight > $value->min_weight AND $weight <= $value->max_weight) {
                        $shippingamount = ($shippingamount + $value->shipping_rate);
                        $weight = ($weight -  $value->max_weight);
                    }
                }
          }

          return $shippingamount;
     }

}