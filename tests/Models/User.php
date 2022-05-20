<?php

namespace LangleyFoxall\LaravelAuthenticationLog\Tests\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User implements Authenticatable
{
    public $id;

    // no-op -- method definitions given to comply with Authenticatable Interface,
    //          purely for testing purposes only
    public function getAuthIdentifierName(){}
    public function getAuthIdentifier(){}
    public function getAuthPassword(){}
    public function getRememberToken(){}
    public function setRememberToken($value){}
    public function getRememberTokenName(){}


}