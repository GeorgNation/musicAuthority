<?php

class UPC
{
	protected $issuerCode;
	public $number;

	public function __construct ($issuerCode, $number = 1)
	{
		$this->issuerCode = (int)$issuerCode;
		$this->number = $number;
	}

	public function parse ($upc) //Парсинг upc
	{
		if (strlen ($upc) == 12)
		{
			$upc = str_split ($upc, 1);

			return array (
				"type" => intval ($upc[0]),
				"issuer" => intval ($upc[1].$upc[2].$upc[3].$upc[4].$upc[5]),
				"number" => intval ($upc[6].$upc[7].$upc[8].$upc[9].$upc[10])
			);
		}
		else
			return false;
	}

	protected static function calculateChecksum($data) // https://github.com/SamMakesCode/upc/blob/master/src/UPC.php
    {
        // Get all the individual digits
        $digits = str_split($data);

        // Create variables to store sums
        $even_digit_sum = 0;
        $odd_digit_sum = 0;

        // For each digit
        // Bear in mind, we start counting from 0, so odd and even operations are swapped here
        for ($i = 0; $i < count($digits); $i++) {
            if ($i % 2 === 0) {
                // If it's even
                $odd_digit_sum += $digits[$i];
            } else {
                // If it's odd
                $even_digit_sum += $digits[$i];
            }
        }

        // Multiply the sum of the odd digits by 3
        $odd_digit_sum_multiplied = $odd_digit_sum * 3;

        // Add the sums together
        $sum_of_both = $odd_digit_sum_multiplied + $even_digit_sum;

        // Get the remainder when divided by 10
        $remainder = $sum_of_both % 10;

        // If it's not 0, minus it from 10
        if ($remainder !== 0) {
            return 10 - $remainder;
        }

        // Return 0 remainder
        return $remainder;
	}

	public function next ()
	{
		++$this->number;
	}

	public function prev ()
	{
		--$this->number;
	}

	public function get ()
	{
		return "7" . $this->issuerCode . str_pad ($this->number, 5, "0", STR_PAD_LEFT) . $this->calculateChecksum ("7" . $this->issuerCode . str_pad ($this->number, 5, "0", STR_PAD_LEFT));
	}

}
