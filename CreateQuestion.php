<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>F-encore: create</title>
    <link href="StyleSheet.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <script src="Question.js"></script>
    <a href="Index.html"><h1>F-Encore</h1></a>
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