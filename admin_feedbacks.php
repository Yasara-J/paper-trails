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
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">MANAGE fEEDBACKS</h3>
        <hr/>
        <div class="text-end">
          <button class="btn btn-outline-dark" onclick="window.location.href='admin_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
          <thead class="bg-dark">
              <tr>
                <th class="text-white text-center fw-normal">Feedback ID</th>
                <th class="text-white text-center fw-normal">Feedback Type</th>
                <th class="text-white text-center fw-normal">Added By </th>
                <th class="text-white text-center fw-normal">Added Date</th>
                <th class="text-white text-center fw-normal">Action</th>
              </tr>
          </thead>
          <tbody class="bg-white" id="feedback_tbl">
            
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
      
        loadAllFeedBacks();
        function loadAllFeedBacks(){
          $.ajax({
              url: './action/feedback.php', 
              type: 'POST',
              data:{
                status: "getAllFeedbackAdmin"              
              },
              dataType: 'json',
              success: function(data) {
                console.log(data);
                var tbl_data = data.feedbackList;
                console.log(tbl_data);

                const tbody = $('#feedback_tbl'); 
                var row = ``;
                for (const feedback of tbl_data) {
                  const feedbackType = feedback.feedback_type === 'positive' ? 'Positive Feedback' : 'Negative Feedback';

                  row += `
                    <tr>
                      <td class="text-center">${feedback.feedback_id}</td>
                      <td class="text-center">${feedbackType}</td>
                      <td class="text-center">${feedback.title}</td>
                      <td class="text-center">${feedback.timestamp}</td>
                      <td class="text-center">
                          <button class="btn btn-info" onclick="viewFeedBack(${feedback.feedback_id})">View</button>
                      </td>
                    </tr>
                    `;

                  }
                tbody.html(row);
              },
              error: function() {
                console.error('Error fetching data');
              }
          });
        }

        function viewFeedBack(id) {
          $.ajax({
              type: 'POST',
              url: './action/feedback.php',
              data: {
              status: 'getOneFeedback',
              feedbackId: id
            },
            dataType: 'json',
            success: function (response) {
              console.log(response);
              const feedbackData = {
                  id: id,
                  message: response.message,
                  feedback_type: response.feedback_type,
                  title: response.title
              };

              Swal.fire({
                  title: 'Feedback Details',
                  html: `<div class='text-start'><p>Feedback Type : ${feedbackData.feedback_type}</p><p>Message: <br/>${feedbackData.message}</p></div>`,
                  icon: 'info',
                  showCancelButton: false,
                  showConfirmButton: true,
                  confirmButtonText: 'OK',
              });
            }
          });
           
        }
    </script>
  </body>
</html>