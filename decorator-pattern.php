<?php

/**
 * PHP decorator pattern example
 */

interface TransactionInterface {
    public function getCost();
}

class Transaction implements TransactionInterface {
    protected $basePrice = 100;

    public function getCost()
    {
        return $this->basePrice;
    }
}

abstract class Product implements TransactionInterface {
    protected $transactionInterface;
    protected $basePrice = 0;

    public function __construct(TransactionInterface $transactionInterface)
    {
        $this->transactionInterface = $transactionInterface;
    }

    public function getCost()
    {
        return $this->transactionInterface->getCost() + $this->basePrice;
    }
}

class Pizza extends Product {
    protected $basePrice = 500;
}

class Beef extends Product {
    protected $basePrice = 300;
}

class Vat extends Product {
    protected $basePrice = 15;

    public function getCost()
    {
        return ($this->getAmount() * $this->transactionInterface->getCost() / 100) + $this->transactionInterface->getCost();
    }

    public function getAmount()
    {
        return $this->basePrice;
    }
}

$transaction = new Transaction();
echo 'Base transaction - ' . $transaction->getCost() . "<br>";

$transaction = new Pizza($transaction);
echo 'Base transaction with Pizza - ' . $transaction->getCost() . "<br>";

$transaction = new Beef($transaction);
echo 'Base transaction with Pizza and Beef - ' . $transaction->getCost() . "<br>";

$total = new Vat($transaction);
echo 'Total with vat (' . $total->getAmount() . '%) - ' . $total->getCost();