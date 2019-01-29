<?php
namespace TDD;
class Receipt { //creating class Receipt that is used for creating object Receipt in ReceiptTest.php
    public function total(array $items = []){ //public method for summing array items
        return array_sum($items);
    }

    public function tax($amount, $tax) { //public method for calculating tax, taking in amount and tax and returning multiplication of these
        return ($amount * $tax);
    }
}