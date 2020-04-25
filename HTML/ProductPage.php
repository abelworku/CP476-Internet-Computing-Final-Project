<?php 

include '../PHP/config.php';

//your code for connecting to database, etc. goese here
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

$connectionError = mysqli_connect_error(); 
if ($connectionError != null) { 
    $output = "<p>Detected an error. Not able to connect to the database</p>" . $connectionError;
    exit($output); 
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php 
            $productID = $_GET['productID'];
            
            $sql = "
            SELECT Name 
            FROM Products
            WHERE Products.ProductID = ?
            ";
            
            $statement = mysqli_prepare($connection, $sql); 
            mysqli_stmt_bind_param($statement, 'i', $productID); 
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement); 
        
            $row = mysqli_fetch_assoc($result); 
            
            echo $row['Name']; 
            ?> 
            | Whimsy 
        </title> 
        
<!--        Links to Bootstrap Framework -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
        
        <link href="https://fonts.googleapis.com/css?family=Prata&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

        <link href="../CSS/general.css" rel="stylesheet">
        <link href="../CSS/shop.css" rel="stylesheet">
        <script type="text/javascript" src="../JavaScript/script.js"></script>
        
        <style>
            <?php include('../CSS/general.css') ?>
            <?php include('../CSS/shop.css') ?>
        </style> 
    
    </head>

    <body class="bg-light">
        <div class="container-fluid bg-white">
            
            <?php include '../PHP/header.php';?>
            
            <div class="mainContainer">    
            
                <div class="row">
                    <div class="col-5">
                    
                    </div>
                
                    <div class="col-5">
                    
                    
                    </div>            
                
                
                
                
                
                
                </div>
        
        
        
            </div>
            
            <div class="border-top my-3"></div>
            
            <!--Footer information-->
            <div class="page-footer">
                <div class="footerContainer text-center">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="text-uppercase font-weight-bold">More information</h4>
                            <div class="border-top my-3"></div>
                            <p>Whimsy was founded in 2020, and strives to be a market leader innovating on the concept 
                            of a marketplace, as a community, a public ground, and a place where people can form 
                            relationships.</p>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="text-uppercase font-weight-bold">Contact information</h4>
                            <div class="border-top my-3"></div>
                            <p>2877 Valley Road, San Francisco, California
                            <br>
                            contactWhimsy@whimsy.ca
                            <br>
                            1 222 333 4567 
                        </div>
                    
                    </div>
                
                </div>
                
                            
            </div>            
        
            
            
        </div>
    </body>

</html>