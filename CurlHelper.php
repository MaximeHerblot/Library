<?php

namespace App\Library;

class CurlHelper
{

    private $method;
    private $parameters;
    private $url;
    private $ch;

    public function __construct($url = '', $method = "GET")
    {
        $this->ch = curl_init();
        $this->url = $url; 
        // curl_setopt($this->ch, CURLOPT_POST, true);
        $this->method = $method;
        $this->parameters = [];
    }


    public function addParameters($name, $value)
    {
        $this->parameters[$name]  = $value;
        return $this;
    }

    public function callCurl()
    {
        $response = null;
        if ($this->method == "GET") {
            $response = $this->getCaller();
        } else if ($this->method == "POST") {
            $response = $this->postCaller();
        }
        return $response;
    }

    private function getCaller()
    {
        $get_parameter = '?' . http_build_query($this->parameters);
        $url = $this->url.$get_parameter;
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($this->ch);

        return $response;
    }

    private function postCaller()
    {
        $get_parameter = '?' . http_build_query($this->parameters);
        $url = $this->url.$get_parameter;
        curl_setopt($this->ch,CURLOPT_POST,true);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($this->ch);
        return $response;
    }
}
