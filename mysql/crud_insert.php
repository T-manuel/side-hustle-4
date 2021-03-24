<?php

    require_once('crud_connector.php');
    session_start();

/*    
    $_SESSION["usernames-a"] = $name;
    $_SESSION["surname-a"] = $surname;
    $_SESSION["firstname-a"] = $firstname;
    $_SESSION["emails-a"] = $email;
*/

    if (isset ($_POST["register"])) {
        $name = $_POST["usernames"];
        $passID = $_POST["passwords"];
        $surname = $_POST["surname"];
        $firstname = $_POST["firstname"];
        $middleName = $_POST["middleName"];
        $email = $_POST["emails"];
        $confirmEmail = $_POST["confirmEmail"];
    
        if ($email == $confirmEmail){
			
			// Create a query for the database to prevent double usernames
			$c_query = "SELECT * FROM tmanuel_users WHERE usernames = '$name'";
			$d_query = "SELECT * FROM tmanuel_users WHERE emails = '$email'";

			/* Get a response from the database by sending the connection
			and the query */

			$result_name_c = @mysqli_query($conn, $c_query);
			$result_name_d = @mysqli_query($conn, $d_query);

			//this section checks that the user's mail and username is unique
			/*if ((mysqli_num_rows($result_name_c) && mysqli_num_rows($result_name_d)) == 0) {

				$conn->query("INSERT INTO tmanuel_users (usernames, passwords, emails, surname, firstname, middleName) VALUES ('$name',
				'$passID', '$email', '$surname', '$firstname', '$middleName')") or die("unable to connect to MySQL at the moment ".$conn->connect_error);

				unset ($_SESSION["usernames-a"]);
				unset ($_SESSION["surname-a"]);
				unset ($_SESSION["firstname-a"]);
				unset ($_SESSION["emails-a"]);
				unset ($_SESSION["message"]);

				/*session_start();
				$_SESSION["usernames"] = $name;
				$_SESSION["passwords"] = $passID;
				$_SESSION["emails"] = $email;

				header("location: ../login.php");
			}*/
			elseif ((mysqli_num_rows($result_name_c) && mysqli_num_rows($result_name_d)) == 1){

				$_SESSION['message'] = "username and email exists";
				$_SESSION["usernames-a"] = $name;
				$_SESSION["surname-a"] = $surname;
				$_SESSION["firstname-a"] = $firstname;
				$_SESSION["emails-a"] = $email;
				
				header("location: ../index.php");
				
			}
			elseif ((mysqli_num_rows($result_name_c) || mysqli_num_rows($result_name_d)) == 1) {
				
				if (mysqli_num_rows($result_name_c) == 1) {
					$_SESSION['message'] = "username exists";
					$_SESSION["usernames-a"] = $name;
					$_SESSION["surname-a"] = $surname;
					$_SESSION["firstname-a"] = $firstname;
					$_SESSION["emails-a"] = $email;
					
					header("location: ../index.php");
					
				}
				elseif (mysqli_num_rows($result_name_d) == 1) {
					$_SESSION['message'] = "email exists";
					$_SESSION["usernames-a"] = $name;
					$_SESSION["surname-a"] = $surname;
					$_SESSION["firstname-a"] = $firstname;
					$_SESSION["emails-a"] = $email;
					
					header("location: ../index.php");
				}
			}
			
        }
        else {

            $_SESSION['message'] = "your mail didn't match. Input again";
            $_SESSION["usernames-a"] = $name;
            $_SESSION["surname-a"] = $surname;
            $_SESSION["firstname-a"] = $firstname;
            $_SESSION["emails-a"] = $email;
            
            header("location: ../index.php");
        }
    }

?>
