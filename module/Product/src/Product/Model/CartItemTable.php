<?php

namespace Product\Model;
// use Album\Filter\ProductFilter;
// use Album\Form\ProductForm;
use Zend\Db\TableGateway\TableGateway;

class CartItemTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	
	public function addToCartItem($id, $cartdata)
	{


      if ($resultSet->count() > 0) {

          return $resultSet->current();
    } else {

        $weight = ($cartdata->product_weight * $cartdata->priceQuantity);

        $data = array(
            "cart_id" => $id,
            "product_id" => $cartdata->product_id,
            "weight" => $weight,
            "qty" => $cartdata->priceQuantity,
            "unit_price" => $cartdata->unitprice,
            "price" => (float)$cartdata->totalpriceQuantity
          );

        $this->tableGateway->insert($data);
    }
	}

  public function checkCartItem($cart_id, $product_id)
  {
      $resultSet = $this->tableGateway->select(array('cart_id' => $cart_id, 'product_id' => $product_id));

      return $resultSet->count() > 0 ? $resultSet->current() : null;
  }

  public function cartdetails($cart_id)
  {
      $select = $this->tableGateway->getSql()->select();
      $select->join(array("p" => "products"), "p.product_id=cart_items.product_id", array("product_desc", "product_name", "product_thumbnail"), "left");
      $select->where(array("cart_items.cart_id" => $cart_id));
      $resultSet = $this->tableGateway->selectWith($select);

       $results = array();
        foreach ($resultSet as $r) {
            $results[] = $r;
        }

        return $results;
  }

  public function getCartTotalWeight($cart_id)
  {
    $total = 0;
     $resultSet = $this->tableGateway->select(array('cart_id' => $cart_id));

     foreach ($resultSet as $value) {
       $total += $value->weight;
     }

     return ceil($total);
  }

  public function getCartTotalPrice($cart_id)
  {
     $total = 0;
     $resultSet = $this->tableGateway->select(array('cart_id' => $cart_id));
     
     foreach ($resultSet as $value) {
       $total += $value->price;
     }

     return $total;
  }

  public function deleteCartItem($id)
  {
    $this->tableGateway->delete(array('cart_id' => $id));
  }
}