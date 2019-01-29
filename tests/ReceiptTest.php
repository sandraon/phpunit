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

    /**
     * @dataProvider provideTotal
     */
    public function testTotal($items, $expected) { // public function to compare totals by passing in items and expected value
        $coupon = null; // creating dummy object by making coupon value equal to null
        $output = $this->Receipt->total($items, $coupon); // calling a total method by passing in items and value of coupon and making this equal to output
        $this->assertEquals( // method from TestCase class that compares expected value and actual output and shows message when these are not equal
            $expected, // the same value that was passed in testTotal method
            $output,
            "When summing the total should equal {$expected}" // message using the same expected value that was passed in testTotal method
        );
    }

    public function provideTotal() { // public provider function that returns an array
        return [
            'ints totaling 16' => [[1,2,5,8], 16], // setting a string key for first array to identify it
            [[-1,2,5,8], 14],
            [[1,2,8], 11],
        ];
    }

    public function testTotalAndCoupon() { // public method for calculating total with applying coupon value
        $input = [0,2,5,8];
        $coupon = 0.20;
        $output = $this->Receipt->total($input, $coupon); // calling a total method by passing in the input and coupon value and making this equal to output
        $this->assertEquals( // method from TestCase class that compares expected value and actual output and shows message when these are not equal
            12,
            $output,
            'When summing the total should equal 12'
        );
    }

    public function testPostTaxTotal() { // public method for calculating the total for a collection of items and the tax total and finally summing these values together
        $items = [1,2,5,8];
        $tax = 0.20;
        $coupon = null;
        $Receipt = $this->getMockBuilder('TDD\Receipt') // using getMockBuilder method from PHPUnit framework, passing in class Receipt and making this equal to Receipt object
            ->setMethods(['tax', 'total']) // method that takes an array of two methods - tax and total - for the test
            ->getMock(); // method for returning the Receipt object of the mock
        $Receipt->expects($this->once()) // method for calling the total method once
            ->method('total') // calling a stubbed method by passing in a method total
            ->with($items, $coupon) // turning the stub into mock by passing in items and coupon
            ->will($this->returnValue(10.00)); // calling a method will that says that this stubbed method total will return a value equal to 10.00
        $Receipt->expects($this->once()) // method for calling the tax method once
            ->method('tax') // calling a stubbed method by passing in a method tax
            ->with(10.00, $tax) // turning the stub into mock by passing in value of total method and tax
            ->will($this->returnValue(1.00)); // calling a method will that says that this stubbed method tax will return a value equal to 1.00
        $result = $Receipt->postTaxTotal([1,2,5,8], 0.20, null); // calling postTaxTotal method by passing in array of items, tax percentage and coupon value (null) and making this equal to result
        $this->assertEquals(11.00, $result); // comparing expected value and result value
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