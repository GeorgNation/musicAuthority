<?php

require_once "musicAuthority.php";

$msg = new MA_Distributor ();

$sender = new Sender_Recipient;
$sender->id = "LOL-12345";
$sender->name = "FreshCompact";

$recipient = new Sender_Recipient;
$recipient->id = "GENERAL";
$recipient->name = "l-lacker";

$msg->sender = $sender;
$msg->recipient = $recipient;

$msg->messageType = "OriginalMessage";

$isrcAuthority = new ISRC ("FR", "ESH");
$isrc = $isrcAuthority->get ();

$upcAuthority = new UPC (13272);
$upc = $upcAuthority->get ();

print_r ($isrc . PHP_EOL . $upc);

$artist1 = new Artist;
$artist1->artistName = 'OST "Боевик на НТВ"';
$artist1->role = "Primary Artist";

$artist2 = new Artist;
$artist2->artistName = 'Label Control';
$artist2->role = "Music Publisher";
$artist2->notAddAsArtist = true;

$pLine = new PLine;
$pLine->year = 2020;
$pLine->line = "2020 Линго Продакшн";

$music = new Music_Track;
$music->referenceId = "music1";
$music->title = "Перестрелка";
$music->artists = [$artist1, $artist2];
$music->resourcePath = "fddsffds/sdfsfdfsd.mp3";
$music->isrc = $isrc;
$music->year = 2020;
$music->pLine = $pLine;
$music->marketDescription = "Официальный саундтрек проекта Боевик на НТВ. «Боевик на НТВ» (Менты-17) — российский любительский проект Михаила Пушного в жанре пародии, арт-хауса и боевика. Стилизован под криминальные сериалы 90-х и 2000-х годов (в 3 сезоне уже с 2010-х). Первая серия вышла 30 марта 2019 года. Не стоит воспринимать данное произведение, как более серьёзное, т.к оно является сатирическим и более развлекательным (хотя присутствуют и драматичные сцены). Во многом есть своя фишка, например: актёр практически играет всех персонажей подряд, импровизация без всего сценария (исключая 3 сезон), само название, своя стилистика и атмосфера, перестрелки и многое другое.";

$cover = new Cover_Photo;
$cover->referenceId = "cover";
$cover->resourcePath = "fsdfssfd/ssdfsdf.jpg";

$msg->resources = [$music, $cover];

$release = new Album_Release;
$release->title = "Перестрелка";
$release->additionalTitle = "Из сериала Боевик на НТВ";
$release->primaryAuthor = 'OST "Боевик на НТВ"';
$release->year = 2020;
$release->upc = "$upc";
$release->resources = ['music1', 'cover'];
$release->music = ['music1'];
$release->cover = ['cover'];

$msg->album = $release;

file_put_contents ("msg.msg", $msg->generateMessage (bin2hex (random_bytes (64))));