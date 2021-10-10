<?php
require_once __DIR__ . '/HttpClient.php';
$httpClient = new HttpClient(new CountryLayerAPI('615a7f2c90da86de92cfb0a2415e726c'));
$httpClient->fetch();
$httpClient->display();
