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
    <?php include './common/header_author.php'; ?>
    <div class="container">
        <div class="row pb-3 mt-5" style="background-color: white; border-radius:20px; border:2px solid #BA8B02;">
            <div class="col" style="padding-left: 5%;" >
                <h2 class="text-uppercase" style="padding-top: 10%; font-weight:700;">AUTHOR dashboard</h2>
                <hr/>
                <div class="ms-5">
                    <h5 id="name"></h5>
                    <h5 style="padding-top:4px;" id="telephone"></h5>
                    <h5 style="padding-top:4px;" id="nic"></h5>
                    <h5 style="padding-top:4px;" id="country"></h5>
                    <h5 style="padding-top:4px;" id="language"></h5>
                </div>
            </div>
            <div class="col text-end pe-5">
                <img src="./img/author.jpg" style="width: 82%;" />
            </div>
        </div>
        <h4 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Action of the Author panel</h4>
        <hr/>
        <div class="row row-cols-1 row-cols-md-3 g-4">
         
          <div class="col">
            <div class="card"  style="background-color: #D3D6DE;" onclick="window.location.href='author_book.php'">
              <div class="p-4 text-center">
                <img src="./img/books.png" class="card-img-top" alt="..." style="width: 160px;">
              </div>
              <div class="card-body">
                <h4 class="card-title text-uppercase text-center">BOOKS</h4>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card"  style="background-color: #E1E8DF;" onclick="window.location.href='author_pay_history.php'">
              <div class="p-4 text-center">
                <img src="./img/payments.png" class="card-img-top" alt="..." style="width: 160px;">
              </div>
              <div class="card-body">
                <h4 class="card-title text-uppercase text-center">PAYMENTS HISTORY</h4>
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
    <script>
       
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

        get_author_details();
        function get_author_details(){
          var url = './action/author.php'; 

          var data = {
              author_id: getCookie("username"),
              status : "get_author_profile"
          };

    
          $.ajax({
              url: url,
              type: 'POST', 
              data: data,
              dataType: 'json', 
              success: function(response) {
                  console.log(response[0]);
                  var authorData = response[0];
                  console.log(authorData);
                  $('#name').text('Name: ' + authorData.full_name);
                  $('#telephone').text('Telephone: ' + authorData.telephone_number);
                  $('#nic').text('NIC: ' + authorData.nic);
                  $('#country').text('Country: ' + authorData.country);
                  $('#language').text('Language: ' + authorData.language);
                 
              },
              error: function(xhr, status, error) {
                  // Handle AJAX errors (e.g., network issues)
                  console.error('AJAX Error: ' + status + ' - ' + error);
              }
          });
        }
    </script>
  </body>
</html>