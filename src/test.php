<?php

function array2xml($array, $xml = false){

    if($xml === false){
        $xml = new SimpleXMLElement('<result/>');
    }

    foreach($array as $key => $value){
        if(is_array($value)){
            array2xml($value, $xml->addChild(is_numeric((string) $key)?("n".$key):$key));
        } else {
            $xml->addChild(is_numeric((string) $key)?("n".$key):$key, $value);
        }
    }

    return $xml->asXML();
}

$arr = ['test' => 'working', 'hello' => 'hahah'];
file_put_contents(__DIR__ . 'xmlData.txt',array2xml($arr));