
<!DOCTYPE html>
<html>

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

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />

  <style>
    /* Import Google font - Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body 
    {
      background: #E3F2FD;
    }

.chatbot-toggler {
  position: fixed;
  bottom: 30px;
  right: 35px;
  outline: none;
  border: none;
  height: 50px;
  width: 50px;
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: #724ae8;
  transition: all 0.2s ease;
}
body.show-chatbot .chatbot-toggler {
  transform: rotate(90deg);
}
.chatbot-toggler span {
  color: #fff;
  position: absolute;
}
.chatbot-toggler span:last-child,
body.show-chatbot .chatbot-toggler span:first-child  {
  opacity: 0;
}
body.show-chatbot .chatbot-toggler span:last-child {
  opacity: 1;
}
.chatbot {
  position: fixed;
  right: 35px;
  bottom: 90px;
  width: 420px;
  background: #fff;
  border-radius: 15px;
  overflow: hidden;
  opacity: 0;
  pointer-events: none;
  transform: scale(0.5);
  transform-origin: bottom right;
  box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
              0 32px 64px -48px rgba(0,0,0,0.5);
  transition: all 0.1s ease;
}
body.show-chatbot .chatbot {
  opacity: 1;
  pointer-events: auto;
  transform: scale(1);
}
.chatbot header {
  padding: 16px 0;
  position: relative;
  text-align: center;
  color: #fff;
  background: #724ae8;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.chatbot header span {
  position: absolute;
  right: 15px;
  top: 50%;
  display: none;
  cursor: pointer;
  transform: translateY(-50%);
}
header h2 {
  font-size: 1.4rem;
}
.chatbot .chatbox {
  overflow-y: auto;
  height: 510px;
  padding: 30px 20px 100px;
}

.chatbox .chat {
  display: flex;
  list-style: none;
}
.chatbox .outgoing {
  margin: 20px 0;
  justify-content: flex-end;
}
.chatbox .incoming span {
  width: 32px;
  height: 32px;
  color: #fff;
  cursor: default;
  text-align: center;
  line-height: 32px;
  align-self: flex-end;
  background: #724ae8;
  border-radius: 4px;
  margin: 0 10px 7px 0;
}
.chatbox .chat p {
  white-space: pre-wrap;
  padding: 12px 16px;
  border-radius: 10px 10px 0 10px;
  max-width: 75%;
  color: #fff;
  font-size: 0.95rem;
  background: #724ae8;
}
.chatbox .incoming p {
  border-radius: 10px 10px 10px 0;
}
.chatbox .chat p.error {
  color: #721c24;
  background: #f8d7da;
}
.chatbox .incoming p {
  color: #000;
  background: #f2f2f2;
}
.chatbot .chat-input {
  display: flex;
  gap: 5px;
  position: absolute;
  bottom: 0;
  width: 100%;
  background: #fff;
  padding: 3px 20px;
  border-top: 1px solid #ddd;
}
.chat-input textarea {
  height: 55px;
  width: 100%;
  border: none;
  outline: none;
  resize: none;
  max-height: 180px;
  padding: 15px 15px 15px 0;
  font-size: 0.95rem;
}
.chat-input span {
  align-self: flex-end;
  color: #724ae8;
  cursor: pointer;
  height: 55px;
  display: flex;
  align-items: center;
  visibility: hidden;
  font-size: 1.35rem;
}
.chat-input textarea:valid ~ span {
  visibility: visible;
}

@media (max-width: 490px) {
  .chatbot-toggler {
    right: 20px;
    bottom: 20px;
  }
  .chatbot {
    right: 0;
    bottom: 0;
    height: 100%;
    border-radius: 0;
    width: 100%;
  }
  .chatbot .chatbox {
    height: 90%;
    padding: 25px 15px 100px;
  }
  .chatbot .chat-input {
    padding: 5px 15px;
  }
  .chatbot header span {
    display: block;
  }
}
  </style>
</head>

<body>

 
<div class="hero_area">
    <!-- header section strats -->
    <?php include './common/before_login.php' ?>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h5>
                      Paper Trails Online Bookstore
                    </h5>
                    <h1>
                      Buy Your <br>
                      Favourite Books
                    </h1>
                    <p>
                    Discover a world of knowledge and imagination. Browse our collection and buy your favorite books today.
                    </p>
                    <a href="./reg_user_type.php">
                      JOIN NOW
                    </a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div > 
                    <img src="./img/slider-img.png" style="width: 130%;" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- catagory section -->

  <section class="catagory_section layout_padding" id="book_category">
    <div class="catagory_container">
      <div class="container ">
        <div class="heading_container heading_center">
          <h2>
            Books Categories
          </h2>
          <p>
            
          </p>
        </div>
        <div class="row" id="category_card">

       
        
        </div>
      </div>
    </div>
  </section>

  <!-- end catagory section -->

  <!-- about section -->

  <section class="about_section layout_padding" id="about_us">
    <div class="container ">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="./img/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About Our Bookstore
              </h2>
            </div>
            <p>
            Welcome to Paper Trails, your premier online destination for literary enthusiasts. Dive into a treasure trove of books spanning genres, cultures, and tastes. Our handpicked collection ensures every book is a gem waiting to be discovered.
            <br/><br/>Choose your reading experience with e-books, audio books, or traditional paperbacks. Join our vibrant online community to connect with fellow book lovers, participate in discussions, and share your passion for literature.
            <br/><br/>Paper Trails is open 24/7, ready to transport you to new realms of imagination at your convenience. We're not just a bookstore; we're a gateway to endless literary adventures. Start your journey today with Paper Trails.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->


  <!-- blog section -->

  <section class="blog_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          From Our Blog
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="img-box">
              <img src="./img/b1.jpg" alt="">
              <h4 class="blog_date">
                <span>
                  07 September 2023
                </span>
              </h4>
            </div>
            <div class="detail-box">
              <h5>
              The Benefits of Reading Books
              </h5>
              <p>
              Reading books is a timeless and enriching activity that offers a multitude of benefits for individuals of all ages. Beyond providing entertainment, books have the power to educate, inspire, and expand one's horizons. One of the primary advantages of reading is knowledge acquisition. 
              </p>
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box">
            <div class="img-box">
              <img src="./img/b2.jpg" alt="">
              <h4 class="blog_date">
                <span>
                  Are you an Author?
                </span>
              </h4>
            </div>
            <div class="detail-box">
            <h5>
              Contact us & Share the following details.
              </h5>
              <p>
             Register first by inserting these information (NIC,Most Written Book Category,Language,If any Biography about you).      
              </p>
              <p>After that you can log in to the Author Dashboard by using your <span  style="font-size: 20px;"><b>Mobile No & Password</b></span></p>
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end blog section -->

  <!-- contact section -->

  <section class="contact_section layout_padding" id="contact_us">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ">
          <div class="heading_container ">
            <h2 class="">
              Contact Us
            </h2>
          </div>
          <div >
            <div>
              <input type="text" placeholder="Name"  id="name"/>
            </div>
            <div>
              <input type="email" placeholder="Email" id="email"/>
            </div>
            <div>
              <input type="text" placeholder="Phone Number" id="phonenumber" />
            </div>
            <div>
              <input type="text" class="message-box" placeholder="Message"  id="message"/>
            </div>
            <div class="btn-box">
              <button onclick="contact_us_btn()">
                SEND
              </button>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="img-box">
            <img src="./img/contact-img.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <button class="chatbot-toggler">
    <span class="material-symbols-rounded">mode_comment</span>
    <span class="material-symbols-outlined">close</span>
  </button>
  <div class="chatbot">
    <header>
      <h2>Chatbot</h2>
      <span class="close-btn material-symbols-outlined">close</span>
    </header>
    <ul class="chatbox">
      <li class="chat incoming">
        <span class="material-symbols-outlined">smart_toy</span>
        <p>Hi there 👋<br>How can I help you today?</p>
      </li>
    </ul>
    <div class="chat-input">
      <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
      <span id="send-btn" class="material-symbols-rounded">send</span>
    </div>
  </div>

  <!-- end contact section -->

  <!-- info section -->
  <?php include './common/before_footer.php' ?>
 

  <!-- jQery -->
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script src="./js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="./js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="./js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->


  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
  
  loadBookCategory();
  function loadBookCategory() {
      $.ajax({
          type: 'POST',
          url: './action/book_category.php',
          data: { status: 'list_categories' },
          success: function (response) {
              var result = JSON.parse(response);
              var categoryContainer = $('#category_card');
              categoryContainer.empty();
              result.categories.forEach(function (category) {
                  var categoryColumn = $('<div>').addClass('col-4');
                  var detailBox = $('<div>').addClass('border p-3 rounded text-center');
                  var categoryName = $('<h3>').text(category.category_name);
                      categoryName.addClass('text-uppercase');

                  detailBox.append(categoryName);
                  categoryColumn.append(detailBox);
                  categoryContainer.append(categoryColumn);
              });
          }
      });
  }

  </script>
  <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    emailjs.init("79uR2xMO421qJDXz2"); 

    function contact_us_btn() {
      var name = document.getElementById("name").value;
      var email = document.getElementById("email").value;
      var phone = document.getElementById("phonenumber").value;
      var message = document.getElementById("message").value;

      emailjs.send("service_x9r76ra", "template_9s4gers", {
        title: "Contact Us",
        name: name,
        telephone_number: phone,
        email: email,
        message: message,
      })
        .then(function(response) {
          console.log("Email sent successfully:", response);
          document.getElementById("name").value = "";
          document.getElementById("email").value= "";
          document.getElementById("phonenumber").value= "";
          document.getElementById("message").value= "";

          // Show a success SweetAlert message
          Swal.fire({
            icon: 'success',
            title: 'Email Sent',
            text: 'Your email has been sent successfully.',
          });
        })
        .catch(function(error) {
          console.error("Email could not be sent:", error);

          // Show an error SweetAlert message
          Swal.fire({
            icon: 'error',
            title: 'Email Not Sent',
            text: 'There was an error sending your email. Please try again later.',
          });
        });

      // Prevent the form from submitting to a different URL
      return false;
    }
  </script>

  <script>
    const chatbotToggler = document.querySelector(".chatbot-toggler");
    const closeBtn = document.querySelector(".close-btn");
    const chatbox = document.querySelector(".chatbox");
    const chatInput = document.querySelector(".chat-input textarea");
    const sendChatBtn = document.querySelector(".chat-input span");

    let userMessage = null; 
    const inputInitHeight = chatInput.scrollHeight;

    

    const createChatLi = (message, className) => {
        const chatLi = document.createElement("li");
        chatLi.classList.add("chat", `${className}`);
        let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
        chatLi.innerHTML = chatContent;
        chatLi.querySelector("p").textContent = message;
        return chatLi; 
    }

    const generateResponse = (chatElement , userMessage) => {
       
          const initialAnswer = [
            "Upon successful payment, you will receive an email with a download link to access your purchased PDFs.",
            "We accept payment via credit/debit cards, PayPal, and bank transfers.",
            "Yes, a limited preview is available for all PDFs to give you a glimpse of the content before purchase.",
            "Refunds are available within 30 days of purchase under our refund policy. Please refer to our terms and conditions for details.",
            "Our PDFs are optimized for mobile viewing on various devices and platforms.",
            "Yes, the purchased PDFs can be printed, unless specified otherwise in the product details.",
            "You can access your account and order history by logging in and visiting the 'My Account' section.",
            "We offer special discounts for bulk purchases. Contact our sales team for more information.",
            "Our customer support team is available to assist with any technical issues regarding the purchased PDFs.",
            "Updates for purchased PDFs are available for download in your account as and when they become available."
          ];

          const messageElement = chatElement.querySelector("p");
          if ((!isNaN(userMessage)) || (initialAnswers.length - 1)) {
                messageElement.textContent = userMessage;
                messageElement.textContent = initialAnswer[userMessage-1];
          }else{
           
                messageElement.textContent = userMessage;
                messageElement.classList.add("error");
                messageElement.textContent = "Invalid option. Try again.";
          }
        
    }

    const handleChat = () => {
        userMessage = chatInput.value.trim(); 
        if(!userMessage) return;

        chatInput.value = "";
        chatInput.style.height = `${inputInitHeight}px`;

        chatbox.appendChild(createChatLi(userMessage, "outgoing"));
        chatbox.scrollTo(0, chatbox.scrollHeight);
        
        setTimeout(() => {
            const incomingChatLi = createChatLi("Thinking...", "incoming");
            chatbox.appendChild(incomingChatLi);
            chatbox.scrollTo(0, chatbox.scrollHeight);
            generateResponse(incomingChatLi , userMessage);
        }, 600);
    }

    chatInput.addEventListener("input", () => {
        chatInput.style.height = `${inputInitHeight}px`;
        chatInput.style.height = `${chatInput.scrollHeight}px`;
    });

    chatInput.addEventListener("keydown", (e) => {
        if(e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
            e.preventDefault();
            handleChat();
        }
    });

    sendChatBtn.addEventListener("click", handleChat);
    closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
    chatbotToggler.addEventListener("click", () => {
      document.body.classList.toggle("show-chatbot");

      if (document.body.classList.contains("show-chatbot")) {
          const initialQuestions = [
              "1. \nHow can I download the purchased PDFs?",
              "2. \nWhat payment methods do you accept?",
              "3. \nIs there a preview available for the PDFs?",
              "4. \nDo you offer refunds for purchased PDFs?",
              "5. \nAre the PDFs compatible with mobile devices?",
              "6. \nCan I print the purchased PDFs?",
              "7. \nHow do I access my account/order history?",
              "8. \nAre there discounts for bulk PDF purchases?",
              "9. \nDo you provide customer support for technical issues?",
              "10. \nAre there updates available for purchased PDFs?",
              "---------------------"
          ];

          // Clear existing chat content
          chatbox.innerHTML = "";

          // Display initial questions
          initialQuestions.forEach((question) => {
              const initialQuestionLi = createChatLi(question, "incoming");
              chatbox.appendChild(initialQuestionLi);
          });
      }
  });

  </script>
 </body>

</html>