<?php 

require_once('mysql/crud_connector.php');

session_start();

/* this helps us get the inputted data and if the information is
 not processed, we limit user's stress by retaining some of the 
 previous inputs on the form field */


$user_a = '7-10'. 'characters';
$user_b = 'surname';
$user_c = 'firstname';
$user_d = 'eg@example.com';

if (isset($_SESSION['message'])){
    $error_a = $_SESSION['message'];
}
if (isset($_SESSION["usernames-a"])){
    $user_a = $_SESSION['usernames-a'];
}
if (isset($_SESSION["surname-a"]) ){
    $user_b = $_SESSION["surname-a"];
}
if (isset($_SESSION['firstname-a']) ){
    $user_c = $_SESSION["firstname-a"];
}
if (isset($_SESSION["emails-a"])){
    $user_d = $_SESSION["emails-a"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href ="styles/login.css?v=<?php echo time();?>" type = "text/css" rel = "stylesheet" >
</head>
<body>    
    <div class="container">
        <form class = "first-form" action = "mysql/crud_insert.php" method = "POST" autocomplete="off">
            <div class="form-group-2">
                <label for = "usernames"> Username </label>
                <input name = "usernames" value = <?php echo $user_a; ?> class = "formControl" type = "text" required>
            </div>
            <div class="form-group-2">
                <label for = "surname"> Surname </label>
                <input name = "surname" value = <?php echo $user_b; ?> class = "formControl" type = "text" required>
            </div>
            <div class="form-group-2">
                <label for = "firstname"> Firstname </label>
                <input name = "firstname" value = <?php echo $user_c; ?> class = "formControl" type = "text" required>
            </div>
            <div class="form-group-2">
                <label for = "middleName"> Middle Name </label>
                <input name = "middleName" class = "formControl" type = "text">
            </div>
            <div class="form-group-2">
                <label for = "emails"> Email </label>
                <input name = "emails" value = <?php echo $user_d; ?> class = "formControl" type = "email" placeholder = "123@example.com" required>
            </div>
            <div class="form-group-2">
                <label for = "confirm email"> Confirm Email </label>
                <input name = "confirmEmail" class = "formControl" type = "email" required>
            </div>
            <div class="form-group-2">
                <label for = "passwords"> password </label>
                <input name = "passwords" class = "formControl" type = "password" required>
            </div>
            <span> <input type = "checkbox" name = "T&amp;C" required> Accept Terms &amp; Conditions </span>
            <div class = "form-group-1">
                <input type ="submit" class = "btn" name = "register" value = "Register" >
            </div>
        </form>

        <span class = "echo"> <?php if (isset($error_a)) {echo "<br> $error_a";} ?> </span>
    </div>
</body>
</html>
