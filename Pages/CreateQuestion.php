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

                <input type="text" id="tags"> < </input>
                <input type="button" onclick="AddTag()" value="ADD TAG">
                <br><br><br>
                <p id="outputTags"> Tags: </p>

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
            if (isset ($_GET['question']))
            {


                $connection=new mysqli("localhost","root");
                //insert question into database
                $result=$connection->query("SELECT * FROM questionsdb.questions");
                $nextid= ($result->num_rows);
                $connection->query("INSERT INTO questions (ID,Question)VALUES (1,'bruh')");
                echo $_GET['question'];
                $connection->close();
            }
            if(isset($_POST['submit']))
            {

                echo"Submitted!";


                //add the question and answer to database
                $question= $_POST["question"];
                $answer=$_POST["answer"];

                $question=apostropheCatastropheFix($question);
                $answer=apostropheCatastropheFix($answer);
                echo"<script>
                let question=new Question('bruh', 'bruh2');
                let questionstring=JSON.stringify(question);
                window.location.href='CreateQuestion.php?question='+questionstring;
                </script>";




            }

            ?>

        </div>
    </div>
</body>
</html>