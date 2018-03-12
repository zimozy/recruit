<?php
namespace ScoopM\Firebase;

class EmailVerification extends Api
{
    public function __construct(String $apiKey, array $postFields)
    {
        $this->url = 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/getOobConfirmationCode?key=';
        parent::__construct($apiKey, $postFields);        
    }
}
