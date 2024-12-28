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
        
        <h4 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Your Wishlist..</h4>
        <hr/>
        <div class="row">
          
          <div class="col-12">
              <div class="card h-100">
                  <div class="card-body p-4">
                      <div class="row" >
                        <div class="mt-3 text-end">
                            <button  class="btn btn-outline-dark" onclick="back()">Back</button>
                        </div>
                        <table class="table mt-3">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-white text-center fw-normal">Item Code</th>
                                    <th class="text-white text-center fw-normal">Item Name</th>
                                    <th class="text-white text-center fw-normal">Price</th>
                                    <th class="text-white text-center fw-normal">Added Date</th>
                                    <th class="text-white text-center fw-normal">Action</th>
                                </tr>
                            </thead>
                            <tbody id="wishlist_tbl">
                            </tbody>
                        </table>
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
         
         function back(){
            window.location.href = "./customer_dashboard.php";
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

        
         fetchWishlistItems();
         function fetchWishlistItems(){

            var data = {
                status: "get_all_wish_list_for_user",
                user_id: getCookie("username")
            };

            $.ajax({
                    url: './action/wishlist.php', 
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        var wishlistItems = response.wishlistItems;
                        console.log(wishlistItems);
                        var tableBody = $('#wishlist_tbl');

                        // Clear existing table rows
                        tableBody.empty();

                        $.each(wishlistItems, function (index, item) {
                            var row = $('<tr>');
                            row.append($('<td>').addClass('text-center').text(item.item_id));
                            row.append($('<td>').addClass('text-center').text(item.product));
                            row.append($('<td>').addClass('text-center').text("Rs. "+item.price));
                            row.append($('<td>').addClass('text-center').text(item.added_timestamp));

                            var viewButton = $('<button>').addClass('btn btn-info btn-sm mx-1').text('VIEW');
                                viewButton.click(function () {
                                    viewWishlistItem(item.item_id);
                                });

                            var addToCart = $('<button>').addClass('btn btn-dark btn-sm mx-1').text('CART');
                                addToCart.click(function () {
                                    addtocartaction(item.id , item.product , item.price);
                                });

                            var actionButton = $('<button>').addClass('btn btn-danger btn-sm').text('DELETE');
                            actionButton.click(function () {
                                deleteWishlistItem(item.id);
                            });
                            row.append($('<td>').addClass('text-center').append(viewButton,actionButton,addToCart));

                            // Append the row to the table body
                            tableBody.append(row);
                        });
                    }
            })
          }

          function viewWishlistItem(id){
            window.location.href ="./customer_one_book.php?id="+id;
          }

          function deleteWishlistItem(id) {
                // Display a confirmation dialog using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: './action/wishlist.php', 
                            type: 'POST',
                            data: { 
                                status : "delete_item",
                                item_id: id 
                            }, 
                            dataType: 'json',
                            success: function (response) {
                                if (response.status === 'success') {
                                    Swal.fire('Deleted!', 'The item has been deleted.', 'success');
                                    fetchWishlistItems();
                                } else {
                                    Swal.fire('Error!', 'Failed to delete the item.', 'error');
                                }
                            },
                            error: function () {
                                Swal.fire('Error!', 'AJAX request failed.', 'error');
                            }
                        });
                    }
                });
            }

            function addtocartaction(id, name , price) {
                Swal.fire({
                    title: 'Add to Cart?',
                    text: 'Do you want to add ' + name + ' to the cart?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Add to Cart',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        add_to_cart(id, name, 1 , price); 
                        Swal.fire('Added to Cart!', '', 'success');
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire('Cancelled', '', 'error');
                    }
                });
            }


            function add_to_cart(bookId , productName , quantity, price){
                $.ajax({
                    url: './action/cart.php', 
                    type: 'POST',
                    data: {
                        status: 'add_to_cart',
                        productId: bookId,
                        productName: productName,
                        quantity: quantity,
                        price: price,
                        user_id: getCookie("username")
                    },
                    dataType: 'json',
                    success: function (response) {
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
    </script>
  </body>
</html>