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
    <?php include './common/header_customer.php'; ?>
    <div class="container">
        
        <h4 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Buy You Favourite Books..</h4>
        <hr/>
        <div class="row">
          <div class="col-4">
              <div class="card">
                <div class="card-body border-0">
                    <div class="card  h-100 border-0">
                            <div class="card-img-container">
                                <img src="" class="card-img-top" style='height:300px;' alt="Book Image">
                            </div>                                    
                            <div class="card-body">
                                <h5 class="card-title text-center" id="title"></h5>
                                <br/>
                                <p style='line-height:12px;' class="card-text author pt-2"></p>
                                <p>Price : Rs. <span style='line-height:12px;' class="card-text price" id="price"></span></p>
                                <p style='line-height:12px;' class="card-text category" id="category"></p>
                                <p style='line-height:12px;' class="card-text availability"></p>
                            </div>
                         
                            <div class="card-footer mt-4">
                                <!-- Quantity input -->
                                <input type="hidden" class="form-control" placeholder="Quantity" value="1" aria-label="Quantity" id="qty" aria-describedby="basic-addon2">
                                <button class="btn btn-outline-primary" style="width: 100%;" type="button" onclick="add_to_cart()">Add to Cart</button>
                               
                                <br/>
                                <hr/>
                                <br/>
                                <center>
                                    <label>ITEM ADD TO WISHLIST</label><br/>
                                    <button class="btn btn-outline-secondary" type="button" onclick="wishlist_fun()">Add to Wishlist</button>
                                </center>
                            </div>

                    </div>
                </div>
              </div>
          </div>
          <div class="col-8">
              <div class="card h-100">
                  <div class="card-body p-4">
                      <div class="row" >
                            <br/>
                            <h4 class="text-uppercase">Book Description</h4>
                            <hr/>
                            <div id="description_div"></div>
                      </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>

        const queryParams = new URLSearchParams(window.location.search);
        const bookId = queryParams.get('id');

        // Make an AJAX request to fetch book details
        $.ajax({
            url: './action/book.php',
            type: 'POST',
            dataType: 'json',
            data: {
                status: 'get_one_book',
                id: bookId
            },
            success: function (response) {
                
                if (response.status === 'success') {
                    const book = response.book;
                    const cardContainer = $('.card-body.border-0');

                    // Update the HTML elements with book details
                    cardContainer.find('.card-img-top').attr('src', book.img);
                    cardContainer.find('.card-title').text(book.title);
                    cardContainer.find('.card-text.author').text(`Author: ${book.full_name}`);
                    cardContainer.find('.card-text.price').text(`${book.price}`);
                    cardContainer.find('.card-text.category').text(`Book Category: ${book.category_name}`);
                    const availabilityText = book.availability === 'out_of_stock' ? 'Not Available' : 'Available'; 
                    cardContainer.find('.card-text.availability').text(`Availability: ${availabilityText}`);

                    // Update the "View Details" button href
                    const viewDetailsButton = cardContainer.find('.btn.btn-primary');
                    viewDetailsButton.attr('href', `./customer_one_book.php?id=${book.id}`);

                    // Enable or disable the button based on availability
                    if (book.in_stock) {
                        viewDetailsButton.removeClass('disabled');
                    } else {
                        viewDetailsButton.addClass('disabled');
                    }

                    document.getElementById("description_div").innerHTML = book.description;
                    
                } else {
                    // Handle the case where the book was not found or an error occurred
                    console.error('Error:', response.message);
                }
            },
            error: function (error) {
                // Handle AJAX error
                console.error('AJAX Error:', error);
            },
        });

        function wishlist_fun(){
           
            $.ajax({
                url: './action/wishlist.php',
                type: 'POST',
                data: {
                    status: 'add',
                    item_id: bookId,
                    product_name: document.getElementById("title").innerHTML,
                    userid:getCookie("username")
                },
                dataType: 'json',
                success: function(response) {
                   
                    Swal.fire({
                        icon: response.status,
                        title: response.status,
                        text: response.message,
                    });
                },
                error: function(response) {
                    // Handle AJAX error
                     Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Item added successfully.",
                    });
                }
            });
        }

          

        function add_to_cart(){
            $.ajax({
                url: './action/cart.php', 
                type: 'POST',
                data: {
                    status: 'add_to_cart',
                    productId: bookId,
                    productName: document.getElementById("title").innerHTML,
                    quantity: document.getElementById("qty").value,
                    price: document.getElementById("price").innerHTML,
                    user_id: getCookie("username")
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then(function () {
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Handle AJAX error here
                    console.error(error);
                }
            });
        }

          
        function getCookie(cookieName) {
            var cookies = document.cookie.split(';');

            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].trim(); 
                if (cookie.indexOf(cookieName + '=') === 0) {
                    return cookie.substring(cookieName.length + 1);
                }
            }

            return null;
        }
    </script>
  </body>
</html>