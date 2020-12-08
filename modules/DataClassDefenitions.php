<?php

class Sender_Recipient
{
	public $id;
	public $name;
}

class Music_Track
{
	public $referenceId; # ID отсылки
	public $title; # Заголовок трека
	public $additionalTitle; # дополнительный заголовок
	public $artists; # Артисты (смотрите класс Artist)
	public $resourcePath; # Ссылка на ресурс (в данном случае аудио трек)
	public $isrc; # ISRC трека выданный дистрибьютором (генератор в классе ISRC файла ISRC.php)
	public $year; # Год выпуска трека
	public $pLine; # Строка копирайта на фонограмму. Например: 2020 Foobar Music Group. (Класс PLine)
	public $marketDescription = ""; # Маркет-описание трека.
}

class Artist
{
	public $artistName; # Имя артиста
	public $role; # Роли. Смотрите далее в комментариях какие роли стандартизированы.
	public $notAddAsArtist = false; # Не добавлять как артист. Это значит, что если выставить true, то как артист учитаваться не будет. Только в описании авторства.
}

class PLine
{
	public $year; # Год авторского права
	public $line; # Строка копирайта на фонограмму. Например: 2020 Ash Records
}

class Cover_Photo
{
	public $referenceId; # ID отсылки
	public $resourcePath; # Ссылка на ресурс (в данном случае квадратная обложка альбома)
}

class Album_Release
{
	public $title; # Заголовок трека
	public $additionalTitle; # дополнительный заголовок
	public $primaryAuthor; # Автор альбома
	public $year; # Год релиза
	public $upc; # UPC код альбома выданный дистрибьютором (генератор в классе UPC файла UPC.php)
	public $resources; # Массив отсылок используемых ресурсов
	public $music; # Массив отсылок на музыкальные ресурсы. Нужно чтобы определить какая музыка в альбоме
	public $cover; # Одна отсылка на обложку альбома
	public $takeDown = false; # Отзыв альбома
}
