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
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">MANAGE BOOK CATEGORY</h3>
        <hr/>
        <div class="text-end">
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal" >Add Book Category</button>
          <button class="btn btn-outline-dark" onclick="window.location.href='admin_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
        <thead class="bg-dark">
            <tr>
              <th class="text-white text-center fw-normal">Category ID</th>
              <th class="text-white text-center fw-normal">Name</th>
              <th class="text-white text-center fw-normal">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white table_container">
           
        </tbody>
        </table>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Book Category</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="fullName" class="form-label">Book Category</label>
                <input type="text" class="form-control" id="BookCategory" placeholder="">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" onclick="AddBookCategory()">Submit</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function AddBookCategory() {
            var category_name = $('#BookCategory').val(); 
            $.ajax({
                type: 'POST',
                url: './action/book_category.php', 
                data: {
                    status: 'add_category', 
                    category_name: category_name 
                },
                success: function (response) {
                    var result = JSON.parse(response);

                    if (result.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.message
                        });

                        loadBookCategory();
                        $('#BookCategory').val('');
                        $('#addModal').modal('hide');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.message
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

        function loadBookCategory() {
            $.ajax({
                type: 'POST',
                url: './action/book_category.php', 
                data: { status: 'list_categories' }, 
                success: function (response) {
                    var result = JSON.parse(response);

                    if (result.status === 'success') {
                        var tableBody = $('.table_container');
                        tableBody.empty();

                        result.categories.forEach(function (category) {
                            var row = '<tr>' +
                                '<td class="text-center">' + category.id + '</td>' +
                                '<td class="text-center">' + category.category_name + '</td>' +
                                '<td class="text-center">' +
                                '<button class="btn btn-primary btn-sm" onclick="confirmEditCategory(' + category.id + ')">Edit</button>&nbsp;&nbsp;' +
                                '<button class="btn btn-danger btn-sm" onclick="deleteCategory(' + category.id + ')">Delete</button>' +
                                '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    } else {
                        console.error(result.message);
                    }
                },
                error: function () {
                    console.error('Error loading book categories.');
                }
            });
        }

        $(document).ready(function () {
            loadBookCategory();
        });

        function confirmEditCategory(categoryId) {
            Swal.fire({
                title: 'Edit Category',
                text: 'Do you want to edit this category?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, edit it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Edit Category Name',
                        input: 'text',
                        inputValue: "", 
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Category name cannot be empty';
                            }
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Edit',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var newCategoryName = result.value;
                            updateCategory(categoryId, newCategoryName);
                        }
                    });
                }
            });
        }

        function updateCategory(categoryId, newCategoryName) {
            $.ajax({
                type: 'POST',
                url: './action/book_category.php', 
                data: {
                    status: 'update_category', 
                    category_id: categoryId,
                    new_category_name: newCategoryName
                },
                success: function (response) {
                    var result = JSON.parse(response);

                    if (result.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.message
                        });
                        loadBookCategory();

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.message
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

        function deleteCategory(categoryId) {
            Swal.fire({
                title: 'Confirm Deletion',
                text: 'Are you sure you want to delete this category?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: './action/book_category.php', 
                        type: 'POST',
                        data: {
                            status:'delete_category',
                            category_id: categoryId
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                // Category deleted successfully
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'The category has been deleted.',
                                    icon: 'success'
                                }).then(() => {
                                    loadBookCategory();
                                });
                            } else {
                                // Error deleting category
                                Swal.fire({
                                    title: 'Error',
                                    text: 'An error occurred while deleting the category.',
                                    icon: 'error'
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle AJAX error if needed
                            console.error(xhr.responseText);
                            Swal.fire({
                                title: 'Error',
                                text: 'An error occurred while processing the request.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        }



    </script>
  </body>
</html>