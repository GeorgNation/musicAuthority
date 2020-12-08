<?php

class ISRC
{
	protected $country;  // Страна
	protected $registar; // Регистратор
	protected $year;     // Год
	public $number;   // Номер трека

	public function __construct ($country = "RU", $registar = "M0D") // Создание класса
	{
		$this->country = $country;
		$this->registar = $registar;
		$this->year = date ("y");
		$this->number = 1;
	}

	public function parse ($isrc) //Парсинг ISRC
	{
		if (strlen ($isrc) == 12)
		{
			$isrc = str_split ($isrc, 1);

			return array (
				"country" => $isrc[0].$isrc[1],
				"registar" => $isrc[2].$isrc[3].$isrc[4],
				"year" => intval ($isrc[5].$isrc[6]),
				"number" => intval ($isrc[7].$isrc[8].$isrc[9].$isrc[10].$isrc[11])
			);
		}
		else
			return false;
	}

	public function next ()
	{
		++$this->number;
	}

	public function prev ()
	{
		--$this->number;
	}

	public function get () // Получить ISRC код
	{
		return $this->country . $this->registar . $this->year . str_pad ($this->number, 5, "0", STR_PAD_LEFT);
	}
}
