<?php

namespace Customer\Model;
use Zend\Db\TableGateway\TableGateway;

class CustomerTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function loginUser($Customer)
    {

        $email = $Customer->email;
        $password = $Customer->password;
        $resultSet = $this->tableGateway->select(array('email' => $email));

        return $resultSet->count() > 0 ? $resultSet->current() : null;
    }
	
	public function registerUser($Customer) 
	{
		$data = array(
            "email" => $Customer->email,
            "password" => $Customer->password,
            "company_name" => $Customer->company_name,
            "first_name" => $Customer->first_name,
            "last_name" => $Customer->last_name,
            "phone" => $Customer->phone
        );
		
	    $this->tableGateway->insert($data);
		
		return $this->tableGateway->getLastInsertValue();
	}

    public function getCustomerInfo($id)
    {
        $resultSet = $this->tableGateway->select(array('customer_id' => $id));

        return $resultSet;
    }
}