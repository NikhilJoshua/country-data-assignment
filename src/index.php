<?php
require_once __DIR__ . '/HttpClient.php';
require_once __DIR__ . '/DataParser.php';
require_once __DIR__ . '/Renderer.php';

$httpClient = new HttpClient(new CountryLayerAPI('615a7f2c90da86de92cfb0a2415e726c'));
$httpClient->fetch();
$data = $httpClient->getData();
//echo $data;

$xmlData = new \NJ\DataParser(new \NJ\XMLParser($data));
$xmlData->parse();
$xmlData->export();

$csvData = new \NJ\DataParser(new \NJ\CSVParser($data));
$csvData->parse();
$csvData->export();

$renderer = new \NJ\Renderer(new \NJ\ListRender($data));
$renderer->render();

$renderer2 = new \NJ\Renderer(new \NJ\GridRender($data));
$renderer2->render();