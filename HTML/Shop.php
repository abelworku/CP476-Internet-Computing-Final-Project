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
        <title>Shop | Whimsy</title> 
        
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
        
    </head>

    <body class="bg-light">
        <div class="container-fluid bg-white">
            
            <?php include '../PHP/header.php';?>
            
            <div class="mainContainer">                
                
                <!--Search form-->
                <form class="mb-4" style="padding-left: 10%; padding-right: 10%;">
                    <div class="form-row mb-3">
                        <div class="col-sm-12 col-md-4">
                            <h1 class="display-4 text-center">Category</h1>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <h1 class="display-4 text-center">Price</h1>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <h1 class="display-4 text-center">Rating</h1>
                        </div>
                        
                    </div>
                    
                    <div class="form-row mb-3">
                        <div class="col-sm-12 col-md-4">
                            <select class="custom-select" name="category">
                                <option selected value="0">All Categories</option>

                                <?php  
                                    $sql = "
                                    SELECT CategoryID, CategoryName 
                                    FROM Category
                                    ";

                                    if ($result = mysqli_query($connection, $sql)) { 

                                        while ($row = mysqli_fetch_assoc($result)) { 
                                            echo "<option value='" . $row['CategoryID'] . "'>" . $row['CategoryName'] . "</option>";
                                        }

                                    } 


                                ?>

                            </select>
                        </div>
                        
                        <div class="col-sm-12 col-md-4"> 
                            <select class="custom-select" name="price">
                                <option selected value="0">All Prices</option>
                                <option value="1">Under $50</option>
                                <option value="2">$50 to $150</option>
                                <option value="3">$150 to $500</option>
                            
                            </select>
                            
                        </div>
                        
                        <div class="col-sm-12 col-md-4">
                            <select class="custom-select" name="rating">
                                <option selected value="0">All Ratings</option>
                                <option value="1">3 Stars and Below</option>
                                <option value="2">4 Stars</option>
                                <option value="3">5 Stars</option>
                            
                            </select>                            
                        </div>    
                    </div>
                    
                    <div class="form-row text-center">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg font-weight-light mt-4 px-4 py-2">Search</button>
                        </div>
                        
                    </div>

                </form> <!-- Search form --> 
                
                <div class="border-top mb-5 mt-5 ml-5 mr-5"></div>

               
                <div class="px-5">
                
                    
                    <!--Product List -->
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3">

                        <?php

                        if (empty($_GET['category']) && empty($_GET['price']) && empty($_GET['rating'])) { 
                            $sql = "
                                SELECT Name, Description, ImageFileName, Price, ProductID
                                FROM Products
                                LIMIT 50
                            ";

                            if ($result = mysqli_query($connection, $sql)) { 
                                while ($row = mysqli_fetch_assoc($result)) { 
                                ?>
                                <div class="col mb-4">
                                    <div class="card shopCard">
                                        <a href="product-page.php?<?php echo $row['ProductID'];   /* ProductID */     ?>">
                                            <img src="../Images/shop/<?php echo $row['ImageFileName'];      /* ImageFileName */     ?>.jpg" class="card-img-top">
                                        </a>
                                        
                                        <div class="card-body">
                                            
                                            <h5 class="card-title">
                                                <a href="product-page.php?<?php echo $row['ProductID'];   /* ProductID */     ?>" id="shopTitleLink">
                                                    <?php echo $row['Name'];     /* Name */   ?>
                                                </a>
                                            </h5>
                                            
                                            <h6 class="card-subtitle mb-2 text-muted">CDN $<?php echo $row['Price'];     /* Price */   ?></h6>

                                            <p class="card-text text-truncate"><?php echo $row['Description'];    /* Description */   ?></p>

                                            <div class="text-center">
                                                <button type="button" class="btn btn-light btn-outline-dark mb-1" href="product-page.php?<?php echo $row['ProductID'];   /* ProductID */     ?>">
                                                    Shop
                                                </button>

                                                <button type="button" class="btn btn-light btn-outline-dark mb-1" href="#">
                                                    Add to Wish List
                                                </button>

                                                <button type="button" class="btn btn-light btn-outline-dark mb-1" href="#">
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php 
                                }
                            }
                        }
                        ?> 



                    </div> <!-- Product list --> 
                    
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
