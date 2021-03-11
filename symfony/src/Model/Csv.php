<?php


namespace App\Model;


class Csv
{

    public $Segment;

    public $Country;

    public $Product;

    public $Discount_Band;

    public $Units_Sold;

    public $Manufacturing_Price;

    public $Sale_Price;

    public $Gross_Sales;

    public $Discounts;

    public $Sales;

    public $COGS;

    public $Profit;

    public $Date;

    public $Month_Number;

    public $Month_Name;

    public $Year;

    public function __set($name, $value) {
        $name = preg_replace("/\s/", "_", trim($name));

        $this->$name = $value;
    }
}