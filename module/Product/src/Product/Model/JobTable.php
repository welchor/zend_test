<?php

namespace Product\Model;
// use Album\Filter\ProductFilter;
// use Album\Form\ProductForm;
use Zend\Db\TableGateway\TableGateway;


class JobTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	
	public function insertToJob($cartddata)
	{
         $order_datetime = $cartddata->order_datetime;
         $customer_id = $cartddata->customer_id;
         $sub_total = $cartddata->sub_total;
         $taxable_amount = $cartddata->taxable_amount;
         $discount = $cartddata->discount;
         $tax = $cartddata->tax;
         $shipping_total = $cartddata->shipping_total;
         $total_amount = $cartddata->total_amount;
         $total_weight = $cartddata->total_weight;
         $company_name = $cartddata->company_name;
         $email = $cartddata->email;
         $first_name = $cartddata->first_name;
         $last_name = $cartddata->last_name;
         $phone = $cartddata->phone;
         $shipping_mehod = $cartddata->shipping_mehod;
         $shipping_name = $cartddata->shipping_name;
         $shipping_address1 = $cartddata->shipping_address1;
         $shipping_address2 = $cartddata->shipping_address2;
         $shipping_address3 = $cartddata->shipping_address3;
         $shipping_city = $cartddata->shipping_city;
         $shipping_state = $cartddata->shipping_state;
         $shipping_country = $cartddata->shipping_country;

       $data = array(
          "order_datetime" => $order_datetime,
          "customer_id" => $customer_id,
          "sub_total" => $sub_total,
          "taxable_amount" => $taxable_amount,
          "discount" => $discount,
          "tax" => $tax,
          "shipping_total" => $shipping_total,
          "total_amount" => $total_amount,
          "total_weight" => $total_weight,
          "company_name" => $company_name,
          "email" => $email,
          "first_name" => $first_name,
          "last_name" => $last_name,
          "phone" => $phone,
          "shipping_mehod" => $shipping_mehod,
          "shipping_name" => $shipping_name,
          "shipping_address1" => $shipping_address1,
          "shipping_address2" => $shipping_address2,
          "shipping_address3" => $shipping_address3,
          "shipping_city" => $shipping_city,
          "shipping_state" => $shipping_state,
          "shipping_country" => $shipping_country,
       );

     $this->tableGateway->insert($data);   
	}
	
	public function deleteCart($id)
	{
		$this->tableGateway->delete(array('cart_id' => $id));
	}
	
	
}