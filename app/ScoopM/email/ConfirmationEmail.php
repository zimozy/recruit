<?php
namespace ScoopM;

class ConfitmationEmail extends Email {

    public function __construct() {
        $this->var = $var;
        $this->subject = 'Please confirm your email address';
        $this->body = <<<BODY
    TEXT
BODY;
        $this->altBody = <<<ALT_BODY
        ALT TEXT
ALT_BODY;
    }

}
