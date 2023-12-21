<?php

error_reporting(E_ALL & ~E_NOTICE);

const BP = __DIR__;
const DS = DIRECTORY_SEPARATOR;

require_once BP . DS . 'autoload.php';

use Entities\FileStorage;
use Entities\TelegraphText;
use Entities\Swig;
use Entities\Spl;
use Interfaces\IRender;


$telegraphText = new TelegraphText('Пушкин', 'text_test_file');
$telegraphText->editText('Кукушки', 'Какой то непонятный текст');
// print_r($telegraphText);

// $telegraphText->slug = 'Hello_';
// print_r($telegraphText->slug . PHP_EOL);

// $telegraphText->author = 'Гоголь';
// print_r($telegraphText->author . PHP_EOL);

// $telegraphText->published = '07.12.2023';
// print_r($telegraphText->published . PHP_EOL);

$fileStorage = new FileStorage();
$fileStorage->create($telegraphText);

// // $fileStorage->read('text_test_file_1_11.06.2023');
// // $fileStorage->update('text_test_file_1_11.06.2023', $telegraphText);
$fileStorage->delete('text_test_file_12.20.2023_2');
// $fileStorage->list();

$swig = new Swig('telegraph_text');
$swig->addVariablesToTemplate(['slug', 'title']);

// $swig->render($telegraphText);

$spl = new Spl('telegraph_text');
$spl->addVariablesToTemplate(['slug', 'title', 'text']);

$templateEngines = [$swig, $spl];

foreach ($templateEngines as $engine) {
    if ($engine instanceof IRender) {
        echo $engine->render($telegraphText) . PHP_EOL;
    } else {
        echo 'Template engine does not support render interface' . PHP_EOL;
    }
}
