<?php

namespace NJ;

class DataParser {
    private $parser;

    public function __construct(Parser $parser){
        $this->parser = $parser;
    }

    public function parse(){
        $this->parser->parse();
    }

    public function getData(){
        return $this->parser->getData();
    }

    public function export() {
        $this->parser->write();
    }
}

interface Parser {
    public function parse();
    public function write();
    public function getData();
}

class XMLParser implements Parser {
    private $json_data;
    private $xmlData;
    private $data;

    public function __construct($json_data){
        $this->json_data = $json_data;
        $this->data = json_decode($this->json_data, true);
        $this->xml = new \SimpleXMLElement('<countries/>');
    }
    public function parse() {


        foreach($this->data as $key => $value){
            $country = $this->xml->addChild('country');
            $this->xmlHelper($value, $country);
        }
        $this->xmlData = $this->xml->asXML();
    }

    public function getData(){
        return $this->xmlData;
    }

    public function write() {
        file_put_contents(__DIR__ . '/xmlData.xml', $this->xmlData);
    }


    function xmlHelper($data, $xml=false){

        if($xml===false){
            $xml = new \SimpleXMLElement('<name/>');
        }
        foreach($data as $key => $value ){
            if (is_array($value)) {
                $this->xmlHelper($value, $xml->addChild($key));
            } else {
                $xml->addChild(is_numeric((string)$key)?("n".$key):$key, $value);
            }
        }
    }
}

class CSVParser implements Parser {

    public function parse()
    {

    }

    public function write()
    {
        // TODO: Implement write() method.
    }

    public function getData()
    {
        // TODO: Implement getData() method.
    }
}