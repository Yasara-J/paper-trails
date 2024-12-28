

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet" >
    <title>Paper Trails</title>
    <!-- payhere libraray include -->
    <script src="https://www.payhere.lk/lib/payhere.js"></script>

  </head>
  <body class="bg_color" >
    <?php include './common/header_customer.php'; ?>
    <div class="container">
        
        <h4 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Your Cart..</h4>
        <hr/>
        <div class="row">

          <div class="col-12">
              <div class="card h-100">
                  <div class="card-body p-4">
                      <div class="row" >
                        <div class="mt-3 text-end">
                            <button  class="btn btn-outline-dark" onclick="back()">Back</button>
                        </div>
                        <div class="row mt-3">
                            <div class="col-9">
                                <div class="card border-0">
                                    <div class="card-body ">
                                        <table class="table">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th class="text-white text-center fw-normal">Product Code</th>
                                                    <th class="text-white text-center fw-normal">Product Name</th>
                                                    <th class="text-white text-center fw-normal">Price</th>
                                                    <th class="text-white text-center fw-normal">Quantity</th>
                                                    <th class="text-white text-center fw-normal">Added Date</th>
                                                    <th class="text-white text-center fw-normal">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cart_tbl">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-left mt-3">
                                            <!-- https://api.exchangerate-api.com/v4/latest/USD -->
                                            <!-- https://www.exchangerate-api.com/ -->
                                            <select class="form-select" id="currency" oninput="currency_select()">
                                                <option value="">Select Currency</option>
                                                <option value="LKR">Sri Lankan Rupees (LKR)</option>
                                                <option value="USD">United States Dollar (USD)</option>
                                                <option value="EUR">Euro (EUR)</option>
                                                <option value="JPY">Japanese Yen (JPY)</option>
                                                <option value="GBP">British Pound Sterling (GBP)</option>
                                                <option value="AUD">Australian Dollar (AUD)</option>
                                                <option value="CAD">Canadian Dollar (CAD)</option>
                                                <option value="CHF">Swiss Franc (CHF)</option>
                                                <option value="CNY">Chinese Yuan (CNY)</option>
                                                <option value="SEK">Swedish Krona (SEK)</option>
                                                <option value="SGD">Singapore Dollar (SGD)</option>
                                            </select>
                                        </div>
                                        <hr/>
                                        <div class="text-center">
                                            <h1 id="total_payment"></h1>
                                            <span>Total Payment</span>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="d-grid gap-2">
                                            <input type="button" class="btn btn-dark " value="Pay Now"  data-bs-toggle="modal" data-bs-target="#payModal"/>
                                        </div>
                                        <hr/>
                                        <span id='id_cupone_other_status'></span>
                                        <span class="text-primary" id='id_there_cupone' onclick="activate_now()" style="cursor: pointer;"></span>
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
    <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-text="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-5">
                <center>
                    <h3>DO PAYMENT VIA</h3>
                    <img src="https://www.payhere.lk/downloads/images/payhere_square_banner.png" style="width:90%;" />
                </center>
                <form method="post" action="https://sandbox.payhere.lk/pay/checkout">   
                    <input type="hidden" name="merchant_id" value="1224583">   
                    <input type="hidden" name="return_url" id="return_url" value="">
                    <input type="hidden" name="cancel_url" id="cancel_url" value="">
                    <input type="hidden" name="notify_url" value="">  
                    
                    <input type="hidden" name="order_id" id="order_id" value="">
                    <input type="hidden" name="items" value="Book Buying Payment"><br>
                    <input type="hidden" name="currency" id="currency" value="LKR">
                    <input type="hidden" name="recurrence" value="1 Month">
                    <input type="hidden" name="duration" value="Forever">
                    <input type="hidden" name="amount"  value="2500">  
                    <input type="hidden" id="amount" value="">  

                    <input type="hidden" name="first_name" value="user">
                    <input type="hidden" name="last_name" value="one"><br>
                    <input type="hidden" name="email" value="samanp@gmail.com">
                    <input type="hidden" name="phone" value="0771234567"><br>
                    <input type="hidden" name="address" value="No.1, Galle Road">
                    <input type="hidden" name="city" value="Colombo">
                    <input type="hidden" name="country" value="Sri Lanka">
                    <input type="hidden" name="hash"  id="hash_code" value="">
                    <div class="text-end">
                        <input type="submit" value="Buy Now" class="btn btn-dark">   
                    </div>    
                </form> 
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.3.0/crypto-js.js"></script>
    <script src="https://chatfuel.com/widget/plugin.js" chatfuel-token="1999405.u1pjGZoJwK0typIatNPrkM90DMg6qCDaHT"></script>

    <script src="./js/cart.js" ></script>

    <script>

        var t_payment =0;

       
        get_all_cart_data();

        var orderId = generateRandomId();

        const merchantSecretId = "MzExOTg0NjEzNDE2MTEyOTA1NjM4OTQ0MTk0MDIzNDk1MTE0OTQ0";
        const merchantId = "1224583";
        var amountcurrency = "LKR"

        const generatedHash = generateCode(orderId , merchantSecretId, merchantId, amountcurrency);
        document.getElementById("hash_code").value = generatedHash;
        document.getElementById("order_id").value = orderId;

        setTimeout(() => {
            var amount_for_url = document.getElementById("amount").value;
            document.getElementById("return_url").value = "http://localhost/"+getSubdirectory()+"/save_cupone.php?t_payment="+amount_for_url;
            check_available_cupone();
        }, 3000);


        
        function check_available_cupone(){
            $.ajax({
                type: "POST",
                url: "./action/cupone.php",
                data: { 
                    status: "check_available_cupone", 
                    user_id : getCookie("username")
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    var valid_cupone_id = data.coupon_code;
                    setCookie("valid_cupone_id" , valid_cupone_id , 7 );

                    var claiming_amount = data.amount;
                    setCookie("claiming_amount" , claiming_amount , 7 );

                    if(data.available){
                        if(data.status == "Activated"){
                            if(document.getElementById("amount").value > 5000){
                                document.getElementById("id_cupone_other_status").innerHTML = "Cupone is activated. Amount is Rs." +data.amount;
                                document.getElementById("id_there_cupone").innerHTML = "";
                                document.getElementById("total_payment").innerHTML = "LKR "+(getCookie("t_payment") - (data.amount));
                            }else{
                                document.getElementById("id_cupone_other_status").innerHTML = "There is an activated coupon. But can not use becourse total order not greater than Rs. 5000. Amount is Rs." +data.amount; 
                                document.getElementById("id_there_cupone").innerHTML = "";
                            }
                        }else{
                            document.getElementById("id_cupone_other_status").innerHTML = "There is a coupon.";
                            document.getElementById("id_there_cupone").innerHTML = "Click for activate." ;
                        }
                    }else{
                        document.getElementById("id_cupone_other_status").innerHTML = "There is a no coupon.";
                        document.getElementById("id_there_cupone").innerHTML = "";
                    }
                }
            });
        }

        function getSubdirectory() {
            var loc = window.location;
            var pathArray = loc.pathname.split('/');

            // Find the subdirectory
            var subdirectory = "";
            for (var i = 0; i < pathArray.length; i++) {
                if (pathArray[i].trim() !== "") {
                    subdirectory = pathArray[i];
                    break;
                }
            }

            return subdirectory;
        }
        
        function activate_function_action(activationCode){
            console.log(getCookie("valid_cupone_id"));
            if(activationCode == getCookie("valid_cupone_id")){
                $.ajax({
                    type: "POST",
                    url: "./action/cupone.php",
                    data: { 
                        status: "change_cupone_status", 
                        coupon_code : getCookie("valid_cupone_id"),
                        cupone_status : "Activated"
                    },
                    dataType: "json",
                    success: function(data) {
                        if(data.success){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Your cupone is activated.',
                            }).then((result) => {
                                location.reload(true);
                            });
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'System error. Try again',
                            }); 
                        }
                    }
                });
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Invalid activation code.',
                });
            }
        }

        

    </script>
  </body>
</html>