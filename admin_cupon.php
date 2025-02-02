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
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">MANAGE COUPON</h3>
        <hr/>
        <div class="text-end">
          <button class="btn btn-outline-dark" onclick="window.location.href='admin_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
          <thead class="bg-dark">
              <tr>
                <th class="text-white text-center fw-normal">Cupon ID</th>
                <th class="text-white text-center fw-normal">Cupon Price</th>
                <th class="text-white text-center fw-normal">Customer </th>
                <th class="text-white text-center fw-normal">Expire Time</th>
                <th class="text-white text-center fw-normal">Date Time</th>
                <th class="text-white text-center fw-normal">Status</th>
              </tr>
          </thead>
          <tbody class="bg-white" id="cupon_tbl_body">
            
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
      function loadDataIntoTable() {
          $.ajax({
              type: "POST",
              url: "./action/cupone.php",
              data : {
                status : 'load_all_coupons'
              },
              dataType: "json",
              success: function(response) {
                  if (response && response.length > 0) {
                      const tableBody = document.getElementById('cupon_tbl_body');
                      tableBody.innerHTML = '';
                      response.forEach((coupon) => {
                          const row = tableBody.insertRow();
                          const couponIdCell = row.insertCell(0);
                          couponIdCell.style.textAlign = 'center';

                          const couponPriceCell = row.insertCell(1);
                          couponPriceCell.style.textAlign = 'center';

                          const customerCell = row.insertCell(2);
                          customerCell.style.textAlign = 'center';

                          const expireTimeCell = row.insertCell(3);
                          expireTimeCell.style.textAlign = 'center';

                          const dateTimeCell = row.insertCell(4);
                          dateTimeCell.style.textAlign = 'center';

                          const statusCell = row.insertCell(5);
                          statusCell.style.textAlign = 'center';

                          couponIdCell.textContent = coupon.coupon_id;
                          couponPriceCell.textContent = coupon.amount;
                          customerCell.textContent = coupon.FullName;
                          expireTimeCell.textContent = coupon.expire_date;
                          dateTimeCell.textContent = coupon.time_stamp;
                          statusCell.textContent = coupon.status;
                      });
                  } else {
                      Swal.fire('No Coupons Found', 'There are no coupons available.', 'info');
                  }
              },
              error: function() {
                  Swal.fire('Error', 'An error occurred while fetching coupon data.', 'error');
              }
          });
      }

      loadDataIntoTable();

    </script>
  </body>
</html>