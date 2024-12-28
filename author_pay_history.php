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
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Payment History</h3>
        <hr/>
       
        <div class="mt-2 mb-4">
          <div class="card">
                  <div class="card-header">
                      Total Income Summery
                  </div>
                  <div class="card-body" style="background-color: #F1F3F1;">
                    <div class="row">
                      <div  class="col">
                          <div class="form-group">
                              <label for="startDate">Start Date:</label>
                              <input type="date" class="form-control" id="startDate">
                          </div>
                      </div>
                      <div  class="col">
                          <div class="form-group">
                              <label for="endDate">End Date:</label>
                              <input type="date" class="form-control" id="endDate">
                          </div>
                      </div>
                    </div>
                    <div class="text-end mt-2 mb-5">
                      <button class="btn btn-primary" onclick="filter_payments()">Filter</button>
                      <button class="btn btn-danger" onclick="clear()">Clear</button>
                      <button class="btn btn-outline-dark" onclick="window.location.href='author_dashboard.php'">Back</button>

                    </div>
                    <div class="text-center">
                      <h2 class="card-title">Total: RS.<span id="t_price"></span></h2>
                    </div>
              </div>
          </div>
        </div>
        <table class="table mt-2" >
            <thead class="bg-dark">
                <tr>
                  <th class="text-white text-center fw-normal">Book</th>
                  <th class="text-white text-center fw-normal">Amount</th>
                  <th class="text-white text-center fw-normal">Pay By</th>
                  <th class="text-white text-center fw-normal">Time Stamp </th>
                </tr>
            </thead>
            <tbody class="bg-white payment_tbl">
                
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
    <?php include './common/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>

      
      
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

      function clear(){
        get_all_payment();
      }

      get_all_payment();
      function get_all_payment() {
        var user_id = getCookie("username");
        var t_payment = 0;
        $.ajax({
            url: './action/cart.php', 
            type: 'POST', 
            data: { 
              status: 'payment_history', 
              user_id : user_id
            }, 
            dataType: 'json', 
            success: function(response) {
              console.log(response);
              const tableBody = document.querySelector('.payment_tbl');
              tableBody.innerHTML = '';


              response.forEach((payment) => {
                  const row = tableBody.insertRow();
                  const titleCell = row.insertCell(0);
                  titleCell.textContent = payment.title;
                  titleCell.style.textAlign = 'center';

                  const discountCell = row.insertCell(1);
                  discountCell.textContent = "Rs. "+(parseInt(payment.price)*parseInt(payment.quantity));
                  discountCell.style.textAlign = 'center';

                  t_payment = t_payment + (parseInt(payment.price)*parseInt(payment.quantity));

                  const payByCell = row.insertCell(2);
                  payByCell.textContent = payment.FullName;
                  payByCell.style.textAlign = 'center';

                  const timestampCell = row.insertCell(3);
                  timestampCell.textContent = payment.added_timestamp;
                  timestampCell.style.textAlign = 'center';

                
                
              });

              document.getElementById("t_price").innerHTML = t_payment+".00";

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
      }

      function filter_payments(){
        var t_payment = 0;
        var start_date = document.getElementById("startDate").value;
        var end_date = document.getElementById("endDate").value;
        var user_id = getCookie("username");
        document.getElementById("t_price").innerHTML = "0.00";

        $.ajax({
            url: './action/cart.php', 
            type: 'POST', 
            data: { 
              status: 'payment_history_filter',
              user_id : user_id,
              start_date : start_date,
              end_date : end_date
            }, 
            dataType: 'json', 
            success: function(response) {
              console.log(response);
              const tableBody = document.querySelector('.payment_tbl');
              tableBody.innerHTML = '';

              response.forEach((payment) => {
                  const row = tableBody.insertRow();
                  const titleCell = row.insertCell(0);
                  titleCell.textContent = payment.title;
                  titleCell.style.textAlign = 'center';

                  const discountCell = row.insertCell(1);
                  discountCell.textContent = "Rs. "+(parseInt(payment.price)*parseInt(payment.quantity));
                  discountCell.style.textAlign = 'center';

                  t_payment = t_payment + (parseInt(payment.price)*parseInt(payment.quantity));

                  const payByCell = row.insertCell(2);
                  payByCell.textContent = payment.FullName;
                  payByCell.style.textAlign = 'center';

                  const timestampCell = row.insertCell(3);
                  timestampCell.textContent = payment.added_timestamp;
                  timestampCell.style.textAlign = 'center';

                 

                 
              });

              document.getElementById("t_price").innerHTML = t_payment+".00";

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
      }

    </script>
  </body>
</html>