<?php

namespace Product\Model;
use Zend\Debug\Debug;

class Cart
{
    public $cart_id;
    public $customer_id;
    public $order_datetime;
    public $sub_total;
    public $taxable_amount;
    public $discount;
    public $tax;
    public $shipping_total;
    public $total_amount;
    public $total_weight;
    public $company_name;
    public $email;
    public $first_name;
    public $last_name;
    public $phone;
    public $shipping_mehod;
    public $shipping_name;
    public $shipping_address1;
    public $shipping_address2;
    public $shipping_address3;
    public $shipping_city;
    public $shipping_state;
    public $shipping_country;
    public $cart_item_id;
    public $product_id;
    public $product_name;
    public $product_desc;
    public $product_image;
    public $product_thumbnail;
    public $stock_qty;
    public $taxable_flag;
    public $weight;
    public $qty;
    public $price;    
    public $unit_price;
    public $maxweight;
    public $rate;
    public $shipping_rate;
    public $min_weight;
    public $max_weight;
    public $shipping_id;

    public function exchangeArray($data)
    {
       
        $this->cart_id = (!empty($data['cart_id'])) ? $data['cart_id'] : null;
        $this->customer_id = (!empty($data['customer_id'])) ? $data['customer_id'] : null;
        $this->order_datetime = (!empty($data['order_datetime'])) ? $data['order_datetime'] : null;
        $this->sub_total = (!empty($data['sub_total'])) ? $data['sub_total'] : null;
        $this->taxable_amount = (!empty($data['taxable_amount'])) ? $data['taxable_amount'] : null;
        $this->discount = (!empty($data['discount'])) ? $data['discount'] : null;
        $this->tax = (!empty($data['tax'])) ? $data['tax'] : null;
        $this->shipping_total = (!empty($data['shipping_total'])) ? $data['shipping_total'] : null;
        $this->total_amount = (!empty($data['total_amount'])) ? $data['total_amount'] : null;
        $this->total_weight = (!empty($data['total_weight'])) ? $data['total_weight'] : null;
        $this->company_name = (!empty($data['company_name'])) ? $data['company_name'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
        $this->first_name = (!empty($data['first_name'])) ? $data['first_name'] : null;
        $this->last_name = (!empty($data['last_name'])) ? $data['last_name'] : null;
        $this->phone = (!empty($data['phone'])) ? $data['phone'] : null;
        $this->shipping_mehod = (!empty($data['shipping_mehod'])) ? $data['shipping_mehod'] : null;
        $this->shipping_name = (!empty($data['shipping_name'])) ? $data['shipping_name'] : null;
        $this->shipping_address1 = (!empty($data['shipping_address1'])) ? $data['shipping_address1'] : null;
        $this->shipping_address2 = (!empty($data['shipping_address2'])) ? $data['shipping_address2'] : null;
        $this->shipping_address3 = (!empty($data['shipping_address3'])) ? $data['shipping_address3'] : null;
        $this->shipping_city = (!empty($data['shipping_city'])) ? $data['shipping_city'] : null;
        $this->shipping_state = (!empty($data['shipping_state'])) ? $data['shipping_state'] : null;
        $this->shipping_country = (!empty($data['shipping_country'])) ? $data['shipping_country'] : null;
        $this->cart_item_id = (!empty($data['cart_item_id'])) ? $data['cart_item_id'] : null;
        $this->product_id = (!empty($data['product_id'])) ? $data['product_id'] : null;
        $this->product_name = (!empty($data['product_name'])) ? $data['product_name'] : null;
        $this->product_desc = (!empty($data['product_desc'])) ? $data['product_desc'] : null;
        $this->product_image = (!empty($data['product_image'])) ? $data['product_image'] : null;
        $this->product_thumbnail = (!empty($data['product_thumbnail'])) ? $data['product_thumbnail'] : null;
        $this->stock_qty = (!empty($data['stock_qty'])) ? $data['stock_qty'] : null;
        $this->taxable_flag = (!empty($data['taxable_flag'])) ? $data['taxable_flag'] : null;
        $this->weight = (!empty($data['weight'])) ? $data['weight'] : null;
        $this->qty = (!empty($data['qty'])) ? $data['qty'] : null;
        $this->price = (!empty($data['price'])) ? $data['price'] : null;
        $this->unit_price = (!empty($data['unit_price'])) ? $data['unit_price'] : null;
        $this->maxweight = (!empty($data['maxweight'])) ? $data['maxweight'] : null;
        $this->rate = (!empty($data['rate'])) ? $data['rate'] : null;
        $this->shipping_rate = (!empty($data['shipping_rate'])) ? $data['shipping_rate'] : null;
        $this->min_weight = (!empty($data['min_weight'])) ? $data['min_weight'] : null;
        $this->max_weight = (!empty($data['max_weight'])) ? $data['max_weight'] : null;
        $this->shipping_id = (!empty($data['shipping_id'])) ? $data['shipping_id'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function updateCartItem()
    {
        
    }
}