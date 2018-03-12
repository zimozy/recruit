<?php
namespace ScoopM\Firebase;

class ConfirmationEmail
{
    
    // private $errors = false;

    public function __construct($idToken)
    {
        $this->idToken = $idToken;
    }

    // public function hasErrors() {
    //     return $this->errors;
    // }

    public function exec()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/getOobConfirmationCode?key=' . $GLOBALS['firebaseKey'],
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_POSTFIELDS => '{"requestType":"VERIFY_EMAIL","idToken":"' . $idToken . '"}', // "--data-binary"
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERAGENT => 'ScoopM REST'
        ));
        $curlResponse = curl_exec($curl);

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        $json = json_decode($curlResponse);

        //if there's an error
        if ($code != 200) {
            throw new \Exception("Error Processing Request", 1);
            // $this->errors = true;

            /**
             * @todo: DECIDE WHAT TO DO WITH THIS
             */
            // $json->error->message
        }
    }
}