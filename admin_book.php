<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6"></script>

    <title>Paper Trails</title>

  </head>
  <body class="bg_color" >
    <?php include './common/header_author.php'; ?>
    <div class="container bg-white mt-5 rounded pb-5  pr-">
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">MANAGE BOOK</h3>
        <hr/>
        <div class="text-end">
          <button class="btn btn-outline-dark" onclick="window.location.href='admin_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
          <thead class="bg-dark">
              <tr>
                <th class="text-white text-center fw-normal">Book ID</th>
                <th class="text-white text-center fw-normal">Name</th>
                <th class="text-white text-center fw-normal">Author</th>
                <th class="text-white text-center fw-normal">Added Date</th>
                <th class="text-white text-center fw-normal">Action</th>
              </tr>
          </thead>
          <tbody class="bg-white table_container">
            
          </tbody>
        </table>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function loadBooks() {
            $.ajax({
                url: './action/book.php',
                type: 'POST',
                data: {
                    status: "all_book"
                },
                dataType: 'json',
                success: function (response) {
                    const books = response.books;
                    console.log(books);
                    const tableBody = $('.table_container'); 

                    tableBody.empty();

                    for (let i = 0; i < books.length; i++) {
                        const book = books[i];
                        const row = $('<tr>');

                        // Add data to the row
                        row.append($('<td>').addClass('text-center').text(book.bookid));
                        row.append($('<td>').addClass('text-center').text(book.title));
                        row.append($('<td>').addClass('text-center').text(book.author_name));
                        row.append($('<td>').addClass('text-center').text(book.created_at));
                        
                        const actionCell = $('<td>').addClass('text-center');
                        const viewButton = $('<button>').addClass('btn btn-outline-primary btn-sm me-1').text('View');
                        
                        actionCell.append(viewButton);

                        // Create buttons for Activate/Deactivate
                        const statusButton = book.bookstatus === "1"
                            ? $('<button>').addClass('btn btn-outline-success btn-sm me-1').text('Available')
                            : $('<button>').addClass('btn btn-outline-danger btn-sm me-1').text('Not Available');

                        statusButton.click(function () {
                            // Handle Activate/Deactivate button click
                            var action = book.bookstatus === "1" ? "0" : "1";
                            handleStatusAction(book.bookid, action);
                        });

                        // Append the status button to the cell
                        actionCell.append(statusButton);

                        
                       

                        viewButton.click(function () {
                            
                          $.ajax({
                              url: './action/book.php', 
                              type: 'POST',
                              data: {
                                  status : "get_one_book",
                                  id: book.bookid
                              },
                              dataType: 'json',
                              success: function (response) {
                                var bookData = response.book;
                                
                                const detailsHtml = `<div style='text-align:left;'>
                                    <center>
                                    <img src="${bookData.img}" alt="Book Cover" style="max-width: 300px; max-height: 300px; ">
                                    </center>
                                    <p><strong>Title:</strong> ${bookData.title}</p>
                                    <p><strong>Author:</strong> ${bookData.author || 'N/A'}</p>
                                    <p><strong>Publisher:</strong> ${bookData.publisher}</p>
                                    <p><strong>Price:</strong> Rs.${parseFloat(bookData.price).toFixed(2)}</p>
                                    <p><strong>Page Count:</strong> ${bookData.pagecount}</p>
                                    <p><strong>Availability:</strong> ${bookData.availability}</p>
                                    <p><strong>Created At:</strong> ${bookData.created_at}</p>
                                    <p><strong>ISBN:</strong> ${bookData.isbn}</p><br/>
                                    <p><strong>Description:</strong> ${bookData.description}</p>
                                </div>`;

                                // Show the details in a SweetAlert2 modal
                                Swal.fire({
                                    html: detailsHtml,
                                    confirmButtonText: 'Close'
                                }); 
                              }
                          });
                        });

                        
                        // Append buttons to the cell
                        row.append(actionCell);

                        // Append the row to the table body
                        tableBody.append(row);
                    }
                }
            });
        }

        loadBooks();
        function handleStatusAction(bookID, newStatus) {
            $.ajax({
                url: './action/book.php',
                type: 'POST',
                data: {
                    status: "status_change",
                    bookID: bookID,
                    newStatus: newStatus
                },
                dataType: 'json',
                success: function (response) {
                    // Handle the response
                    if (response.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then(() => {
                            
                            loadBooks(); 
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Handle AJAX error if needed
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing the request.'
                    });
                }
            });
        }

      
    </script>
  </body>
</html>