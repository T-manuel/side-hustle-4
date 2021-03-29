<?php

    session_start();

    require_once('mysql/crud_connector.php');

    $Name = $_SESSION['username'];
    $Email = $_SESSION['email'];
    if(isset($_SESSION['id'])){
        $userID = $_SESSION['id'];
    }

    if ($_SESSION["middlename"] == '') {
       $midName = "NaN";
    }

    if ($_SESSION["middlename"] != '') {
        $midName = $_SESSION["middlename"];
    }

    if (isset($_POST['update'])){
        $userName = $_POST["username"];
        $mail = $_POST["email"];
        $firstName = $_POST["firstname"];
        $surName = $_POST["surname"];
        $middleName = $_POST["middlename"];
        
        //avoid user from updating the username or email an existing username or email
        
        /* $e_query = "SELECT * FROM tmanuel_users WHERE usernames = $username";
        $result_name_e = @mysqi_query($conn, $e_query);
        
        $e_query = "SELECT * FROM tmanuel_users WHERE emails = $mail";
        $result_name_e = @mysqi_query($conn, $e_query);
        
        if ((mysqli_nums_rows()) */

        $conn->query("UPDATE tmanuel_users SET usernames = '$userName', emails = '$mail', surname = '$surName',
            firstname = '$firstName', middleName = '$middleName' WHERE tmanuel_users.id = $userID");
        
        $Name = $userName;
        $Email = $mail;
        $_SESSION["firstname"] = $firstName;
        $_SESSION["surname"] = $surName;

        if ($middleName == '') {
            $midName = "NaN";
         }
     
         if ($middleName != '') {
             $midName = $middleName;
         }
    }

    //this deletes users data and returns to regitration
    if (isset($_GET['delete'])) {
        $userID =  $_GET['delete'];
        $conn->query("DELETE FROM tmanuel_users WHERE tmanuel_users.id = $userID");

        header("location: index.php");
    }

    $message_Toast_1 = "<h2> <strong> Hello " . $Name . ", Welcome to your Side hustle profile </strong> </h2>" .  "<br>";
    $message_Toast_2 = "<p> Below is your registered details, click on the edit button if you wish to change them. </p> <br>";
    
    $logout = "<a href = 'login.php'class = 'phpOutput2'> Logout </a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href = "styles/landingpage.css?v=<?php echo time(); ?>" type = "text/css" rel = "stylesheet" >
    <title>CRUD</title>
</head>
<body>

    <!-- prints out the user's details -->

    <div class="container">
        <span class = "phpOutput"> <?php echo $message_Toast_1; ?> </span>
        <span class = "phpOutput1"> <?php echo $message_Toast_2; ?> </span>

        <form action= "landingpage.php" method = "POST" class="form-control" autocomplete="off">

            <div class="formgroup">
                <label for = "username" class = "formlabel"> Username </label>
                <input name = "username" value = <?php echo $Name; ?>  class = "formControl" id = "formControl-1" type = "text" required>
                <span name = "edit" class = "btn" id = "btnEdit-1"> Edit </span>
            </div>
            <div class="formgroup">
                <label for = "email" class = "formlabel"> email </label>
                <input name = "email" value = <?php echo $Email; ?> class = "formControl" id = "formControl-2" type = "text"required>
                <span name = "edit" class = "btn" id = "btnEdit-2"> Edit </span>
            </div>
            <div class="formgroup">
                <label for = "firstname" class = "formlabel"> firstname </label>
                <input name = "firstname" value = <?php echo $_SESSION["firstname"]; ?> class = "formControl" id = "formControl-3" type = "text" required>
                <span name = "edit" class = "btn" id = "btnEdit-3"> Edit </span>
            </div>
            <div class="formgroup">
                <label for = "surname" class = "formlabel"> surname </label>
                <input name = "surname" value = <?php echo $_SESSION["surname"]; ?>  class = "formControl" id = "formControl-4" type = "text" required>
                <span name = "edit" class = "btn" id = "btnEdit-4"> Edit </span>
            </div>
            <div class="formgroup">
                <label for = "middlename" class = "formlabel"> middlename </label>
                <input name = "middlename" value = <?php echo $midName; ?> class = "formControl" id = "formControl-5" type = "text" >
                <span name = "edit" class = "btn" id = "btnEdit-5"> Edit </span>
            </div>
            <div class="formgroup1">
                <input name = "update" class = "btn" id = "btn-save" type = "submit" value = "Update">
            </div>
        </form>

        <div class="delete">
            Click <a href="landingpage.php?delete=<?php echo $userID; ?>" class="delete-entry">
                <input name = "delete" class = "btn" id = "btn-delete" type = "submit" value = "Delete">
            </a> to delete your details with us.
        </div>

        <span> <?php echo $logout; ?> </span>
    </div>

    <script>
        let btn_1 = document.querySelector("#btnEdit-1");
        let btn_2 = document.querySelector("#btnEdit-2");
        let btn_3 = document.querySelector("#btnEdit-3");
        let btn_4 = document.querySelector("#btnEdit-4");
        let btn_5 = document.querySelector("#btnEdit-5");
        let form_1 = document.querySelector("#formControl-1");
        let form_2 = document.querySelector("#formControl-2");
        let form_3 = document.querySelector("#formControl-3");
        let form_4 = document.querySelector("#formControl-4");
        let form_5 = document.querySelector("#formControl-5");

        form_1.setAttribute('readonly', true);
        form_2.setAttribute('readonly', true);
        form_3.setAttribute('readonly', true);
        form_4.setAttribute('readonly', true);
        form_5.setAttribute('readonly', true);
        
        btn_1.addEventListener('click', () => {
            form_1.removeAttribute('readonly');
        })
        btn_2.addEventListener('click', () => {
                form_2.removeAttribute('readonly');
        })
        btn_3.addEventListener('click', () => {
                form_3.removeAttribute('readonly');
        })
        btn_4.addEventListener('click', () => {
                form_4.removeAttribute('readonly');
        })
        btn_5.addEventListener('click', () => {
                form_5.removeAttribute('readonly');
        })

    </script>
</body>
</html> 
