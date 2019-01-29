<?php
namespace TDD;
class Receipt { //creating class Receipt that is used for creating object Receipt in ReceiptTest.php
    public function total(array $items = [], $coupon){ //public method for summing array items and applying the coupon value off of the total
        $sum = array_sum($items); // total sum equals sum of array items
        if (!is_null($coupon)) { // if coupon value is not null
            return $sum - ($sum * $coupon); // then subtract the multiplication of sum and coupon value from the sum and return the value
        }
        return $sum; // if coupon value is null then return the sum of array items
    }

    public function tax($amount, $tax) { //public method for calculating tax, taking in amount and tax and returning multiplication of these
        return ($amount * $tax);
    }
}