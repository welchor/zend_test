<?php

namespace Product\Model;
// use Album\Filter\ProductFilter;
// use Album\Form\ProductForm;
use Zend\Db\TableGateway\TableGateway;


class JobItemTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	
	public function insertToJobItem($cartddata)
	{
		 foreach ($cartddata as $value) {
         $cart_id = $value->cart_id;
         $product_id = $value->product_id;
         $weight = $value->weight;
         $qty = $value->qty;
         $unit_price = $value->unit_price;
         $price = $value->price;
      }
        

       $data = array(
          "job_order_id" => $cart_id,
          "product_id" => $product_id,
          "weight" => $weight,
          "qty" => $qty,
          "unit_price" => $unit_price,
          "price" => $price,
       );

     $this->tableGateway->insert($data); 
	}

}