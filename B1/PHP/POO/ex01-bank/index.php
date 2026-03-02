<?php
require_once 'classes/BankAccount.php';

$Alice = new BankAccount("Alice");
$Alice->deposit(100);
$Alice->deposit(50);

require_once 'index.phtml';