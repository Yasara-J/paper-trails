

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
        
        <h4 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Coupon Checking..</h4>
        <hr/>
        <div class="row">

          <div class="col-12">
              <div class="card h-100">
                  <div class="card-body p-4">
                      <div class="row" >
                        
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                               <img src="./img/coupon.png" style="width:18%;" />
                               <h2 class="text-uppercase" id="coupons_main_status"></h2>
                               <h3 style="font-weight:400;" id="coupons_status"></h3>
                               <div class="row" style="padding-top: 5%; padding-bottom:3%;">
                                  <div class="col">
                                     <button class="btn btn-outline-dark" onclick="back()">Buy More Books</button>
                                  </div>
                               </div>
                            </div>
                        </div>
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
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
    </script>
    <script>      
        function back(){
            window.location.href = "./customer_dashboard.php";
        }

        const urlSearchParams = new URLSearchParams(window.location.search);
        const t_payment = urlSearchParams.get('t_payment');

        
        console.log(t_payment);
        if(t_payment > 5000){
           
            setTimeout(function() {
                save_payment();
                fun_update_cart_Status();
            }, 2000);
            save_cupone();
           
        }else{
            document.getElementById("coupons_status").innerHTML = "You not select for the coupons.";
            document.getElementById("coupons_main_status").innerHTML = "Not Lucky..";
            setTimeout(function() {
                save_payment();
                fun_update_cart_Status();
            }, 2000);

            
        }


        function save_cupone(){
            var cupone_code = generateRandomCouponCode();
            var expire_date = calculateExpiryDate();
            var cupone_price = get_coupone_price();

            send_email(cupone_code , expire_date , cupone_price);
            $.ajax({
                type: "POST",
                url: "./action/cupone.php",
                data: { 
                    status: "add_cupone",
                    user_id: getCookie("username"),
                    coupon_code :cupone_code,
                    expire_date : expire_date,
                    price :cupone_price
                },
                dataType: "json",
                success: function(response) {
                    Swal.fire({
                        icon: (response.success)?"success":"warning",
                        title: (response.success)?"Success":"Warning",
                        text: response.message
                    });

                    if(response.success){
                        document.getElementById("coupons_status").innerHTML = "You select for the coupons. Check your email.";
                        document.getElementById("coupons_main_status").innerHTML = "Congratulations..";
                    }else{
                        document.getElementById("coupons_status").innerHTML = "You not select for the coupons. Please use previous cupone. ";
                        document.getElementById("coupons_main_status").innerHTML = "Not Lucky..";
                    }
                    
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

        function get_coupone_price(){
            const list = [1000, 2000, 3000, 500];
            const randomIndex = Math.floor(Math.random() * list.length);
            const randomValue = list[randomIndex];
            return randomValue;
        }

        function generateRandomCouponCode() {
            return Math.round(Math.random() * 10000);
        }

        function calculateExpiryDate() {
            const today = new Date();
            const expireDate = new Date(today);
            expireDate.setDate(today.getDate() + 7); 
            const formattedExpireDate = expireDate.toISOString().split('T')[0];

            return formattedExpireDate;
        }

        function save_payment(){
            $.ajax({
                type: "POST",
                url: "./action/cart.php",
                data: { 
                    status: "save_payment",
                    user_id: getCookie("username"),
                    amount : t_payment,
                    pay_by : getCookie("username"),
                    pay_method : "online"
                },
                dataType: "json",
                success: function(response) {
                   
                }
            });
        }

        function fun_update_cart_Status(){
            $.ajax({
                type: "POST",
                url: "./action/cart.php",
                data: { 
                    status: "pay_for_book",
                    user_id: getCookie("username")
                },
                dataType: "json",
                success: function(response) {
                    
                }
            });
        }

        function send_email(cupone_code , expire_date , cupone_price){
            
            $.ajax({
                type: "POST",
                url: "./action/customer.php",
                data: { 
                    status: "get_user_profile",
                    user_id: getCookie("username")
                },
                dataType: "json",
                success: function(response) {

                    var data = {
                        service_id: 'service_6pwgg9k',
                        template_id: 'template_xev7ghp',
                        user_id: 'fmLMz3ug7heS17KyE',
                        template_params: {
                            cus_name: response.FullName,
                            coupon_code: cupone_code,
                            discount: cupone_price,
                            expire_date: expire_date,
                            to_email: response.Email,
                        }
                    };
                    
                    // Email.js third party site include
                    $.ajax('https://api.emailjs.com/api/v1.0/email/send', {
                        type: 'POST',
                        data: JSON.stringify(data),
                        contentType: 'application/json'
                    }).done(function() {
                        console.log('Your mail is sent!');
                    }).fail(function(error) {
                        console.log('Oops... ' + JSON.stringify(error));
                    });
                }
            });
        }
    </script>
  </body>
</html>