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
<a href="Index.html", class="home"><h1 class="home">Bruh.com</h1></a>
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
    if (isset($_POST["submit"])) {
        $success=false;
        $username="";
        $conn = new mysqli("localhost", "root");
        $result = $conn->query("SELECT ID,Username, Email, Password FROM questionsdb.users");
        $conn->close();
        foreach ($result as $i) {
            if (($_POST["username"] == $i["Username"] or $_POST["username"] == $i["Email"]) and $_POST["password"] == $i["Password"]) {
                $success=true;
                $username=$i["Username"];
                break;
            }
            else {
                $success=false;
            }
        }
        if ($success)
        {
            //list of user objects variables (records fields)
            //$userattr=[];
            echo "welcome back ". $username."!";

            foreach($result as $i)
            {
                echo $i["Username"];
                if ($i["Username"]==$username)
                {
                    echo
                    "<script>
                        class User
                        {
                            constructor(id,username)
                            {
                                this.id=id;
                                this.username=username;
                                //this.password=password;
                                //this.email=email;
                            }
                            SayName()
                            {
                                console.log(this.username);
                            }
                        }
                        //let user=new User(".$i['ID'].",".$i['Username'].");
                          //let user=new User(1,'bruh');
                          //user.SayName();
                        
                
                    </script>";

//
                }

            }

        }
        else{
            echo "username or password is incorrect";// show password requirements
        }
    }


    ?>
</div>


</body>
</html>