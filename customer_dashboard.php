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
        <div class="row pb-3 mt-5" style="background-color: white; border-radius:20px; border:2px solid #BA8B02;">
            <div class="col" style="padding-left: 5%;" >
                <h2 class="text-uppercase" style="padding-top: 10%; font-weight:700;">Customer dashboard</h2>
                <hr/>
            </div>
            <div class="col text-end pe-5">
                <img src="./img/dashboard_img.png" style="width: 62%;" />
            </div>
        </div>
        <h4 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Buy You Favourite Books..</h4>
        <hr/>
        <div class="row">
          <div class="col-3">
              <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase">Search Books</h5>
                    <hr/>
                    <div>
                      <span style="font-weight: 600; font-size:15px;">Book Category</span>
                      <select class="form-control" id="book_category" placeholder="">
                        <option value="" disabled selected>Select a category</option>
                      </select>
                    </div>
                    <div class="mt-3">
                      <span style="font-weight: 600; font-size:15px;">Book Name</span>
                      <input type="text" class="form-control" id="search_term"/>
                    </div>
                    <div class="mt-3 text-end">
                        <button class="btn btn-outline-dark" onclick="clear_fun()">Clear</button>
                        <button class="btn btn-outline-dark" onclick="search_books()">Search</button>
                    </div>
                </div>
              </div>
          </div>
          <div class="col-9">
              <div class="card">
                  <div class="card-body">
                      <div class="row" id="bookContainer">
                          
                          
                         
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
        $(document).ready(function () {
          loadBookCategories();
          loadBooks();
        });

        function clear_fun(){
            loadBooks();
        }

        function loadBookCategories() {
            $.ajax({
                type: 'POST', 
                data: {
                    status: 'list_categories'
                },
                url: './action/book_category.php', 
                success: function (response) {
                    
                    var data = JSON.parse(response);
                    var categories = data.categories;

                    $('#book_category').empty();

                    $('#book_category').append('<option value="" disabled selected>Select a category</option>');

                    categories.forEach(function (category) {
                        $('#book_category').append('<option value="' + category.id + '">' + category.category_name + '</option>');
                    });
                },
                error: function () {
                    console.error('Error fetching book categories');
                }
            });
        }

        function search_books(){
            var search_term = document.getElementById("search_term").value;
            var book_category = document.getElementById("book_category").value;
            $.ajax({
                url: './action/book.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    status: "search_book_with_category",
                    bookSearchTerm : search_term,
                    book_category: book_category
                },
                success: function (response) {
                    load_card_Set(response);
                }
            });
            
        }
        
        // Function to load book data
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
                    load_card_Set(books);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }


        function load_card_Set(books){
            console.log(books);
            const bookContainer = $('#bookContainer');
            // Clear any existing book cards
            bookContainer.empty();

            // Iterate through the book data and create cards
            $.each(books, function (index, book) {
                const availabilityText = book.availability === 'out_of_stock' ? 'Out Of Stock' : 'Available'; 
                const isButtonDisabled = book.availability === 'out_of_stock' ? true : false; 

                const cardHtml = `
                    <div class="col-4 mb-3">
                        <div class="card  h-100">
                                <div class="card-img-container">
                                    <img src="${book.img}" class="card-img-top" style='height:300px;' alt="Book Image">
                                </div>                                    
                                <div class="card-body">
                                <h5 class="card-title">${book.title}</h5>
                                <p style='line-height:12px;' class="card-text">Author: ${book.full_name}</p>
                                <p style='line-height:12px;' class="card-text">Price: Rs.${book.price}</p>
                                <p style='line-height:12px;' class="card-text">Availability: ${availabilityText}</p>
                                <p style='line-height:12px;' class="card-text">Book Category: ${book.category_name}</p>
                                <a href="./customer_one_book.php?id=${book.bookid}" class="btn btn-primary ${isButtonDisabled ? 'disabled' : ''}">View Details</a>
                            </div>
                        </div>
                    </div>
                `;

                // Append the generated card HTML to the container
                bookContainer.append(cardHtml);
            });
        }

    </script>
  </body>
</html>