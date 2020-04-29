<?php 
    session_start();
?>

<?php 
    $_SESSION['wishList'] = array(); 
    $_SESSION['cart'] = array(); 
    $_SESSION['recentlyViewed'] = array(); 
    $_SESSION['userName'] = ""; 
    header("Location: ../HTML/SignIn.php"); 

?>