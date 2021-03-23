<?php
    session_start();

    require_once('mysql/crud_connector.php');

    if (isset($_POST["login"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        //to prevent mysql injection
        $username = stripcslashes($username);
        $password = stripcslashes($password);

        // Create a query for the database WHERE username = '$username' and password = '$password'
        $a_query = "SELECT * FROM tmanuel_users WHERE usernames = '$username' and passwords = '$password'";

        // Create a query for the database WHERE email = '$username' and password = '$password'
        $b_query = "SELECT * FROM tmanuel_users WHERE emails = '$username' and passwords = '$password'";
        
        /* Get a response from the database by sending the connection
        and the query */

        $result_name = @mysqli_query($conn, $a_query);
        $result_name_b = @mysqli_query($conn, $b_query);

        //to get user to login with the username and password
        if (mysqli_num_rows($result_name) == 1) {
            //if (( $username == $_SESSION["usernames"]  or $username == $_SESSION["emails"]) &&  $password == $_SESSION["passwords"]) {
            if (isset($_POST["Remember"])) {
                setcookie("username", $username, time()+60*60*7);
                setcookie("password", $password, time()+60*60*7);
            }
                $row = $result_name->fetch_assoc();
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $row["usernames"];
                $_SESSION["surname"] = $row["surname"];
                $_SESSION["firstname"] = $row["firstname"];
                $_SESSION["middlename"] = $row["middleName"];
                $_SESSION["email"] = $row["emails"];
                header("location: landingpage.php");
            //}
        }
        
        //to get user to login with the mail and password
        elseif (mysqli_num_rows($result_name_b) == 1) {
            //if (( $username == $_SESSION["usernames"]  or $username == $_SESSION["emails"]) &&  $password == $_SESSION["passwords"]) {
            if (isset($_POST["Remember"])) {
                setcookie("username", $username, time()+60*60*7);
                setcookie("password", $password, time()+60*60*7);
            }
                $row = $result_name_b->fetch_assoc();
                $_SESSION["username"] = $row["usernames"];
                $_SESSION["surname"] = $row["surname"];
                $_SESSION["firstname"] = $row["firstname"];
                $_SESSION["middlename"] = $row["middleName"];
                $_SESSION["email"] = $row["emails"];
                header("location: landingpage.php");
            //}
        }

        else {
            $error = "username or password incorrect, please try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> login </title>
    <link href ="styles/login.css?v=<?php echo time();?>" type = "text/css" rel = "stylesheet" >
</head>
<body>

    <div class="container">
        <form class = "first-form" action = "login.php" method = "POST" autocomplete="off">
            <div class="form-group">
                <label for = "username"> Username </label>
                <input name = "username" class = "formControl" type = "text" placeholder = "username or email" required>
            </div>
            <div class="form-group">
                <label for = "password"> password </label>
                <input name = "password" class = "formControl" type = "password" placeholder = "************"required>
            </div>
            <span class = "rmbr"> <input type = "checkbox" name = "Remember"> Remember Me </span>
            <div class = "form-group-1">
            <input type ="submit" name = "login" class = "btn" value = "Login" >
            </div>
        </form>
        <span class = "echo"> <?php if (isset($error)) {echo "<br> $error";} ?> </span>
    </div>
</body>
</html>