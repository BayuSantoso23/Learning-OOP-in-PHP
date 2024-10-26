<?php

class Product{
    // Variable Decleration
    public $title = "Asus Vivobook",
           $brands = "Asus",
           $category = "Laptop",
           $price = "Rp. 12.000.XXX";

}

// Object Instantiation 1
$Product1 = new Product();
$Product1 -> title = "Acer Nitro 5";
var_dump($Product1);

// Object Instantiation 2 + Making Addition 
$Product2 = new Product();
$Product2 -> title = "Lenovo Ideapad";
$Product2 -> brands = "Lenovo";
$Product2 -> User = "user1";
var_dump($Product2);

