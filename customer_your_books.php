

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet" >
    <title>Paper Trails</title>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    <style>
        #canvas_container {
            width: 100%;
            height: 600px;
            overflow: auto;
        }
        #canvas_container {
            background: #333;
            text-align: center;
            border: solid 3px;
        }
    </style>
  </head>
  <body class="bg_color" >
    <?php include './common/header_customer.php'; ?>
    <div class="container">
        
        <h4 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Your Books..</h4>
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
                            <div class="col-12">
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
                                            <tbody id="your_book_tbl">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal fade" id="pdfReadingModal" tabindex="-1" aria-labelledby="pdfReadingModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="pdfReadingModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="pdfViewerContainer">
                        <div id="my_pdf_viewer">
                            <div id="canvas_container">
                                <canvas id="pdf_renderer"></canvas>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

        $(document).ready(function() {
            function loadData() {
                
                $.ajax({
                    type: "POST", 
                    url: "./action/cart.php", 
                    data : {
                        status : "get_all_Cart_items_in_paid",
                        user_id: getCookie("username")
                    },
                    dataType: "json",
                    success: function(data) {
                        
                        $("#your_book_tbl").empty();

                        $.each(data, function(index, item) {
                                var row = $("<tr>");
                                row.append("<td class='text-center'>" + item.product_id + "</td>");
                                row.append("<td>" + item.product_name + "</td>");
                                row.append("<td class='text-center'>RS . " + item.price + "</td>");
                                row.append("<td class='text-center'>" + item.quantity + "</td>");
                                row.append("<td class='text-center'>" + item.added_timestamp + "</td>");

                                var readButton = $("<button class='btn btn-primary' style='margin-right: 10px;'>READ</button>&nbsp;");
                                readButton.click(function() {
                                    open_reading_model(item);
                                });

                                var downloadButton = $("<button class='btn btn-success'>DOWNLOAD</button>");
                                downloadButton.click(function() {
                                    download_action(item);
                                });

                                var actionCell = $("<td class='text-center'>").append(readButton, downloadButton);
                                row.append(actionCell);

                                $("#your_book_tbl").append(row);
                            });

                    },
                    error: function(error) {
                        console.error("Error loading data:", error);
                    }
                });
            }

            loadData();
        });

        function open_reading_model(item){
            
            $.ajax({
                    type: "POST", 
                    url: "./action/book.php", 
                    data : {
                        status : "get_one_book",
                        id: item.product_id
                    },
                    dataType: "json",
                    success: function(data) {
                        if(data.status == "success"){
                            load_pdf(data.book.doc_link);
                            console.log(data.book);
                            document.getElementById("pdfReadingModalLabel").innerHTML = data.book.title;
                        }
                    }
            });
            $("#pdfReadingModal").modal("show");
        }

        function download_action(item){
              
            $.ajax({
                    type: "POST", 
                    url: "./action/book.php", 
                    data : {
                        status : "get_one_book",
                        id: item.product_id
                    },
                    dataType: "json",
                    success: function(data) {
                        if(data.status == "success"){
                            
                            var url = './action/uploads/' + data.book.doc_link;
                            window.open(url, '_blank');

                        }
                    }
            });
        }

        function back(){
            window.location.href = "./customer_dashboard.php";
        }

   

        function load_pdf(file_name){
            var myState = {
                pdf: null,
                currentPage: 1,
                zoom: 1
            }
        
            pdfjsLib.getDocument('./action/uploads/'+file_name).then((pdf) => {
        
                myState.pdf = pdf;
                render();
            });
            function render() {
                myState.pdf.getPage(myState.currentPage).then((page) => {
            
                    var canvas = document.getElementById("pdf_renderer");
                    var ctx = canvas.getContext('2d');
        
                    var viewport = page.getViewport(myState.zoom);
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
            
                    page.render({
                        canvasContext: ctx,
                        viewport: viewport
                    });
                });
            }
        }
    </script>
    
  </body>
</html>