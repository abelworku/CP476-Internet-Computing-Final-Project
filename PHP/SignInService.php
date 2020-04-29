<?php 
    session_start();
?>

<?php 

include '../PHP/config.php';

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

$connectionError = mysqli_connect_error(); 
if ($connectionError != null) { 
    $output = "<p>Detected an error. Not able to connect to the database</p>" . $connectionError;
    exit($output); 
}

?> 

<?php 

    echo "The email is: " . $_POST['signInEmailInput']; 
    echo "The password is: " . $_POST['signInPasswordInput']; 

    //Check if username and password in database, if not, output page below 
    $userEmail = $_POST['signInEmailInput'];
    $userPassword = $_POST['signInPasswordInput']; 

    $sql = "
    SELECT Username, Password
    FROM Users
    WHERE Username = ?
    "; 

    $statement = mysqli_prepare($connection, $sql);     
    mysqli_stmt_bind_param($statement, 's', $userEmail); 
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    
    $row = mysqli_fetch_assoc($result);

    if (!($row)) { 
        header("Location: ../HTML/SignIn.php"); 
    } else { 
        if (password_verify($userPassword, $row['Password'])) { 
            print_r($_SESSION['userName']); 
            $_SESSION['userName'] = $userEmail; 
            header("Location: ../HTML/Home.php");
        } else { 
            header("Location: ../HTML/SignIn.php"); 
        }
    }



?> 