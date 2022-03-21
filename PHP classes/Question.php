<?php
session_start();
include_once "Tags.php";
class Question
{
    private $question;
    private $answer;
    private $tags=array();
    private $user;

    function __construct($q,$a,$t)
    {
        $this->question=$q;
        $this->answer=$a;
        $this->user=$_SESSION["user"];
        echo($t);

        $tagsID=explode(",", $t);
        $connection= new mysqli("localhost","root");
        if ($t!=null)
        {
            foreach ($tagsID as $i)
            {

                $result=$connection->query("SELECT * FROM questionsdb.tags WHERE idTags=".$i);
                if($result!=null)
                {
                    $assoc=$result->fetch_assoc();
                    $tag=new Tags(intval($i),$assoc["TagName"],$assoc["Keywords"]);
                    array_push($this->tags, $tag);
                }
            }
        }
    }






    //fix for sql insert query not properly processing apostrophe as an actual character
    function apostropheCatastropheFix($string)
    {
        $problemchildren=[];
        for($i = 0; $i < strlen($string); $i++)
        {
            if(substr($string,$i,1)=="'")
            {
                array_push($problemchildren,$i);
            }
        }
        for ($i=0;$i<count($problemchildren);$i++)
        {
            $string = substr_replace($string, "\\", ($problemchildren[$i] + $i), 0);
        }
        return($string);

    }
    function Update()
    {
        $connection= new mysqli("localhost", "root");
        $tagsIDs=array();
        foreach($this->tags as $i)
        {
            array_push($tagsIDs,$i->GetId());
        }
        $question=$this->apostropheCatastropheFix($this->question);
        $answer=$this->apostropheCatastropheFix($this->answer);


        $result= $connection->query("UPDATE questionsdb.questions SET TagIds='".implode(",",$tagsIDs)."', Question='".$question."',Answer='".$answer."', UserID=".$_SESSION["user"]->GetID()." WHERE ID=".$this->id);
    }
    function GetTagsIds()
    {
        $tagsIDs=array();
        foreach($this->tags as $i)
        {
            echo "bruh".$i->GetID();
            array_push($tagsIDs,$i->GetID());
        }
        return $tagsIDs;
    }
    function GetQuestion(){return $this->question;}
    function GetAnswer(){return $this->answer;}
    function GetTags(){return $this->tags;}
    function GetUser(){return $this->user;}
    function GetKeyWords()
    {
        //split sentence
        $QuestionAnswer=$this->question." ".$this->answer;
        $keywords=array("");
        $notdone=true;
        $word=0;

            for($i=0;$i<strlen($QuestionAnswer);$i++) {
                if ($QuestionAnswer[$i] != " ") {
                    $keywords[$word] = $keywords[$word] . $QuestionAnswer[$i];

                } else {
                    $word = $word + 1;
                    array_push($keywords, "");
                }

            }
        return($keywords);


    }
}