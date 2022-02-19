<?php

class User
{
    private $userName="";
    private $ID=0;
    function __construct($id,$username){
        $this->userName=$username;
        $this->ID=$id;
    }
    function GetUserName()
    {
        return($this->userName);
    }
    function GetID()
    {
        return($this->ID);
    }
}