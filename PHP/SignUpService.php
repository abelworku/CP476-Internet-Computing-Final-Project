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

    echo "The email is: " . $_POST['signUpEmailInput']; 
    echo "The password is: " . $_POST['signUpPasswordInput'];

    $userEmail = $_POST['signUpEmailInput'];
    $userPassword = $_POST['signUpPasswordInput']; 
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT); 

    $sql = "
    INSERT INTO Users 
    VALUES (?, ?)
    ";
    
    $statement = mysqli_prepare($connection, $sql);  
    mysqli_stmt_bind_param($statement, 'ss', $userEmail, $hashedPassword); 
    mysqli_stmt_execute($statement);
    
    $_SESSION['userName'] = $userEmail; 

    header("Location: ../HTML/Home.php"); 
?>