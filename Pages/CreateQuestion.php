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
    <a href="Index.html", class="home"><h1 class="home">Bruh.com</h1></a>
    <div>
        <div>
            <br>
            <h2 class="center"> CREATE A QUESTION!</h2>
            <br>
        </div>
        <div class="center">
            <br>
            <form method="post">
                <input type=text id="question" name="question"> < Question </input>
                <input type=text id="answer" name="answer" > < Answer </input>
                <input type="submit" name="submit" value="next">
<!--                <button class="next" type="submit" name="submit" ></button>-->
            </form>
            <?php
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
                echo"Submitted!";
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