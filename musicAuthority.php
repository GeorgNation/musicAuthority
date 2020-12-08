<?php

// Music Authority
// Распространяется по лицензии GPL

define ("WORK_DIR", "data/ingoingMessages/"); # Папка, в которую дистрибьюторы должны отгружать музыку.
define ("THREAD_FILE", "data/threads.db"); # Файл с потоками музыки

require_once "modules/DataClassDefenitions.php"; # Определения
require_once "modules/ISRC.php"; # Код для работы с ISRC
require_once "modules/UPC.php"; # Код для работы с штрих кодами UPC
require_once "modules/MA_Distributor.php"; # Music Authority на стороне дистрибьютора
require_once "modules/MA_Store.php"; # Music Authority на стороне площадки (витрины)