<?php
class Order
{

    public $idOrder;
    public $quantity;
    public $totalAmount;
    public $orderTime;

    // Constructor
    public function __construct($idOrder, $quantity, $totalAmount, $orderTime)
    {
        $this->idOrder = $idOrder;
        $this->quantity = $quantity;
        $this->totalAmount = $totalAmount;
        $this->orderTime = $orderTime;

    }
        public function getIdOrder()
        {
            return $this->idOrder;
        }

    public function getQuantity()
    {
        return $this->quantity;
    }
    public function totalAmount()
    {
        return $this->totalAmount;
    }
    public function orderTime()
    {
        return $this->idOrder;
    }
}
class OrderDatabase
{
    private $connection;

    public function __construct()
    {

    }


}