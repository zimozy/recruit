<?php
namespace ScoopM\Firebase;

class Api
{
    protected $url, $postFields, $errors;
    public $errorMessage;

    public function __construct(String $apiKey, array $postFields)
    {
        //No errors yet
        $this->errors = false;
        // $this->errorMessage = null;

        //SET URL
        $this->url .= $apiKey;

        //BUILD JSON STRING
        $this->postFields = '{';

        foreach ($postFields as $key => $value) {
            $this->postFields .= "\"$key\":\"$value\",";
        }

        $this->postFields = substr($this->postFields, 0, -1); //remove the last comma

        $this->postFields .= '}';
    }

    public function exec()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_POSTFIELDS => $this->postFields, // "--data-binary"
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERAGENT => 'ScoopM'
        ));

        $response = curl_exec($curl);
        // die(var_dump($this->postFields));
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        curl_close($curl);

        $responseAsJson = json_decode($response);

        if ($code != 200) {
            $this->errors = true;
            $this->errorMessage = $responseAsJson->error->message;
        }
    }

    public function hasErrors() {
        return $this->errors;
    }
}