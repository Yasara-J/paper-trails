<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <title>Paper Trails</title>

  </head>
  <body class="bg_color" >
    <?php include './common/header_author.php'; ?>
    <div class="container bg-white mt-5 rounded pb-5  pr-">
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Search For Books</h3>
        <hr/>
        <div class="text-start p-3">
            <h5>Filter Books</h5>
            <div class="row text-start ">
               
                <div class="col">
                    
                    <div class="form-group">
                        <label for="classType">Book Name</label>
                        <input type="text" class="form-control" id="book_name_search" />
                    </div>
                </div>
            </div>
            <div class="pt-3 text-end">
                <button class="btn btn-danger" onclick="clear_all()">Clear</button>
                <button class="btn btn-success" onclick="search_Class()">Filter</button>
            </div>
        </div>
        </table>
    </div>
    <div class="container bg-white mt-5 rounded pb-5  ">
        
        
        <div class="text-end pt-4">
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal">Add Books</button>
          <button class="btn btn-outline-dark" onclick="window.location.href='author_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
            <thead class="bg-dark">
                <tr>
                    <th class="text-white text-center fw-normal">Book ID</th>
                    <th class="text-white text-center fw-normal">Title</th>
                    <th class="text-white text-center fw-normal">Price (Rs.)</th>
                    <th class="text-white text-center fw-normal">Availability</th>
                    <th class="text-white text-center fw-normal">ISBN</th>
                    <th class="text-white text-center fw-normal">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white book_tbl">
                
            </tbody>
        </table>
    </div>  
          
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bookForm">
                        <div class="form-group pt-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter title">
                        </div>
                        <div class="form-group pt-3">
                            <label for="publisher">Publisher</label>
                            <input type="text" class="form-control" id="publisher" placeholder="Enter publisher">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group pt-3">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" placeholder="Enter price">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group pt-3">
                                    <label for="pagecount">Page Count</label>
                                    <input type="number" class="form-control" id="pagecount" placeholder="Enter page count">
                                </div>
                            </div>
                        </div>
                      
                        
                        <div class="form-group pt-3">
                            <label for="availability">Availability</label>
                            <select class="form-control" id="availability">
                                <option value="">Select Availability</option>
                                <option value="in_stock">Available</option>
                                <option value="out_of_stock">Not Available</option>
                            </select>
                        </div>
                        <div class="form-group pt-3">
                            <label for="book_category" class="form-label">Book Category</label>
                            <select class="form-control" id="book_category" placeholder="">
                                <option value="" disabled selected>Select a category</option>
                            </select>
                        </div>
                        <div class="form-group pt-3">
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control" id="isbn" placeholder="Enter ISBN" oninput="validateISBN(this)">
                            <small id="isbnError" ></small>
                        </div>
                        <div class="form-group pt-3">
                            <input type="button" class="form-control" id="profile_photo" value="Upload File" onclick="uploadImageToCloudinary()">
                            <span id="img_name">Please upload image</span>
                        </div>

                        <div class="form-group pt-3">
                            <div class="row">
                                <div class="col">
                                    <input type="file" class="form-control" id="pdf_doc" value="Upload File" oninput="uploadPDFToServer()">
                                    <span id="pdf_name">Please upload book pdf</span>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-group pt-3">
                            <label for="description">Description</label>
                            <div id="quill-editor" style="height: 300px;"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="submitBook()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5 text-white" id="editModalLabel">Edit Book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="editBookForm">
                        <input type="hidden" id="bookId" value=""> 
                        <div class="form-group pt-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="edit_title" placeholder="Enter title" value="">
                            <input type="hidden" class="form-control" id="edit_id" placeholder="Enter title" value="">
                        </div>
                        <div class="form-group pt-3">
                            <label for="publisher">Publisher</label>
                            <input type="text" class="form-control" id="edit_publisher" placeholder="Enter publisher" value=""> 
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group pt-3">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="edit_price" placeholder="Enter price" value=""> 
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group pt-3">
                                    <label for="pagecount">Page Count</label>
                                    <input type="number" class="form-control" id="edit_pagecount" placeholder="Enter page count" value=""> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group pt-3">
                            <label for="availability">Availability</label>
                            <select class="form-control" id="edit_availability">
                                <option value="">Select Availability</option>
                                <option value="in_stock" >In Stock</option> 
                                <option value="out_of_stock">Out of Stock</option>
                            </select>
                        </div>

                        <div class="form-group pt-3">
                            <label for="book_category" class="form-label">Book Category</label>
                            <select class="form-control" id="edit_book_category" placeholder="" >
                                <option value="" disabled selected>Select a category</option>
                                
                            </select>
                        </div>

                        <div class="form-group pt-3">
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control" id="edit_isbn" placeholder="Enter ISBN" disabled> 
                        </div>


                        <div class="form-group pt-3">
                            <label for="description">Description</label>
                            <div id="quill-editor-edit" style="height: 300px;"></div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-success" onclick="update_book_acton()">Update Book</button>
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>

    <script>

        // Wait for the DOM to be ready
        document.addEventListener('DOMContentLoaded', function () {
            const quill = new Quill('#quill-editor', {
                theme: 'snow' 
            }); 

            const quill3 = new Quill('#quill-editor-edit', {
                theme: 'snow' 
            }); 
            
        });

        
        function uploadImageToCloudinary() {
            var cloudName = "ddiitrb3o";

            cloudinary.setCloudName(cloudName);

            cloudinary.openUploadWidget(
                {
                    cloudName: cloudName,
                    uploadPreset: "ml_default", 
                    sources: ["local", "url"],
                    multiple: false,
                    cropping: false,
                    defaultSource: "local",
                    clientAllowedFormats: ["png", "jpg", "jpeg"],
                    maxFileSize: 5000000 
                },
                function (error, result) {
                    if (!error && result && result.event === "success") {
                        var imageUrl = result.info.secure_url;
                        document.getElementById('img_name').innerHTML = imageUrl;
                    } else {
                        console.error("Error uploading image:", error);
                    }
                }
            );
        }

        function uploadPDFToServer() {
            const pdfInput = document.getElementById('pdf_doc');
            const pdfName = document.getElementById('pdf_name');
            
            const selectedFile = pdfInput.files[0];

            if (selectedFile) {
                const formData = new FormData();
                formData.append('pdf', selectedFile);

                // Create and configure an XMLHttpRequest object
                const xhr = new XMLHttpRequest();
                xhr.open('POST', './action/upload_book_pdf.php', true);

                // Set up the onload and onerror event handlers
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // The file has been uploaded successfully
                        pdfName.innerText = xhr.responseText;
                    } else {
                        pdfName.innerText = 'File upload failed. Please try again.';
                    }
                };

                xhr.onerror = function () {
                    pdfName.innerText = 'An error occurred while uploading the file.';
                };

                // Send the request
                xhr.send(formData);
            } else {
                pdfName.innerText = 'Please select a PDF file to upload.';
            }
        }



        loadBookCategories();
        function loadBookCategories() {
            $.ajax({
                type: 'POST', 
                data: {
                    status: 'list_categories'
                },
                url: './action/book_category.php', 
                success: function (response) {
                    console.log(response);
                    var data = JSON.parse(response);
                    var categories = data.categories;

                    $('#book_category').empty();
                    $('#edit_book_category').empty();

                    $('#book_category').append('<option value="" disabled selected>Select a category</option>');
                    $('#edit_book_category').append('<option value="" disabled selected>Select a category</option>');

                    categories.forEach(function (category) {
                        $('#book_category').append('<option value="' + category.id + '">' + category.category_name + '</option>');
                        $('#edit_book_category').append('<option value="' + category.id + '">' + category.category_name + '</option>');
                    });
                },
                error: function () {
                    console.error('Error fetching book categories');
                }
            });
        }

        function isValidISBNCode(str) {
            // ISBN CODE
            let regex = new RegExp(/^(?=(?:[^0-9]*[0-9]){10}(?:(?:[^0-9]*[0-9]){3})?$)[\d-]+$/);
        
            // if str
            // is empty return false
            if (str == null) {
                return false;
            }
        
            // Return true if the str
            // matched the ReGex
            if (regex.test(str) == true) {
                return true;
            }
            else {
                return false;
            }
        }

        function validateISBN(input) {
            const isbn = input.value;
            if(isValidISBNCode(isbn)){
                document.getElementById("isbnError").innerHTML = "Valid ISBN";
                document.getElementById("isbnError").style.color = "green";
            }else{
                document.getElementById("isbnError").innerHTML = "Invalid ISBN";
                document.getElementById("isbnError").style.color = "red";
            }
            
        }


        function getCookie(name) {
            var nameEQ = name + "=";
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                while (cookie.charAt(0) == ' ') {
                    cookie = cookie.substring(1, cookie.length);
                }
                if (cookie.indexOf(nameEQ) === 0) {
                    return cookie.substring(nameEQ.length, cookie.length);
                }
            }
            return null;
        }
        

        function submitBook(){
            // Get form data
            const title = document.getElementById("title").value;
            const publisher = document.getElementById("publisher").value;
            const price = document.getElementById("price").value;
            const pagecount = document.getElementById("pagecount").value;
            const availability = document.getElementById("availability").value;
            const isbn = document.getElementById("isbn").value;
            const img_file = document.getElementById('img_name').innerHTML;
            const document_link = document.getElementById("pdf_name").innerHTML;
            const book_category = document.getElementById("book_category").value;
           
            //Quill library to work with a rich text editor.
            const quill = new Quill('#quill-editor');
            const descriptionHTML = quill.root.innerHTML; 

            const data = {
                status: 'add_book',
                title: title,
                publisher: publisher,
                price: price,
                pagecount: pagecount,
                availability: availability,
                isbn: isbn,
                img_file: img_file,
                description: descriptionHTML,
                book_category : book_category,
                author : getCookie("username"),
                doc_link : document_link
            };

            $.ajax({
                type: 'POST',
                url: './action/book.php', 
                data: data,
                success: function (response) {
                    console.log(response);
                    var data = JSON.parse(response);
                    // Handle the JSON response here
                    if (data.status === 'success') {
                        // Book was added successfully
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Book added successfully!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Optionally, reset the form
                                document.getElementById("bookForm").reset();
                                $('#addModal').modal('hide');
                                quill.setContents("");
                                displayBooks();
                            }
                        });
                    } else {
                        // There was an error adding the book
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error: ' + data.message,
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong'
                    });
                }
            });
        }
       
        function displayBooks() {
            $.ajax({
                url: './action/book.php', 
                type: 'POST', 
                data:{
                    status : "all_book_for_author",
                    author_id :getCookie("username"),
                },
                dataType: 'json',
                success: function(response) {
                    const data = response.books;
                    console.log(data);
                    // Get the table body element
                    const tableBody = $('.book_tbl');

                    // Clear existing table rows
                    tableBody.empty();

                    // Iterate through the book data and create table rows
                    $.each(data , function(index, book) {
                        const row = $('<tr>');
                        const availabilityText = book.availability === 'out_of_stock' ? 'Out Of Stock' : 'Available'; // Check the availability value

                        row.html(`
                            <td class="text-center">${book.bookid}</td>
                            <td class="text-center">${book.title}</td>
                            <td class="text-center">${book.price}</td>
                            <td class="text-center">${availabilityText}</td> 
                            <td class="text-center">${book.isbn}</td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary" onclick='edit(${book.bookid})'>Edit</button>
                            </td>
                        `);
                        tableBody.append(row);
                    });
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        displayBooks();

        function edit(bookId){
            $("#editModal").modal("show");
            $.ajax({
                url: './action/book.php',
                type: 'POST',
                data: {
                    status: 'get_one_book',
                    id: bookId
                },
                dataType: 'json',
                success: function (response) {
                    
                    if (response.status === 'success') {
                        const quill_2 = new Quill('#quill-editor-edit');
                        const book = response.book;
                        
                        $('#edit_id').val(bookId);
                        $('#edit_title').val(book.title);
                        $('#edit_publisher').val(book.publisher);
                        $('#edit_price').val(book.price);
                        $('#edit_pagecount').val(book.pagecount);
                        $('#edit_availability').val(book.availability);
                        $('#edit_book_category').val(book.book_category);
                        $('#edit_isbn').val(book.isbn);
                        quill_2.pasteHTML(book.description);

                    }
                }
            });
        }

        function update_book_acton(){
            
            const quill_3 = new Quill('#quill-editor-edit');
            const descriptionEditHTML = quill_3.root.innerHTML; 

            $.ajax({
                url: './action/book.php',
                type: 'POST',
                data: {
                    status: 'update_book',
                    id: $('#edit_id').val(),
                    title: $('#edit_title').val(),
                    publisher: $('#edit_publisher').val(),
                    price: $('#edit_price').val(),
                    pagecount: $('#edit_pagecount').val(),
                    availability: $('#edit_availability').val(),
                    book_category: $('#edit_book_category').val(),
                    description : descriptionEditHTML
                },
                dataType: 'json',
                success: function (response) {
                    if(response.status == "success"){
                        Swal.fire({
                            title: 'Success',
                            text: 'Book updated successfully!',
                            icon: 'success',
                        }).then(() => {
                            $('#editModal').modal('hide');
                            displayBooks();
                        });

                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong'
                        });
                    }
                }
            });

        }

      
        function search_Class(){
            var book_name_search =  document.getElementById("book_name_search").value;
            $.ajax({
                url: './action/book.php', 
                type: 'POST', 
                data:{
                    status : "search_book",
                    bookSearchTerm: book_name_search
                },
                dataType: 'json',
                success: function(response) {
                    
                    const data = response;
                
                    // Get the table body element
                    const tableBody = $('.book_tbl');

                    // Clear existing table rows
                    tableBody.empty();

                    // Iterate through the book data and create table rows
                    $.each(data , function(index, book) {
                        const row = $('<tr>');
                        const availabilityText = book.availability === 'out_of_stock' ? 'Out Of Stock' : 'Stock Available'; // Check the availability value

                        row.html(`
                            <td class="text-center">${book.id}</td>
                            <td class="text-center">${book.title}</td>
                            <td class="text-center">${book.price}</td>
                            <td class="text-center">${availabilityText}</td> 
                            <td class="text-center">${book.isbn}</td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary" onclick='edit(${book.id})'>Edit</button>
                            </td>
                        `);
                        tableBody.append(row);
                    });
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        function clear_all(){
            displayBooks();
            document.getElementById("book_name_search").value  = "";
        }

    </script>
    

  </body>
</html>