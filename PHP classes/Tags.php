<?php
include_once "Keywords.php";
class Tags
{
    private $name;
    private $id;
    private $keywords=array();
    private $relevancy;
    function __construct($id,$name,$keywords)
    {
        $this->id=$id;
        $this->name=$name;
        //converts keyword string(currently a string of numbers seperated by a comma) into actual keyword objects
        if ($keywords!="")
        {
            $keywordID=explode(",", $keywords);
            $connection= new mysqli("localhost","root");
            foreach ($keywordID as $i)
            {
                $result=$connection->query("SELECT * FROM questionsdb.keywords WHERE ID=".$i);
                if($result!=null)
                {
                    $name=$result->fetch_assoc();
                    $keyword=new Keywords(intval($i),$name["Name"]);
                    array_push($this->keywords, $keyword);
                }
            }
        }


        $this->relevancy;
    }
    function Update()
    {
        //updates the database using the attributes of the tags object as a guide
        $connection= new mysqli("localhost", "root");
        $keywordIDs=array();
        foreach($this->keywords as $i)
        {
            array_push($keywordIDs,$i->GetID());
        }
        $result= $connection->query("UPDATE questionsdb.tags SET keywords='".implode(",",$keywordIDs)."' WHERE idTags=".$this->id);
    }
    function SetRelevancy($value){$this->relevancy=$value;}
    function GetRelevancy(){return $this->relevancy;}
    function SetKeywords($value){$this->keywords=$value;}
    function GetKeywords(){return $this->keywords;}
    function GetName(){return $this->name;}
    function GetID(){return $this->id;}
    function PushKeywords($value)
    {
        array_push($this->keywords,$value);
    }


}
