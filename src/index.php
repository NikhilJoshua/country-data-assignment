<?php
require_once __DIR__ . '/HttpClient.php';
$httpClient = new HttpClient();
$httpClient->fetch();
$httpClient->display();
