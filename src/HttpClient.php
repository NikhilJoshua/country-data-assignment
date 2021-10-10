<?php
/**
 * HttpClient Class
 */
class HttpClient {
    private $url;
    private $ch;
    private $res;
    private $apiClient;
    private $data;

    public function __construct(ApiClient $apiClient){
        $this->url = $apiClient->getUrl();
        $this->apiClient = $apiClient;
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL,$this->url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    }

    public function fetch(){
        $this->res = $this->apiClient->fetch($this->ch);
    }

    public function display(){
        echo $this->res;
    }

    public function getData(){
        return $this->res;
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }
}

interface ApiClient {
    public function fetch($ch);
    public function getUrl();
}

class CountryLayerAPI implements ApiClient {
    private $url;
    private $res;
    public function __construct($accessToken)
    {
        $this->url = 'http://api.countrylayer.com/v2/all?access_key=' . $accessToken;
    }

    public function fetch($ch)
    {
        $data = file_get_contents(__DIR__ . '/CLcache.txt');
        if(!$data) {
            $this->res = curl_exec($ch);
            $arr = json_decode($this->res, true);
            $slice = array_slice($arr, 0,15);
            $this->data = json_encode($slice);
            file_put_contents(__DIR__ . '/CLcache.txt', $this->data);
            return $this->data;
        }
        return $data;
    }

    public function getUrl(){
        return $this->url;
    }

    public function getData() {
        return $this->res;
    }
}