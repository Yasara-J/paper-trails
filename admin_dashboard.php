<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet" >
    <title>Paper Trails</title>

  </head>
  <body class="bg_color" >
    <?php include './common/header_author.php'; ?>
    <div class="container">
        <div class="row pb-3 mt-5" style="background-color: white; border-radius:20px; border:2px solid #BA8B02;">
            <div class="col" style="padding-left: 5%;" >
                <h2 class="text-uppercase" style="padding-top: 10%; font-weight:700;">ADMIN dashboard</h2>
                <hr/>
            </div>
            <div class="col text-end pe-5">
                <img src="./img/admin.png" style="width: 52%; padding-top:20%; padding-bottom:5%;" />
            </div>
        </div>
        <h4 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Action of the Admin panel</h4>
        <hr/>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col" >
            <div class="card" style="background-color: #EAE4D3;" onclick="window.location.href='admin_book_category.php'">
              <div class="p-4 text-center">
                <img src="./img/books_category.png" class="card-img-top" alt="..." style="width: 160px;">
              </div>
              <div class="card-body">
                <h4 class="card-title text-uppercase text-center">Book Category</h4>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card"  style="background-color: #D3D6DE;" onclick="window.location.href='admin_book.php'">
              <div class="p-4 text-center">
                <img src="./img/books.png" class="card-img-top" alt="..." style="width: 160px;">
              </div>
              <div class="card-body">
                <h4 class="card-title text-uppercase text-center">Books</h4>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card"  style="background-color: #E1E8DF;" onclick="window.location.href='admin_book_author.php'">
              <div class="p-4 text-center">
                <img src="./img/author.png" class="card-img-top" alt="..." style="width: 160px;">
              </div>
              <div class="card-body">
                <h4 class="card-title text-uppercase text-center">Author</h4>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card"  style="background-color: #E1E8DF;" onclick="window.location.href='admin_feedbacks.php'">
              <div class="p-4 text-center">
                <img src="./img/icons8-bookmark.gif" class="card-img-top" alt="..." style="width: 160px;">
              </div>
              <div class="card-body">
                <h4 class="card-title text-uppercase text-center">Feedbacks</h4>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card"  style="background-color: #EAE4D3;" onclick="window.location.href='admin_cupon.php'">
              <div class="p-4 text-center">
                <img src="./img/coupon.png" class="card-img-top" alt="..." style="width: 160px;">
              </div>
              <div class="card-body">
                <h4 class="card-title text-uppercase text-center">COUPON</h4>
              </div>
            </div>
          </div>
      </div>
    </div>
     <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <?php include './common/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>