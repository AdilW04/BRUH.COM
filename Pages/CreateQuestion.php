<?php session_start()?>
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
                <input type=text id="question" name="question"> < Question </input>
                <input type=text id="answer" name="answer" > < Answer </input>
<!--                <button class="next" type="submit" name="submit" ></button>-->
                <br>
                <br>

                <input type="submit" name="submit" value="NEXT">
            </form>
            <?php
            $dom= new DOMDocument();
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
            if(isset($_POST['submit']))
            {
                class Question
                {
                    private $question="";
                    private $answer="";

                    function __construct($q,$a)
                    {
                        $this->question=$q;
                        $this->answer=$a;
                    }
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
                //parse tag from db into tag object
                class Tags
                {
                    private $name="";
                    private $keywords="";
                    private $idTags=0;
                    function __construct($idTags,$name,$keywords)
                {
                    $this->name=$name;
                    $this->keywords=$keywords;
                    $this->idTags=$idTags;

                }
                    function UpdateTags($question){

                    }
                }
                function FindTag($tagName)
                {
                    $connection=new mysqli("localhost","root");
                    $tag=$connection->query("SELECT * FROM questionsdb.tags WHERE TagName='".$tagName."'");
                    $numrows=$connection->query("SELECT * FROM questionsdb.tags")->num_rows;
                    $connection->close();
                    //if 'can't' find tag
                    echo is_null($tag->fetch_assoc());
                    if (is_null($tag->fetch_assoc())){
                        $connection=new mysqli("localhost","root");                              //next ID,   Name of tag   empty space for keywords
                        $connection->query("INSERT INTO questionsdb.tags(idTags, TagName, Keywords) VALUES(".$numrows.",'".$tagName."','"." "."') ");
                        $connection->close();
                    }



                }
                echo"Submitted!";
                FindTag("ad
                ");
                FindTag("ad");
                FindTag("ad");

                $Q=new Question("what is this?", "no it isn't");

//                $a=$Q->GetKeyWords();
//                foreach($a as $i)
//                {
//                    echo $i.",";
//                }




                //add the question and answer to database
                $connection=new mysqli("localhost","root");
                $question= $_POST["question"];
                $answer=$_POST["answer"];

                $question=apostropheCatastropheFix($question);
                $answer=apostropheCatastropheFix($answer);

                $result=$connection->query("SELECT * FROM questionsdb.questions");
                $nextid= ($result->num_rows);
                $connection->query("INSERT INTO questionsdb.questions(ID,Question,Answer)VALUES (".$nextid.",'".$question."','".$answer."')");
                $connection->close();
            }

            ?>

        </div>
    </div>
</body>
</html>