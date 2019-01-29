<?php
namespace TDD;
use \BadMethodCallException;

class Receipt { //creating class Receipt that is used for creating object Receipt in ReceiptTest.php
    public function total(array $items = [], $coupon){ //public method for summing array items and applying the coupon value off of the total
        if ($coupon > 1.00) { // if coupon value is bigger than 1.00 (100%)
            throw new BadMethodCallException('Coupon must be less than of equal to 1.00'); // then throw a PHPUnit framework method BadMethodCallExemption with message
        }
        $sum = array_sum($items); // total sum equals sum of array items
        if (!is_null($coupon)) { // if coupon value is not null
            return $sum - ($sum * $coupon); // then subtract the multiplication of sum and coupon value from the sum and return the value
        }
        return $sum; // if coupon value is null then return the sum of array items
    }

    public function tax($amount, $tax) { //public method for calculating tax, taking in amount and tax and returning multiplication of these
        return ($amount * $tax);
    }

    public function postTaxTotal ($items, $tax, $coupon) { // public method for calculating the absolute total by passing in array of items, tax percentage and coupon value
        $subtotal = $this->total($items, $coupon); // calling total method by passing in array of items and coupon value and making this equal to subtotal
        return $subtotal + $this->tax($subtotal, $tax); // calling tax method by passing in subtotal and tax percentage and summing the value from this method with subtotal value and returning the absolute total
    }
}