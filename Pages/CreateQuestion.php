<?php
include "../PHP classes/User.php";
include_once "../PHP classes/Tags.php";
include "../PHP classes/Question.php";
include_once "../PHP classes/Keywords.php";
//session_start()?>
<?php
if (!isset($_SESSION["user"])){
    header("Location:Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>F-encore: create</title>
    <link href="../StyleSheets/StyleSheet.css" rel="stylesheet" type="text/css" />
    <!--    google font stuff-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Varela Round', sans-serif;
        }
    </style>
</head>
<body>

    <script src="../Scripts/Question.js"></script>
    <script src="../Scripts/AddTag.js"></script>
    <a href="Index.php" , class="home"><h1 class="home">Bruh.com</h1></a>
    <div>
        <div>
            <br>
            <h2 class="center"> CREATE A QUESTION!</h2>
            <br>
        </div>
        <div class="center">
            <br>
            <form method="post",autocomplete="off">
                <input type=text id="question" name="question" <?php if (isset($_POST["tagButton"]) or isset($_POST["AddTag"])  ){echo "value='".$_POST["question"]."'";} ?>> < Question </input>
                <input type=text id="answer" name="answer" <?php if (isset($_POST["tagButton"])or isset($_POST["AddTag"]) ){echo "value='".$_POST["answer"]."'";} ?>> < Answer </input>
                <input type="submit" name="tagButton" value="Tagify!"> </input>
<!--                <button class="next" type="submit" name="submit" ></button>-->
                <br>
                <br>
                <?php
                function ShowTopTags($priority=null)
                {


                    $tags=recommendTags($_POST["question"],$_POST["answer"],$priority);
                    foreach ($tags as $i)
                    {

                        echo "<input type='checkbox' name='tag[]' id='".$i->GetID()."' value='".$i->GetName()."'></input> <label>".$i->GetName()."</label>";
                    }

                }
                if (isset($_POST["AddTag"]))
                {

                    AddTag($_POST["NewTag"]);
                    $connection=new mysqli("localhost", "root");
                    //gets the newest added tag
                    $result=$connection->query("SELECT * FROM questionsdb.tags");
                    $numrows=$result->num_rows;
                    $result=$connection->query("SELECT * FROM questionsdb.tags WHERE idTags=".$numrows);
                    $assoc=$result->fetch_assoc();
                    ShowTopTags(new Tags($assoc["idTags"],$assoc["TagName"],$assoc["Keywords"]));


                }
                if (isset($_POST["tagButton"]) or isset($_POST["AddTag"]))
                {

                    if (!isset($_POST["AddTag"]))
                    {
                        ShowTopTags();
                    }

                    echo "<input type=text name='NewTag', id='NewTag'>  <input type='submit' name='AddTag' value='Add Tag'></input></input>";

                    echo "<br>";
                    echo "<input type='submit' name='submit' value='Submit'>";

                }

                ?>

            </form>
            <?php
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            function AddKeyword($question)
            {
                //creates new keywords in the database if needed
                $conn=new mysqli("localhost","root");
                $res=$conn->query("SELECT Keywords FROM questionsdb.tags");
                while ($row=$res->fetch_assoc())
                {
                    if ($row["Keywords"]==null);
                    {
                        $keywords=array();
                        $split=$question->GetKeyWords();
                        foreach ($split as $i)
                        {


                            $conn=new mysqli("localhost","root");
                            $result=$conn->query("SELECT * FROM questionsdb.keywords");
                            $new=true;
                            while($row2=$result->fetch_assoc())
                            {

                                if ($row2["Name"]==$i)
                                {
                                    $new=false;
                                    break;


                                }
                            }
                            if ($new)
                            {
                                $result2=$conn->query("SELECT * FROM questionsdb.keywords");
                                $numrows=$result2->num_rows;
                                $conn->query("INSERT INTO questionsdb.keywords(ID, Name) VALUES(".($numrows+1).",'".$i."')");
                            }
                            $conn->close();

                        }





                    }
                }
            }
            function AddKeywordToTag($tag,$keyword)
            {
                $conn=new mysqli("localhost", "root");
                $numrows=$conn->query("SELECT * FROM questionsdb.relevancy")->num_rows;
                $conn->query("INSERT INTO questionsdb.relevancy(ID, KeywordID,TagID,Relevancy) VALUES(".($numrows+1).",".$keyword->GetID().",".$tag->GetID().",1)");
            }
            function UpdateTags($question, $tag)
            {
                AddKeyword($question);

                //form a sentence using the keyword ids
                $conn=new mysqli("localhost", "root");
                $result= $conn->query("SELECT Keywords FROM questionsdb.tags WHERE TagName='".$tag->GetName()."'") or die($conn->error);;
                $assoc=$result->fetch_assoc();
                $conn->close();
                if($assoc["Keywords"]==null)
                {
                    $idArray=array();
                    $conn=new mysqli("localhost","root");
                    foreach($question->GetKeywords() as $i)
                    {


                        $result=$conn->query("SELECT ID FROM questionsdb.keywords WHERE Name='".$i."'");
                        $assoc=$result->fetch_assoc();
                        array_push($idArray, $assoc["ID"]);

                    }

                    $conn->query("UPDATE questionsdb.tags SET Keywords='".implode(',', $idArray)."' WHERE idTags=".$tag->GetID());

                    $assoc=$conn->query("SELECT * FROM questionsdb.tags WHERE idTags=".$tag->GetID())->fetch_assoc();
                    $numrows=$conn->query("SELECT * FROM questionsdb.relevancy")->num_rows;

                    foreach(explode(",",$assoc["Keywords"]) as $i)
                    {
                        $keyword=$conn->query("SELECT * FROM questionsdb.keywords WHERE ID=".$i)->fetch_assoc();
                        AddKeywordToTag($tag,new Keywords($keyword["ID"],$keyword["Name"]));

                    }
                    $conn->close();
                }




                else
                {
                    //translates from numbers to names
                    $nameArray= array();
                    foreach(explode(",",$assoc["Keywords"]) as $i)
                    {

                        $conn=new mysqli("localhost", "root");
                        $result= $conn->query("SELECT Name FROM questionsdb.keywords WHERE ID=".$i);
                        $assoc=$result->fetch_assoc();
                        array_push($nameArray,$assoc["Name"]);
                    }
                    foreach ($question->GetKeywords() as $i)
                    {
                        if(in_array($i, $nameArray))
                        {
                            $conn=new mysqli("localhost","root");
                            $kAssoc=$conn->query("SELECT ID FROM questionsdb.keywords WHERE Name='".$i."'") or die ($conn->error);
                            $keywordid=$kAssoc->fetch_assoc()["ID"];

                            $rAssoc=$conn->query("SELECT ID FROM questionsdb.relevancy WHERE TagID=".$tag->GetID()." AND KeywordID=".$keywordid)->fetch_assoc();
                            $relevancyid=$rAssoc["ID"];
                            $result=$conn->query("UPDATE questionsdb.relevancy SET Relevancy=Relevancy+1 WHERE ID=".$relevancyid);
                            $conn->close();

                        }


                    }
                }




            }
            $dom= new DOMDocument();
            function smallest($array, $value)
            {
                if (sizeof($array)<$value)
                {
                    return sizeof($array);
                }
                else{
                    return $value;
                }
            }
            function AddTag($tagName)
            {
                $connection=new mysqli("localhost","root");//next ID,   Name of tag   empty space for keywords
                $numrows=$connection->query("SELECT * FROM questionsdb.tags")->num_rows+1;
                $connection->query("INSERT INTO questionsdb.tags(idTags, TagName) VALUES(".$numrows.",'".$tagName."') ");
                $connection->close();
            }
            function relevancy($a,$b)
            {
                return $b->GetRelevancy()-$a->GetRelevancy();
            }
            function recommendTags($question, $answer,$priority=null)
            {
                $questionAnswer=$question." ".$answer;
                $connection= new mysqli("localhost", "root");
                $result=$connection->query(" SELECT * FROM questionsdb.tags");
                $connection->close();
                $tags=array();
                while ($row=$result->fetch_assoc())
                {
                    array_push($tags, new Tags($row["idTags"], $row["TagName"], $row["Keywords"]));
                }
                foreach ($tags as $i)
                {


                    foreach ($i->GetKeywords() as $j)
                    {
                        if (strpos($questionAnswer,$j->GetName()))
                        {
                            $relevancy=$i->GetRelevancy();
                            //extra relevancy from the tag relevancy table
                            $conn=new mysqli("localhost","root");
                            $result=$conn->query("SELECT Relevancy FROM questionsdb.relevancy WHERE KeywordID=".$j->GetID()." AND TagID=".$i->GetID()) or die($conn->error);
                            $assoc=$result->fetch_assoc();
                            $conn->close();

                            $addedrelevancy=$assoc["Relevancy"];
                            $i->SetRelevancy($relevancy+=$addedrelevancy);

                        }
                    }

                }
                uasort($tags, "relevancy");


                $top= array();

                $counter=0;
                foreach ($tags as $i)
                {
//                    echo $i;
//                    echo $tags[$i]->GetName();
                    if ($priority!=null)
                    {
                        if ($priority->GetID()==$i->GetID())
                        {

                        }
                        else
                        {
                            array_push($top, $i);
                            $counter+=1;
                            if ($counter>=smallest($tags, 10-1))
                            {
                                break;
                            }
                        }



                    }
                    else{
                        array_push($top, $i);
                        $counter+=1;
                        if ($counter>=smallest($tags, 10-1))
                        {
                            break;
                        }
                    }



                }
                if ($priority!=null)
                {
                    array_unshift($top,$priority);
                }

                return $top;
            }

            

//            //fix for sql insert query not properly processing apostrophe as an actual character
//            function apostropheCatastropheFix($string)
//            {
//                $problemchildren=[];
//                for($i = 0; $i < strlen($string); $i++)
//                {
//                    if(substr($string,$i,1)=="'")
//                    {
//                        array_push($problemchildren,$i);
//                    }
//                }
//                for ($i=0;$i<count($problemchildren);$i++)
//                {
//                    $string = substr_replace($string, "\\", ($problemchildren[$i] + $i), 0);
//                }
//                return($string);
//
//            }
            function FindTag($tagName)
            {
                $connection=new mysqli("localhost","root");
                $tag=$connection->query("SELECT * FROM questionsdb.tags WHERE TagName='bruh'");
                $connection->close();
                if (!is_null($tag->fetch_assoc())) {
                    return ($tag);
                }
                else
                {

                    return("false");
                }
            }

            if(isset($_POST['submit']))
            {





//                if ($a=="false") {
//                   // AddTag("bruh");
//                }
//                else
//                {
//                    //output result off search
//                    $conn=new mysqli("localhost","root");
//                    $result=$conn->query("SELECT * FROM questionsdb.tags WHERE TagName='bruh'");
//                    //echo "Question      Answer <br>";
//                    $Tagnames=[];
//                    $id=[];
//                    //create lists based of data obtained from database
//                    for ($i=0;$i<$result->num_rows;$i++)
//                    {
//                        $assoc=$result->fetch_assoc();
//                        array_push($Tagnames,$assoc["TagName"]);
//                        array_push($id,$assoc["idTags"]);
//                    }
//                    //output the data in the form of a html table row and data
//                    for ($i=0;$i<sizeof($id);$i++)
//                    {
//                        echo "<tr>";
//                        echo "<td>".$id[$i]."</td><td>".$Tagnames[$i]."</td>";
//                    }
//                    $conn->close();
//                }
                //get the checked boxes as objects
                $connection=new mysqli("localhost", "root");
                $result=$connection->query("SELECT * FROM questionsdb.tags");
                $connection->close();
                $tags=array();
                $tagIDs=array();
                if(isset($_POST["tag"]))
                {
                    //if checkbox is checked
                    if (!empty(($_POST["tag"])))
                    {
                        foreach($_POST["tag"] as $i)
                        {
                            $connection = new mysqli("localhost", "root");

                            $result2=$connection->query("SELECT * FROM questionsdb.tags WHERE TagName='".$i."'");

                            $assoc=$result2->fetch_assoc();

                            array_push($tags, new Tags($assoc["idTags"], $assoc["TagName"], $assoc["Keywords"]));
                            array_push($tagIDs, $assoc["idTags"]);
                        }

                    }
                }



                //echo $tagIDs;
                $questionobj=new Question($_POST["question"],$_POST["answer"],implode(",",$tagIDs));

                foreach ($tags as $i)
                {

                    UpdateTags($questionobj,$i);
                    //$i->Update();
                }







                //add the question and answer to database
                $connection=new mysqli("localhost","root");
                $question= $_POST["question"];
                $answer=$_POST["answer"];

                $question=$questionobj->apostropheCatastropheFix($question);
                $answer=$questionobj->apostropheCatastropheFix($answer);

                $result=$connection->query("SELECT * FROM questionsdb.questions");
                $nextid= ($result->num_rows);
                foreach($questionobj->GetTagsIDs() as $i)
                {
                    echo $i."<br>";
                }
                echo implode(",",$questionobj->GetTagsIDs());
                $connection->query("INSERT INTO questionsdb.questions(ID,UserID,Question,Answer,TagIDs)VALUES (".$nextid.",".$questionobj->GetUser()->GetID().",'".$question."','".$answer."','".implode(",",$questionobj->GetTagsIDs())."')");
                $connection->close();
                echo"Submitted!";
            }

            ?>

        </div>
    </div>
</body>
</html>