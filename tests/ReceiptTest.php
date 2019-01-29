<?php
namespace TDD\Test;
require "vendor\autoload.php";

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase { // creating class that extends TestCase class
    public function setUp() { // public method for setting up object Receipt, by using class Receipt
        $this->Receipt = new Receipt();
    }

    public function tearDown() { // public method to unset object Receipt to ensure that tests are running in isolation
        unset($this->Receipt);
    }

    public function testTotal() { // public function to compare totals
        $input = [0,2,5,8];
        $output = $this->Receipt->total($input); // calling a total method by passing in array items from $input and making this equal to output
        $this->assertEquals( // method from TestCase class that compares expected value and actual output and shows message when these are not equal
            15,
            $output,
            'When summing the total should equal 15'
        );
    }

    public function testTax() { // public method for calculating the tax for a receipt
        $inputAmount = 10.00;
        $taxInput = 0.10;
        $output = $this->Receipt->tax($inputAmount, $taxInput); // calling a tax method by passing in the amount and the tax and making this equal to output
        $this->assertEquals( // method from TestCase class that compares expected value and actual output and shows message when these are not equal
            1.00,
            $output,
            'The tax calculation should equal 1.00'
        );
    }
}