<?php
require_once __DIR__ . '/HttpClient.php';
require_once __DIR__ . '/DataParser.php';

$httpClient = new HttpClient(new CountryLayerAPI('615a7f2c90da86de92cfb0a2415e726c'));
$httpClient->fetch();
//echo $httpClient->getData();
$xmlData = new \NJ\DataParser(new \NJ\XMLParser($httpClient->getData()));
$xmlData->parse($httpClient->getData());
$xmlData->parse();
//echo $xmlData->getData();
$xmlData->export();