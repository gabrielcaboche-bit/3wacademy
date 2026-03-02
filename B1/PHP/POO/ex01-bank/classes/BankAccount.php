<?php

class BankAccount {

    public function __construct($owner, $balance = 0)
    {
        $this->owner = $owner;
        $this->balance = $balance;
    }
    public string $owner;
    public float $balance;
    public function deposit(float $amount)
    {
        $this->balance += $amount;
    }
}