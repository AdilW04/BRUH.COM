<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="StyleSheet.css", type="text/css"/>
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
<script src="FadeAway.js"></script>
<a href="Index.html", class="home"><h1 class="home">F-Encore</h1></a>
<div class="center">

    <?php
    function Answer($chosenQuestion)//chosen question ranging from index 1 to the num_rows (integer) eg: if chosen question=1, will pick the one with index 0
    {
        $question="";
        $answer="";
        $chosenQuestion--;
        $conn=new mysqli("localhost","root");
        $result=$conn->query("SELECT Question,Answer FROM questionsdb.questions WHERE ID=".$chosenQuestion);
        foreach ($result as $i)
        {
            $question= $i["Question"];
            $answer=$i["Answer"];
        }
        echo "<h2>".$question.$answer."</h2> <br>";
        if (isset($_POST["submit"]))
        {
            if(($_POST["answer"])==$answer)
            {
                echo "Well done";
            }
            else
            {
                echo "<h4 id='incorrectmsg'> wrong idiot";
                echo"<script> fadeAway() </script>";

            }
        }
        $conn->close();
    }
    $conn=new mysqli("localhost","root");
    $result=$conn->query("SELECT * FROM questionsdb.questions");
    $numrows=$result->num_rows;
    Answer(rand(1,$numrows));
    $conn->close();
    ?>
    <br>
    <form method="post">
        <input name="answer"> < Answer </input>
        <input type="submit" name="submit">
    </form>
</div>
</body>
</html>