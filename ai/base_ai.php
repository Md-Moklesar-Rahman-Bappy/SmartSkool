<?php

abstract class BaseAI {
    protected $api_key;
    protected $model;
    protected $max_tokens;
    protected $temperature;

    public function __construct($api_key = '', $model = '', $max_tokens = 500, $temperature = 0.7) {
        $this->api_key = $api_key;
        $this->model = $model;
        $this->max_tokens = $max_tokens;
        $this->temperature = $temperature;
    }

    abstract public function generate($prompt, $system_prompt = '');

    protected function makeRequest($url, $data) {
        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        if ($error) {
            throw new Exception("cURL Error: " . $error);
        }
        
        if ($http_code >= 400) {
            $response_data = json_decode($response, true);
            $error_msg = isset($response_data['error']['message']) ? $response_data['error']['message'] : 'Unknown error';
            throw new Exception("API Error (HTTP $http_code): " . $error_msg);
        }
        
        return json_decode($response, true);
    }

    public function setApiKey($key) {
        $this->api_key = $key;
    }

    public function setModel($model) {
        $this->model = $model;
    }
}