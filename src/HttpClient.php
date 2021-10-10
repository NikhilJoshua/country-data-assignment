<?php
/**
 * HttpClient Class
 */
class HttpClient {
    private $url;
    private $ch;
    private $res;
    public function __construct($url = 'http://api.countrylayer.com/v2/all?access_key=615a7f2c90da86de92cfb0a2415e726c'){
        $this->url = $url;
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL,$this->url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    }

    public function fetch(){
        $data = file_get_contents(__DIR__ . '/cache.txt');
        if(!$data) {
            $this->res = curl_exec($this->ch);
            file_put_contents(__DIR__ . '/cache.txt', $this->res);
            return;
        }
        $this->res = $data;
    }

    public function display(){
        echo $this->res;
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }
}