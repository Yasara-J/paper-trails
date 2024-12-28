
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

</head>

<body>

 
<div >
    <!-- header section strats -->
    <?php include './common/before_login.php' ?>
    <!-- end header section -->
  </div>
  <div class="container mt-5">
        <h1 class="text-center mb-5">Frequently Asked Questions</h1>
        <div id="faqAccordion">


        </div>
    </div>
    <div style="margin-top: 10%;"></div>
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
  
  <script>
        // FAQ data in an array format (you can add more items)
        const faqList = [
            {
                question: "1. How do I purchase books on Paper Trails?",
                answer: "To purchase books on Paper Trails, follow these steps: 1. Browse our collection and select the book you want. 2. Click the 'Buy Now' button on the book's page. 3. Follow the checkout process to complete your purchase. 4. After payment, you'll receive a download link for the PDF."
            },
            {
                question: "2. Can I read the purchased books on any device?",
                answer: "Yes, you can read your purchased books on any device that supports PDF viewing, such as computers, tablets, and smartphones."
            },
            {
                question: "3. What payment methods are accepted?",
                answer: "We accept various payment methods, including credit/debit cards (Visa, MasterCard), PayPal, and more. You can choose your preferred method during checkout."
            },
            {
                question: "4. How do I access my purchased PDFs?",
                answer: "After completing your purchase, you'll receive an email with a download link. You can also access your purchased PDFs by logging into your Paper Trails account and visiting the 'My Purchases' section."
            },
            {
                question: "5. Is there a refund policy?",
                answer: "Yes, we have a 30-day refund policy. If you're not satisfied with your purchase, please contact our customer support, and we'll assist you with the refund process."
            },
            {
                question: "6. Do I need to create an account to make a purchase?",
                answer: "No, you can make a purchase as a guest user. However, creating an account allows you to track your orders and access your purchased PDFs more easily."
            },
            {
                question: "7. Are the PDFs DRM-protected?",
                answer: "No, our PDFs are not DRM-protected. You have full control over your purchased PDFs and can use them on any compatible device."
            },
            {
                question: "8. How do I contact customer support?",
                answer: "You can reach our customer support team by emailing support@papertrails.com or using the contact form on our website. We aim to respond to inquiries within 24 hours."
            },
            {
                question: "9. Can I share my purchased PDFs with others?",
                answer: "No, sharing or distributing purchased PDFs is prohibited and violates our terms of service. Each PDF is intended for personal use only."
            },
            {
                question: "10. What genres of books do you offer?",
                answer: "We offer a wide range of book genres, including fiction, non-fiction, romance, mystery, self-help, and more. You can explore our collection to find your preferred genre."
            },
            {
                question: "11. Are there discounts for bulk purchases?",
                answer: "Yes, we offer discounts for bulk purchases. If you plan to buy a large number of books, please contact our sales team for pricing information and special offers."
            },
            {
                question: "12. How do I change my account password?",
                answer: "To change your account password, log in to your account, go to the 'Account Settings' section, and select the 'Change Password' option. Follow the instructions to set a new password."
            },
            {
                question: "13. Are there any restrictions on printing the PDFs?",
                answer: "Most PDFs have no printing restrictions. However, some publishers may impose printing limits. Check the PDF details for any printing restrictions before making a purchase."
            },
            {
                question: "14. Do you offer international shipping?",
                answer: "Yes, we offer international shipping for physical books. Shipping costs and delivery times may vary depending on your location. Please check our shipping information for details."
            },
            {
                question: "15. How do I download PDFs to my mobile device?",
                answer: "To download PDFs to your mobile device, open the download link in your email or log in to your account on your mobile browser. Click the download button, and the PDF will be saved to your device."
            },
            {
                question: "16. Can I request a specific book that is not in your collection?",
                answer: "Yes, you can submit a book request through our website. We will do our best to add requested books to our collection based on availability and licensing."
            },
            {
                question: "17. What formats are the books available in?",
                answer: "Our books are primarily available in PDF format for easy compatibility across devices. We may also offer ePUB and MOBI formats for select titles."
            },
            {
                question: "18. How can I report a technical issue or bug?",
                answer: "If you encounter a technical issue or bug while using our website or apps, please contact our technical support team at techsupport@papertrails.com. Provide as much detail as possible to help us resolve the issue quickly."
            },
            {
                question: "19. Do you have a mobile app?",
                answer: "Yes, we have a mobile app available for both iOS and Android devices. You can download it from the App Store or Google Play Store to access our books and features on your mobile device."
            },
            {
                question: "20. Is my personal information secure?",
                answer: "Yes, we take data security seriously. We use industry-standard encryption and security measures to protect your personal information and payment details. For more information, please review our privacy policy."
            }
        ];


        // Function to load FAQ items
        function loadFAQ() {
            const faqList = document.getElementById("faqList");

            faqData.forEach((item, index) => {
                const listItem = document.createElement("li");
                listItem.className = "list-group-item";
                listItem.innerHTML = `
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse${index}" aria-expanded="true" aria-controls="faqCollapse${index}">
                        ${item.question}
                    </button>
                    <div id="faqCollapse${index}" class="collapse" data-parent="#faqList">
                        <div class="card-body">
                            ${item.answer}
                        </div>
                    </div>
                `;
                faqList.appendChild(listItem);
            });
        }

        function loadFAQ() {
            const faqAccordion = document.getElementById("faqAccordion");

            faqList.forEach((item, index) => {
                const cardContainer = document.createElement("div");
                cardContainer.className = "card mb-3";

                const cardHeader = document.createElement("div");
                cardHeader.className = "card-header";
                cardHeader.innerHTML = `
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse${index}" aria-expanded="true" aria-controls="faqCollapse${index}">
                            ${item.question}
                        </button>
                    </h5>
                `;

                const cardBody = document.createElement("div");
                cardBody.id = `faqCollapse${index}`;
                cardBody.className = "collapse";
                cardBody.setAttribute("aria-labelledby", `faqHeading${index}`);
                cardBody.setAttribute("data-parent", "#faqAccordion");
                cardBody.innerHTML = `
                    <div class="card-body">
                        ${item.answer}
                    </div>
                `;

                cardContainer.appendChild(cardHeader);
                cardContainer.appendChild(cardBody);

                faqAccordion.appendChild(cardContainer);
            });
        }

        window.onload = loadFAQ;

    </script>
 </body>

</html>