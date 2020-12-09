<?php

// Music Authority
// Распространяется по лицензии GPL

define ("WORK_DIR", "data/ingoingMessages/"); # Папка, в которую дистрибьюторы должны отгружать музыку.
define ("THREAD_FILE", "data/threads.db"); # Файл с потоками музыки
define ("REGISTRY_FILE", "data/registry.db"); # Файл с локальным реестром пользователей
define ("RECIPIENT_ID", "RU-MAUTH-20200912-000005"); # Ваш ID получателя (легально получить можно по ссылке https://forms.gle/5gJk4PcpK1amMGHj8 )
define ("RECIPIENT_NAME", "musicAuthority Local Example Store"); # Ваше имя (должно совпадать в реестре)

require_once "modules/DataClassDefenitions.php"; # Определения
require_once "modules/ISRC.php"; # Код для работы с ISRC
require_once "modules/UPC.php"; # Код для работы с штрих кодами UPC
require_once "modules/MA_Distributor.php"; # Music Authority на стороне дистрибьютора
require_once "modules/MA_Store.php"; # Music Authority на стороне площадки (витрины)
require_once "modules/MA_Registry.php"; # Реестр (Требуется CURL)
