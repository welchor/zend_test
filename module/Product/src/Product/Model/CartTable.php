<?php

namespace Product\Model;
// use Album\Filter\ProductFilter;
// use Album\Form\ProductForm;
use Zend\Db\TableGateway\TableGateway;


class CartTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	
	public function addToCart($id)
	{
		if (!is_null($id)) {
            echo "not null";
        } else {
           $date = time();
           $date = date('Y-m-d h:i:s', $date);

           $data = array(
           		"order_datetime" => $date,
           		"customer_id" => 0,
           		"sub_total" => 0,
           		"taxable_amount" => 0,
           		"discount" => 0,
           		"tax" => 0,
           		"shipping_total" => 0,
           		"total_amount" => 0,
           		"total_weight" => 0,
           		"company_name" => '',
           		"email" => '',
           		"first_name" => '',
           		"last_name" => '',
           		"phone" => '',
           		"shipping_mehod" => '',
           		"shipping_name" => '',
           		"shipping_address1" => '',
           		"shipping_address2" => '',
           		"shipping_address3" => '',
           		"shipping_city" => '',
           		"shipping_state" => '',
           		"shipping_country" => '',
           );

		        $this->tableGateway->insert($data);

            return $this->tableGateway->getLastInsertValue();
        }
	}

  public function updateCart($dataFromCustomer, $dataFromPost, $cart_id)
  {

      foreach ($dataFromCustomer as $value) {
          $customerEmail = $value->email;
          $customerPhone = $value->phone;
          $customerLastName = $value->last_name;
          $customerId = $value->customer_id;
      }
        $shippingtotal = $dataFromPost->shipping_total;
        $subtotal = $dataFromPost->sub_total;
        $total_amount = ($shippingtotal + $subtotal);
        $shippingname = $dataFromPost->first_name . " " . $customerLastName;

       $date = time();
       $date = date('Y-m-d h:i:s', $date);

       $data = array(
          "order_datetime" => $date,
          "customer_id" => $customerId,
          "sub_total" => $dataFromPost->sub_total,
          "taxable_amount" => 0,
          "discount" => 0,
          "tax" => 0,
          "shipping_total" => $dataFromPost->shipping_total,
          "total_amount" => $total_amount,
          "total_weight" => $dataFromPost->total_weight,
          "company_name" => $dataFromPost->company_name,
          "email" => $customerEmail,
          "first_name" => $dataFromPost->first_name,
          "last_name" => $customerLastName,
          "phone" => $customerPhone,
          "shipping_mehod" => $dataFromPost->shipping_mehod,
          "shipping_name" => $shippingname,
          "shipping_address1" => $dataFromPost->shipping_address1,
          "shipping_address2" => $dataFromPost->shipping_address2,
          "shipping_address3" => $dataFromPost->shipping_address3,
          "shipping_city" => $dataFromPost->shipping_city,
          "shipping_state" => $dataFromPost->shipping_state,
          "shipping_country" => $dataFromPost->shipping_country,
       );

       $this->tableGateway->update($data, array('cart_id' => $cart_id));
  }

  public function cartsdetails($id)
  {
      $resultSet = $this->tableGateway->select(array('cart_id' => $id));

      return $resultSet->current();
  }

  public function deleteCart($id)
  {
    $this->tableGateway->delete(array('cart_id' => $id));
  }

}