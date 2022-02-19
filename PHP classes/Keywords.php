<?php

class Keywords
{
    Private $id;
    private $name;
    function __construct($ID, $Name)
    {
        $this->id=$ID;
        $this->name=$Name;
    }
    function GetName()
    {
        return $this->name;
    }
    function GetID()
    {
        return $this->id;
    }


}