
<!DOCTYPE html>
<html>

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

<body>

 
<div class="hero_area">
    <!-- header section strats -->
    <?php include './common/before_login.php' ?>
    <div style="padding: 6%; background-color:#587B75;">
        <div class="text-center">
            <h1 style="font-weight: 800; color:white; text-transform:uppercase;">Exploy Your Books</h1>
        </div>
    </div>
    <div class="container mt-5 mb-5">
    <div class="text-start p-3 rounded" style="background-color: #E5E8E7;">
        <h5>Filter Books</h5>
        <hr/>
        <div class="row text-start ">
            
            <div class="col">
                
                <div class="form-group">
                    <label for="classType">Book Name</label>
                    <input type="text" class="form-control" id="search_term"/>
                </div>
            </div>
        </div>
        <div class="pt-3 text-right">
            <button class="btn btn-danger" onclick="loadBooks()">Clear</button>
            <button class="btn btn-success" onclick="search_class()">Filter</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <div class="card  border-0">
            <div class="card-body">
                <div class="row" id="bookContainer">
                    
                    
                    
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>


    <?php include './common/before_footer.php' ?>

    <!-- jQery -->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="./js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="./js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="./js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        loadBooks();
        function loadBooks() {
            $.ajax({
                url: './action/book.php', 
                type: 'POST', 
                data:{
                    status : "all_book"
                },
                dataType: 'json',
                success: function (response) {
                    const books = response.books;
                    const bookContainer = $('#bookContainer');

                    // Clear any existing book cards
                    bookContainer.empty();

                    // Iterate through the book data and create cards
                    $.each(books, function (index, book) {
                        const availabilityText = book.availability === 'out_of_stock' ? 'Out Of Stock' : ' Available'; 
                        const isButtonDisabled = book.availability === 'out_of_stock' ? true : false; 

                        const cardHtml = `
                            <div class="col-3 mb-3">
                                <div class="card  h-100">
                                        <div class="card-img-container">
                                            <img src="${book.img}" class="card-img-top" style='height:300px;' alt="Book Image">
                                        </div>                                    
                                        <div class="card-body">
                                        <h5 class="card-title">${book.title}</h5>
                                        <p style='line-height:12px;' class="card-text">Author: ${book.author_name}</p>
                                        <p style='line-height:12px;' class="card-text">Price: Rs.${book.price}</p>
                                        <p style='line-height:12px;' class="card-text">Availability: ${availabilityText}</p>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Append the generated card HTML to the container
                        bookContainer.append(cardHtml);
                    });
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }

        function search_class(){
            var search_term = document.getElementById("search_term").value;
            $.ajax({
                url: './action/book.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    status: "search_book",
                    bookSearchTerm : search_term
                },
                success: function (response) {
                    console.log(response);
                    
                    const bookContainer = $('#bookContainer');
                    bookContainer.empty();
                    
                    $.each(response, function (index, book) {
                        const availabilityText = book.availability === 'out_of_stock' ? 'Out Of Stock' : 'Stock Available'; 

                        const cardHtml = `
                            <div class="col-3 mb-3">
                                <div class="card  h-100">
                                        <div class="card-img-container">
                                            <img src="${book.img}" class="card-img-top" style='height:300px;' alt="Book Image">
                                        </div>                                    
                                        <div class="card-body">
                                        <h5 class="card-title">${book.title}</h5>
                                        <p style='line-height:12px;' class="card-text">Author: ${book.author_name}</p>
                                        <p style='line-height:12px;' class="card-text">Price: Rs.${book.price}</p>
                                        <p style='line-height:12px;' class="card-text">Availability: ${availabilityText}</p>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Append the generated card HTML to the container
                        bookContainer.append(cardHtml);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
 </body>
</html>