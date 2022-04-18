<?php include '../PHP classes/User.php' ?>
<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!--bp-->
    <title>F-encore: Accounts</title>
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
    <!--bp-->
</head>
<body>
<a href="Index.php" , class="home"><h1 class="home">Bruh.com</h1></a>
<div class="center">


<h1> Sign in here!</h1>
<br>
    <form method="post">
        <input name="username"> <-Username or Email</input>
        <br><br>
        <input type="password" name="password"> <-Password</input>
        <br>
        <br>
        <div class="center">
            <input name="submit" type="submit"></input>
        </div>
    </form>
    <p id="new">New to bruh.com? click <a href="Register.php" class="underline">here</a> to create an account!</p>
    <?php
//    class User
//    {
//        private $userName="";
//        private $ID=0;
//        function __construct($id,$username){
//            $this->userName=$username;
//            $this->ID=$id;
//        }
//        function GetUser()
//        {
//            return($this->userName);
//        }
//        function GetID()
//        {
//            return($this->ID);
//        }


//    }


    if (isset($_POST["submit"])) {
        $success=false;
        $username="";
        $conn = new mysqli("localhost", "root");
        $result = $conn->query("SELECT ID,Username, Email, Password FROM questionsdb.users");
        $conn->close();
    if ($_POST["username"]!="" AND $_POST["password"]!="") {
        foreach ($result as $i) {
            //checks if everything matches

            if (($_POST["username"] == $i["Username"] or $_POST["username"] == $i["Email"]) and $_POST["password"] == $i["Password"]) {
                $success = true;
                $user = new User($i["ID"], $i["Username"]);
                $username = $i["Username"];
                //creates new user object
                break;
            } else {
                $success = false;
            }


        }
    }
    else
    {
        echo "please fill in all the fields properly";
    }

        if ($success)
        {
            //list of user objects variables (records fields)
            //$userattr=[];
            echo "welcome back ". $username."!";
            if (isset($_GET["user"])) {
                echo $_GET["user"];
            }
            $_SESSION["user"]=$user;
            //updates the session with user variable




        }
        elseif ($success==false AND $_POST["username"]!="" AND $_POST["password"]!="" ){
            echo "username or password is incorrect";// show password requirements
        }

    }


    ?>
</div>


</body>
</html>