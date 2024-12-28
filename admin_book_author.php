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
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">MANAGE AUTHOR</h3>
        <hr/>
        <div class="text-end">
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal">Add Author</button>
          <button class="btn btn-outline-dark" onclick="window.location.href='admin_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
          <thead class="bg-dark">
              <tr>
                <th class="text-white text-center fw-normal">Author ID</th>
                <th class="text-white text-center fw-normal">Name</th>
                <th class="text-white text-center fw-normal">Telephone Number</th>
                <th class="text-white text-center fw-normal">Timestamp</th>
                <th class="text-white text-center fw-normal">Action</th>
              </tr>
          </thead>
          <tbody class="bg-white tbl_container" id="authorTableBody">
              
          </tbody>
        </table>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Author</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" placeholder="">
              </div>
              <div class="row">
                <div class="col">
                    <div class="mb-3">
                      <label for="telephone" class="form-label">Telephone Number</label>
                      <input type="text" class="form-control" id="telephone" placeholder="" oninput="tel_validation()">
                      <small id="tel_status"></small>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                      <label for="nic" class="form-label">NIC</label>
                      <input type="text" class="form-control" id="nic" placeholder="" oninput="validateNIC(this)" autocomplete="off">
                      <small id="nic_status"></small>
                    </div>
                </div>
              </div>
              
             
              <div class="mb-3">
                <label for="most_written_book_category" class="form-label">Most Written Book Category</label>
                <select class="form-control" id="most_written_book_category" placeholder="">
                  <option value="" disabled selected>Select a category</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-control" id="country" placeholder="">
                </select>
              </div>
              <div class="mb-3">
                <label for="language" class="form-label">Language</label>
                <select class="form-control" id="language" placeholder="">
                </select>
              </div>
              <div class="row">
                <div class="col">
                    <div class="mb-3">
                      <label for="passs" class="form-label">Password</label>
                      <input type="password" class="form-control" id="pass" placeholder="" oninput="passValidation()">
                      <small id="pass_status"></small>
                    </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="cpass" class="form-label">Confirm - Password</label>
                    <input type="password" class="form-control" id="cpass" placeholder="" oninput="cpassValidation()">
                    <small id="cpass_status"></small>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="biography" class="form-label">Biography</label>
                <textarea class="form-control" id="editor" style="height: 300px;"></textarea>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" onclick="save_Data()">Submit</button>
            </div>
          </div>
        </div>
    </div>
    
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Edit Author</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullNameEdit" placeholder="" disabled>
                        <input type="hidden" class="form-control" id="authorIdEdit" placeholder="" >
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Telephone Number</label>
                                <input type="text" class="form-control" id="telephoneEdit" placeholder="" oninput="tel_validation()" disabled>
                                <small id="tel_status"></small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="nic" class="form-label">NIC</label>
                                <input type="text" class="form-control" id="nicEdit" placeholder="" oninput="validateNIC(this)" disabled>
                                <small id="nic_status"></small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="most_written_book_category" class="form-label">Most Written Book Category</label>
                        <select class="form-control" id="most_written_book_categoryEdit" placeholder="">
                           
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-control" id="countryEdit" placeholder="">
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="language" class="form-label">Language</label>
                        <select class="form-control" id="languageEdit" placeholder="">
                            
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="biography" class="form-label">Biography</label>
                        <textarea class="form-control" id="editorEdit" style="height: 300px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="save_Edit_Data()">Edit</button>
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

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
       function tel_validation() {
          const telephoneInput = document.getElementById('telephone');
          const telephoneStatus = document.getElementById('tel_status');
          const telephoneValue = telephoneInput.value;

          // Simple telephone number validation
          const validPattern = /^\d{3}\d{3}\d{4}$/;

          if (validPattern.test(telephoneValue)) {
            telephoneStatus.textContent = 'Valid telephone number.';
            telephoneStatus.style.color = 'green';
          } else {
            telephoneStatus.textContent = 'Invalid telephone number. Please enter in the format 0XXXXXXXXX.';
            telephoneStatus.style.color = 'red';
          }
        }

        function passValidation() {
          const passwordInput = document.getElementById('pass');
          const passwordStatus = document.getElementById('pass_status');
          const passwordValue = passwordInput.value;

          // Password validation rules
          const minLength = 8;
          const containsUppercase = /[A-Z]/.test(passwordValue);
          const containsLowercase = /[a-z]/.test(passwordValue);
          const containsDigit = /[0-9]/.test(passwordValue);

          if (passwordValue.length < minLength || !containsUppercase || !containsLowercase || !containsDigit) {
            passwordStatus.textContent = 'Password must be at least 8 characters long and contain an uppercase letter, a lowercase letter, and a digit.';
            passwordStatus.style.color = 'red';
          } else {
            passwordStatus.textContent = 'Password is valid.';
            passwordStatus.style.color = 'green';
          }
        }

        function cpassValidation() {
          const passwordInput = document.getElementById('pass');
          const confirmPasswordInput = document.getElementById('cpass');
          const confirmPasswordStatus = document.getElementById('cpass_status');
          const confirmPasswordValue = confirmPasswordInput.value;

          if (passwordInput.value !== confirmPasswordValue) {
            confirmPasswordStatus.textContent = 'Passwords do not match.';
            confirmPasswordStatus.style.color = 'red';
          } else {
            confirmPasswordStatus.textContent = 'Passwords match.';
            confirmPasswordStatus.style.color = 'green';
          }
        }

        function validateNIC(input) {
            var nic = input.value.trim();
            var nicPattern9Chars = /^[0-9]{9}[vVxX]$/;
            var nicPattern20Digits = /^[0-9]{12}$/;

            var nicStatus = document.getElementById("nic_status");

            if (nicPattern9Chars.test(nic) || nicPattern20Digits.test(nic)) {
                // NIC is valid
                nicStatus.textContent = "NIC is valid";
                nicStatus.style.color = "green";
            } else {
                // NIC is invalid
                nicStatus.textContent = "NIC is invalid. Please enter a valid NIC with 9 characters and 'v' or 'V' or 'x' or 'X', or a valid NIC with 20 digits.";
                nicStatus.style.color = "red";
            }
        }


        function save_Data() {
            var fullName = $('#fullName').val();
            var telephoneNumber = $('#telephone').val();
            var nic = $('#nic').val();
            var mostWrittenBookCategory = $('#most_written_book_category').val();
            var country = $('#country').val();
            var language = $('#language').val();
            var password = $('#pass').val();
            var biography = $('#biography').val();

            $.ajax({
                type: 'POST',
                url: './action/author.php', 
                data: {
                    status: 'add_author', 
                    full_name: fullName,
                    telephone_number: telephoneNumber,
                    nic: nic,
                    most_written_book_category: mostWrittenBookCategory,
                    country: country,
                    language: language,
                    password: password,
                    biography: biography
                },
                success: function (response) {
                    var result = JSON.parse(response);

                    if (result.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.message
                        });

                        $('#fullName').val('');
                        $('#telephone').val('');
                        $('#nic').val('');
                        $('#most_written_book_category').val('');
                        $('#country').val('');
                        $('#language').val('');
                        $('#pass').val('');
                        $('#biography').val('');
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

                    $('#most_written_book_category').empty();

                    $('#most_written_book_category').append('<option value="" disabled selected>Select a category</option>');

                    categories.forEach(function (category) {
                        $('#most_written_book_category').append('<option value="' + category.id + '">' + category.category_name + '</option>');
                    });
                },
                error: function () {
                    console.error('Error fetching book categories');
                }
            });
        }
        
        loadBookCategoriesForEdit();
        function loadBookCategoriesForEdit() {
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

                    $('#most_written_book_categoryEdit').empty();

                    $('#most_written_book_categoryEdit').append('<option value="" disabled selected>Select a category</option>');

                    categories.forEach(function (category) {
                        $('#most_written_book_categoryEdit').append('<option value="' + category.id + '">' + category.category_name + '</option>');
                    });
                },
                error: function () {
                    console.error('Error fetching book categories');
                }
            });
        }


        //COUNTRY LOADING API
        function loadCountries() {
            $.ajax({
                type: 'GET',
                url: 'https://restcountries.com/v3.1/all', 
                success: function (countries) {
                 
                  $('#country').empty();
                  $('#countryEdit').empty();

                  $('#country').append('<option value="" disabled selected>Select a country</option>');
                  $('#countryEdit').append('<option value="" disabled selected>Select a country</option>');
                  
                  countries.forEach(function (country) {
                    if (country.altSpellings && country.altSpellings.length > 0) {
                        $('#country').append('<option value="' + country.altSpellings[1]  + '">' + country.altSpellings[1] + '</option>');
                        $('#countryEdit').append('<option value="' + country.altSpellings[1]  + '">' + country.altSpellings[1] + '</option>');
                    }
                  });
                },
                error: function () {
                    console.error('Error fetching countries');
                }
            });
        }

        function loadLanguages() {
            var languages = [
                'English',
                'Spanish',
                'French',
                'German',
                'Chinese',
                'Japanese',
                'Korean',
                'Arabic',
                'Russian',
                'Italian',
                'Portuguese',
                'Dutch',
                'Swedish',
                'Norwegian',
                'Danish',
                'Finnish',
                'Greek',
                'Hindi',
                'Bengali',
                'Urdu',
                'Turkish',
                'Thai',
                'Vietnamese'            ];

            $('#language').empty();
            $('#languageEdit').empty();

            $('#language').append('<option value="" disabled selected>Select a language</option>');
            $('#languageEdit').append('<option value="" disabled selected>Select a language</option>');

            languages.forEach(function (language) {
                $('#language').append('<option value="' + language + '">' + language + '</option>');
                $('#languageEdit').append('<option value="' + language + '">' + language + '</option>');
            });
        }
       
     
        $(document).ready(function () {
            loadAuthorData();
            loadLanguages();
            loadCountries();
            loadBookCategories();
        });
       

        // QUILL IS USED AS RICH TEXT EDITOR
        var quill = new Quill('#editor', {
            theme: 'snow' 
        });
        var hiddenInput = document.getElementById('biography');
        quill.on('text-change', function() {
            hiddenInput.value = quill.root.innerHTML;
        });
        
        var quill = new Quill('#editorEdit', {
            theme: 'snow' 
        });
        var hiddenInputEdit = document.getElementById('biography');
        quill.on('text-change', function() {
          hiddenInputEdit.value = quill.root.innerHTML;
        });

        function save_Data() {
              var fullName = $('#fullName').val();
              var telephone = $('#telephone').val();
              var nic = $('#nic').val();
              var mostWrittenBookCategory = $('#most_written_book_category').val();
              var country = $('#country').val();
              var language = $('#language').val();
              var password = $('#pass').val();
              var confirmPassword = $('#cpass').val();
              var biography = $('#editor').val(); 

              
              $.ajax({
                  type: 'POST',
                  url: './action/author.php',
                  data: {
                    status:"add_author",
                    full_name: fullName,
                    telephone_number: telephone,
                    nic: nic,
                    most_written_book_category: mostWrittenBookCategory,
                    country: country,
                    language: language,
                    password: password,
                    biography: biography
                  },
                  success: function (response) {
                      var data = JSON.parse(response);
                      if (data.status === 'success') {
                          Swal.fire({
                              icon: 'success',
                              title: 'Success',
                              text: data.message,
                              onClose: function () {
                                  $('#addModal').modal('hide');
                              }
                          });
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Error',
                              text: data.message
                          });
                      }
                  },
                  error: function () {
                      Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: 'An error occurred while saving data.'
                      });
                  }
              });
        }

        function loadAuthorData() {
            $.ajax({
                url: './action/author.php', 
                type: 'POST',
                dataType: 'json',
                data:{
                  status :"list_tutors"
                },
                success: function (data) {
                    // Clear existing table rows
                    $('#authorTableBody').empty();

                    // Populate the table with fetched data
                    $.each(data, function (index, author) {

                      var activateButton = '<button class="btn btn-outline-success btn-sm" onclick="activateAuthor(' + author.author_id + ')">Activate</button>&nbsp;&nbsp;';
                      var deactivateButton = '<button class="btn btn-outline-danger btn-sm" onclick="deactivateAuthor(' + author.author_id + ')">Deactivate</button>&nbsp;&nbsp;';
                      var statusButton = author.status === 'active' ? deactivateButton : activateButton;

                      var actionButtons = '<td class="text-center">' +
                          statusButton +
                          '<button class="btn btn-outline-primary btn-sm" onclick="editAuthor(' + author.author_id + ')">Edit</button>&nbsp;&nbsp;' +
                          '<button class="btn btn-outline-info btn-sm" onclick="viewAuthor(' + author.author_id + ')">Info</button>&nbsp;&nbsp;' +
                          '</td>';

                        $('#authorTableBody').append('<tr>' +
                            '<td class="text-center">' + author.author_id + '</td>' +
                            '<td class="text-center">' + author.full_name + '</td>' +
                            '<td class="text-center">' + author.telephone_number + '</td>' +
                            '<td class="text-center">' + author.created_at + '</td>' +
                            actionButtons +
                            '</tr>');
                    });
                },
                error: function () {
                    console.error('Error loading author data.');
                }
            });
        }

       
        function viewAuthor(id){
          var url = './action/author.php'; 

          var data = {
              author_id: id,
              status : "get_author_profile"
          };

          // Make the AJAX request
          $.ajax({
              url: url,
              type: 'POST', 
              data: data,
              dataType: 'json', 
              success: function(authorData) {
                  
                  var modalContent = `
                    <div style='text-align:left;'>
                        <h2></h2>
                        <p style='line-height:15px; font-size:17px;'>Author Name: ${authorData[0].full_name}</p>
                        <p style='line-height:15px; font-size:17px;'>Telephone Number: ${authorData[0].telephone_number}</p>
                        <p style='line-height:15px; font-size:17px;'>NIC: ${authorData[0].nic}</p>
                        <p style='line-height:15px; font-size:17px;'>Most Written Book Category: ${authorData[0].category_name}</p>
                        <p style='line-height:15px; font-size:17px;'>Country: ${authorData[0].country}</p>
                        <p style='line-height:15px; font-size:17px;'>Language: ${authorData[0].language}</p>
                        <p style='line-height:15px; font-size:17px; padding-top:20px; '>Biography: </p>
                        <span>${authorData[0].biography}</span>
                    </div>
                `;
                Swal.fire({
                    title: 'Author Profile',
                    html: modalContent,
                    showCloseButton: true,
                    showConfirmButton: false
                });
              }
          });
      }

      function activateAuthor(id){
        var status = "active";
        status_chanage_fun(id , status)
      }

      function deactivateAuthor(id){
        var status = "deactivate";
        status_chanage_fun(id , status)
      }

      function status_chanage_fun(id, status) {
            
            // Show a SweetAlert 2 confirmation dialog
            Swal.fire({
                title: 'Confirm Status Change',
                text: 'Are you sure you want to change the status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {

                    var url = './action/author.php'; 
                    var data = {
                        author_id: id,
                        new_status: status,
                        status: 'update_status_author' 
                    };

                    // Make the AJAX request
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            if (response.success) {
                                // The update was successful
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                });
                                loadAuthorData();
                            } else {
                                // The update failed
                                Swal.fire({
                                    title: 'Error',
                                    text: response.message,
                                    icon: 'error',
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle any AJAX errors here
                            console.error(error);
                        }
                    });
                }
            });
      }

      function editAuthor(id){
        console.log(id);
        $.ajax({
            type: 'POST',
            url: './action/author.php',
            data: { 
              status: 'get_one_author', 
              author_id: id 
            }, 
            dataType: 'json',
            success: function (authorData) {
                $('#editModal').modal('show');
                var author_data = authorData[0];

                $('#authorIdEdit').val(author_data.author_id); 
                $('#fullNameEdit').val(author_data.full_name);
                $('#telephoneEdit').val(author_data.telephone_number);
                $('#nicEdit').val(author_data.nic);
                $('#most_written_book_categoryEdit').val(author_data.most_written_book_category);
                $('#countryEdit').val(author_data.country);
                $('#languageEdit').val(author_data.language);
                $('#passEdit').val(''); 
                $('#cpassEdit').val('');
                $('#editorEdit').val(author_data.biography);
            },
            error: function () {
                console.error('Error fetching author data.');
            }
        });
      }

      function save_Edit_Data(){
            var authorId = $('#authorIdEdit').val(); 
            var mostWrittenBookCategory = $('#most_written_book_categoryEdit').val();
            var country = $('#countryEdit').val();
            var language = $('#languageEdit').val();
            var biography = $('#editorEdit').val();

            var data = {
                status: 'update_author_profile',
                author_id: authorId,
                most_written_book_category: mostWrittenBookCategory,
                country: country,
                language: language,
                biography: biography
            };

            $.ajax({
                type: 'POST',
                url: './action/author.php',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        // Update successful, close the modal or show a success message
                        $('#editModal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: 'Author profile updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        loadAuthorData();
                    } else {
                        // Error updating the profile, handle as needed (show an error message, etc.)
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error updating author profile: ' + response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function () {
                    // AJAX request error, handle as needed (show an error message, etc.)
                    alert('Error: Unable to update author profile.');
                }
            });

      }

    </script>
  </body>
</html>