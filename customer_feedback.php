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
    <?php include './common/header_customer.php'; ?>
    <div class="container bg-white mt-5 rounded pb-5  pr-">
        
        <h3 style="font-weight:600; padding-top:4%; color:#161108;" class="text-uppercase">Manage Your Feedbacks</h3>
        <hr/>
        <div class="text-end">
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal">Add Feedback</button>
          <button class="btn btn-outline-dark" onclick="window.location.href='customer_dashboard.php'">Back</button>
        </div>
        <table class="table mt-2" >
            <thead class="bg-dark">
                <tr>
                  <th class="text-white text-center fw-normal">Feedbacks ID</th>
                  <th class="text-white text-center fw-normal">Feedback Type</th>
                  <th class="text-white text-center fw-normal">Title</th>
                  <th class="text-white text-center fw-normal">Time Stamp </th>
                  <th class="text-white text-center fw-normal">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white feedback_tbl">
                
            </tbody>
        </table>
    </div>
      
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Feedbacks</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group pt-3">
                  <label for="feedbackType">Feedback Type</label>
                  <select  class="form-control" id="feedbackType">
                      <option value="">Select Feedback Type</option>
                      <option value="positive">Positive Feedback</option>
                      <option value="negative">Negative Feedback</option>
                  </select>
                </div>
                <div class="form-group pt-3">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" placeholder="Enter title">
                </div>
                <div class="form-group pt-3">
                  <label for="message">Message</label>
                  <textarea class="form-control" id="message" rows="5" placeholder="Enter message"></textarea>
                </div>
               
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" onclick="submitFeedback()">Submit</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Edit Feedbacks</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group pt-3">
                  <label for="feedbackType">Feedback Type</label>
                  <select  class="form-control" id="feedbackTypeEdit">
                      <option value="">Select Feedback Type</option>
                      <option value="positive">Positive Feedback</option>
                      <option value="negative">Negative Feedback</option>
                  </select>
                </div>
                <div class="form-group pt-3">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="titleEdit" placeholder="Enter title">
                  <input type="hidden" class="form-control" id="modalFeedbackId" placeholder="">
                </div>
                <div class="form-group pt-3">
                  <label for="message">Message</label>
                  <textarea class="form-control" id="messageEdit" rows="5" placeholder="Enter message"></textarea>
                </div>
               
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" onclick="submitEditedFeedback()">Edit</button>
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
//      that is used to retrieve the value of a cookie by its name from the browser's cookies.
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

      function submitFeedback() {
            var feedbackType = document.getElementById("feedbackType").value;
            var title = document.getElementById("title").value;
            var message = document.getElementById("message").value;

            var formData = {
                status: "addFeedback",
                feedback_type: feedbackType,
                title: title,
                message: message,
                cusotmer : getCookie("username")
            };

            $.ajax({
                type: "POST",
                url: "./action/feedback.php",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Feedback submitted successfully!',
                            icon: 'success',
                        });
                        loadAllFeedBacks();
                        $('#addModal').modal('hide');
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error submitting feedback: ' + response.error,
                            icon: 'error',
                        });

                    }
                    },error: function (xhr, status, error) {
                        Swal.fire({
                            title: 'AJAX Error',
                            text: 'An error occurred during the AJAX request.',
                            icon: 'error',
                        });
                    },
                });
      }

      function confirmEdit(id) {
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

            var feedbackAddedDate = new Date(response.timestamp);
            var currentDate = new Date();
            var timeDifference = currentDate - feedbackAddedDate;
            var daysDifference = Math.floor(timeDifference / (1000 * 3600 * 24));
            console.log(daysDifference);

            if (daysDifference > 14) {
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'This feedback is more than 14 days old and cannot be edited.',
                });
            } else {
                $('#editModal').modal('show');
                $('#modalFeedbackId').val(response.feedback_id);
                $('#feedbackTypeEdit').val(response.feedback_type);
                $('#titleEdit').val(response.title);
                $('#messageEdit').val(response.message);
            }
            },
            error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while fetching feedback data.',
            });
            }
        });
        }


        loadAllFeedBacks();
        function loadAllFeedBacks(){
          $.ajax({
              url: './action/feedback.php', 
              type: 'POST',
              data:{
                status: "getAllFeedback",
                cusotmer_id : getCookie("username")
              },
              dataType: 'json',
              success: function(data) {

                var tbl_data = data.feedbackList;
                console.log(tbl_data);

                const tbody = $('.feedback_tbl'); 
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
                          <button class="btn btn-danger" onclick="confirmDelete(${feedback.feedback_id})">Delete</button>
                          <button class="btn btn-primary" onclick="confirmEdit(${feedback.feedback_id})">Edit</button>
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

        function confirmDelete(id) {
          Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: './action/feedback.php', 
                type: 'POST', 
                data : {
                  status : "deleteFeedback",
                  feedbackId: id
                },
                success: function(response) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'The feedback has been deleted successfully.',
                }).then(function () {
                    loadAllFeedBacks();
                });

                },
                error: function() {
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: 'An error occurred while deleting the feedback.',
                  });
                }
            });
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

        function submitEditedFeedback() {
              const editId = $('#modalFeedbackId').val(); 
              const fTitleEdit = $('#titleEdit').val(); 
              const fMessageEdit = $('#messageEdit').val(); 
              
              $.ajax({
                  type: 'POST',
                  url: './action/feedback.php', 
                  data: {
                      status: 'updateFeedback',
                      feedbackId: editId,
                      updatedTitle: fTitleEdit,
                      updatedMessage: fMessageEdit
                  },
                  success: function(response) {
                      $('#editModal').modal('hide');
                                          
                      Swal.fire({
                          icon: 'success',
                          title: 'Feedback Updated',
                          text: 'The feedback has been updated successfully.',
                      });
                      loadAllFeedBacks();
                  },
                  error: function() {
                      Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: 'An error occurred while updating the feedback.',
                      });
                  }
              });
          }

    </script>
  </body>
</html>