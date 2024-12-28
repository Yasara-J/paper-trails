<!doctype html>
<html lang="en">
  <head>

    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <link rel="icon" href="./img/favicon.png" type="image/gif" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Paper Trails</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="./css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="./css/style1.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="./css/responsive.css" rel="stylesheet" />

  </head>
  <body class="bg_color" >
    <?php include './common/before_login.php' ?>
    <div style="padding: 6%; background-color:#587B75;">
        <div class="text-center">
            <h1 style="font-weight: 800; color:white; text-transform:uppercase;">SELECT YOUR USER TYPE..</h1>
        </div>
    </div>
    <div class="container" style="margin-top: 5%;margin-bottom: 15%;">
        <div class="row">
            <div class="col">
                <div class="card" style="cursor: pointer;">
                    <img src="https://images.wallpaperscraft.com/image/single/pen_petals_letter_189319_3840x2400.jpg" class="card-img-top" alt="Customer Image" style="height:280px;">
                    <div class="card-body" style="background-color:aliceblue;">
                        <h2 class="card-title text-uppercase text-center fw-bold" onclick="cus_reg()">Customer</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="cursor: pointer;">
                    <img src="https://c0.wallpaperflare.com/preview/129/864/44/book-reading-reader-opened-book.jpg" class="card-img-top" alt="Customer Image" style="height:280px;">
                    <div class="card-body" style="background-color:aliceblue;">
                        <h2 class="card-title text-uppercase text-center fw-bold" onclick="author_reg()">Author</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include './common/before_footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function cus_reg(){
            window.location.href = "./cus_reg.php";
        }   
        
        function author_reg(){
            window.location.href = "./author_self_reg.php";
        }
    </script>
  </body>
</html>