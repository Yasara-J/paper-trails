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
    <div class="container mb-5" >
        <div class="row row-cols-1 row-cols-md-3 g-4 " style="margin-top: 7%;">
            <div class="col">
            
            </div>
            <div class="col">
                <div class="card">
                    <center>
                        <img src="./img/man.png" class="card-img-top pt-5" alt="..." style="width: 40%;">
                        <h4 class="mt-5 fw-bold">CUSTOMER REGISTRATION</h4>
                    </center>
                    <div class="card-body">
                        <div class="mb-3 pt-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter full name">
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="telephone" class="form-label">Telephone Number</label>
                            <input type="tel" class="form-control" id="telephone" placeholder="Enter telephone number" oninput="validateTelephone()">
                            <small id="tel-status"></small>
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="address" class="form-label">Address</label>
                            <input class="form-control" id="address" placeholder="Enter address">
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" oninput="validateEmail()">
                            <small id="email-error"></small>
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass" placeholder="Enter password" oninput="passwordValid()">
                            <small id="password-status"></small>
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="pass" class="form-label">Confirm - Password</label>
                            <input type="password" class="form-control" id="cpass" placeholder="Enter Confirm password" oninput="cpasswordValid()">
                            <small id="cpassword-status"></small>
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="book_type" class="form-label">Book Type</label>
                            <select class="form-control" id="most_written_book_category">
                                <option value="">Select Book Type</option>
                            </select>
                        </div>
                        <div class="mb-3 pt-1">
                            <div class="d-grid gap-2">
                                <button class="btn btn-dark text-uppercase" onclick="submit()">Submit</button>
                            </div>
                            <br/>
                            <hr/>
                            <div class="text-center fw-bold" style="cursor: pointer;" onclick="login_page()">
                                <h6>LOGIN PAGE</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
            
            </div>
        </div>
    </div>
    <?php include './common/before_footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function login_page(){
            window.location.href =  "./login.php";
        }

        function validateTelephone(){
            const telephoneInput = document.getElementById('telephone').value;

            const telephonePattern = /^\d{10}$/;
            const telephoneValue = telephoneInput.trim();

            if (telephonePattern.test(telephoneValue)) {
                document.getElementById("tel-status").innerHTML = "Valid telephone number";
                document.getElementById("tel-status").style.color = "green";
            } else {
                // Telephone number is invalid
                document.getElementById("tel-status").innerHTML = "Invalid telephone number";
                document.getElementById("tel-status").style.color = "red";
            }
        }

        function passwordValid(){
            const passwordInput = document.getElementById('pass').value;

            const strongPasswordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (strongPasswordPattern.test(passwordInput)) {
                // Password is strong
                document.getElementById("password-status").style.color = "green";  
                document.getElementById("password-status").innerHTML = "Password is strong";
            } else {
                // Password is not strong
                document.getElementById("password-status").style.color = "red";
                document.getElementById("password-status").innerHTML = "Password is not strong";
            }
        }

        function cpasswordValid(){
            const passwordInput = document.getElementById('pass');
            const confirmPasswordInput = document.getElementById('cpass');

            const passwordValue = passwordInput.value.trim(); 
            const confirmPasswordValue = confirmPasswordInput.value.trim(); 

            if (passwordValue === confirmPasswordValue) {
                // Passwords match
                document.getElementById("cpassword-status").style.color = "green";
                document.getElementById("cpassword-status").innerHTML = "Passwords are matching";
                
            } else {
                // Passwords do not match
                document.getElementById("cpassword-status").style.color = "red";
                document.getElementById("cpassword-status").innerHTML = "Passwords are not matching";
            }

        }

        function validateEmail() {
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('email-error');
            const emailValue = emailInput.value.trim(); 

            if (emailPattern.test(emailValue)) {
                // Email is valid
                emailError.style.color = 'green';
                emailError.innerHTML = "Email is valid";
            } else {
                // Email is invalid
                emailError.style.color = 'red';
                emailError.innerHTML = "Email is invalid";
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

        function submit() {
            const name = document.getElementById('name').value;
            const telephone = document.getElementById('telephone').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('pass').value;
            const address = document.getElementById('address').value;
            const bookType = document.getElementById('most_written_book_category').value;

            const data = {
                status: 'add_customer',
                name: name,
                telephone: telephone,
                email: email,
                password: password,
                address: address,
                bookType: bookType
            };

            $.ajax({
                type: 'POST',
                url: './action/customer.php', 
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful',
                            text: 'Welcome!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "login.php"; 
                            }

                            
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: response.message,
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred during login.',
                    });
                }
            });
        }

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>