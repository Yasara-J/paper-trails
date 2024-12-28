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
                    </center>
                    <div class="card-body">
                        <div class="mb-3 pt-3">
                            <label for="username" class="form-label">User Name</label>
                            <input type="email" class="form-control" id="username" placeholder="">
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass" placeholder="">
                        </div>
                        <div class="mb-3 pt-1">
                            <div class="d-grid gap-2">
                                <button class="btn btn-dark text-uppercase" onclick="submit()">Submit</button>
                            </div>
                            <br/>
                            <hr/>
                            <div class="text-center fw-bold" style="cursor: pointer;">
                                <h6 onclick="reg_page()">REGISTRATION PAGE</h6>
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
        function reg_page(){
            window.location.href = "reg_user_type.php";
        }

        function submit() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('pass').value;

            const data = {
                status: 'reg_login',
                username: username,
                password: password
            };



            $.ajax({
                type: 'POST',
                url: './action/user_action.php', 
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: 'Welcome!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (response.userType === "Customer") {
                                    // Redirect to the customer dashboard
                                    window.location.href = "customer_dashboard.php?i=" + response.id;
                                } else if (response.userType === "author") {
                                    // Redirect to the author dashboard
                                    window.location.href = "author_dashboard.php?i=" + response.id;
                                } else if (response.userType === "Admin") {
                                    // Redirect to the admin dashboard
                                    window.location.href = "admin_dashboard.php?i=" + response.id;
                                } else {
                                    // Handle other user types or cases as needed
                                }
                                setCookie("username", response.id, 7);
                            }   
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
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