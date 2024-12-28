<!doctype html>
<html lang="en">
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
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

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
  <body class="bg_color" >
    <?php include './common/before_login.php' ?>
    <div class="container mb-5" >
        <center>
            <h1 style="margin-top: 7%;">AUTHOR REGISTRATION</h1>
        </center>
        <div class="row row-cols-1 row-cols-md-3 g-4" style="background-color: #D5DBDB; margin-top: 2%;">
            
            <div class="col-5 pt-5 pb-5">
                <div class="card" >
                    
                    <div class="card-body" style="background-color: #D5DBDB; border:1px solid #929292">
                        <div class="mb-3 pt-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Enter full name">
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="telephone" class="form-label">Telephone Number</label>
                            <input type="tel" class="form-control" id="telephone" placeholder="Enter telephone number" oninput="validateTelephone()">
                            <small id="tel-status"></small>
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="address" class="form-label">NIC</label>
                            <input class="form-control" id="nic" placeholder="Enter NIC" oninput="nic_validation()">
                            <small id="nic_status"></small>
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-control" id="country" name="country">
                                <option value="">Select Country</option>
                                <option value="Afghanistan">Sri Lanka</option>
                                <option value="Aland Islands">England</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, Democratic Republic of the Congo">Congo, Democratic Republic of the Congo</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Curacao">Curacao</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kosovo">Kosovo</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, the Former Yugoslav Republic of">Macedonia, the Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Barthelemy">Saint Barthelemy</option>
                                <option value="Saint Helena">Saint Helena</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Martin">Saint Martin</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Sint Maarten">Sint Maarten</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-Leste">Timor-Leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.s.">Virgin Islands, U.s.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>                         <option value="">Select Country</option>
                                                            
                            </select>
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="language" class="form-label">Language</label>
                            <select class="form-control" id="language" name="language">
                                <option value="">Select Language</option>
                                <option value="English">English</option>
                                <option value="Sinhala">Sinhala</option>
                                <option value="Spanish">Spanish</option>
                                <option value="French">French</option>
                                <option value="German">German</option>
                                <option value="Chinese">Chinese</option>
                            </select>
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass" placeholder="Enter password" oninput="passwordValid()">
                            <small id="password-status"></small>
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="pass" class="form-label">Confirm - Password</label>
                            <input type="password" class="form-control" id="cpass" placeholder="Enter Confirm password" oninput="cpasswordValid()">
                            <small id="cpassword-status"></small>
                        </div>
                        <div class="mb-3 pt-1">
                            <label for="book_type" class="form-label">Book Type</label>
                            <select class="form-control" id="most_written_book_category">
                                <option value="">Select Book Type</option>
                            </select>
                        </div>
                        <div class="mb-3 pt-1">
                            <div class="d-grid gap-2">
                                <button class="btn btn-dark btn-block text-uppercase" onclick="submit()">Submit</button>
                            </div>
                            <br/>
                            <hr/>
                            <div class="text-center fw-bold" style="cursor: pointer;" onclick="login_page()">
                                <h6>LOGIN PAGE</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7 pt-5 pb-5">
                <div class="card">
                    <div class="card-body">
                        <div id="quill-editor" style="height: 600px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include './common/before_footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const quill = new Quill('#quill-editor', {
                theme: 'snow' 
            });         
        });


        function login_page(){
            window.location.href =  "./login.php";
        }

        function validateTelephone(){
            const telephoneInput = document.getElementById('telephone').value;

            const telephonePattern = /^\d{10}$/;
            const telephoneValue = telephoneInput.trim();

            if (telephonePattern.test(telephoneValue)) {
                document.getElementById("tel-status").innerHTML = "Valid telephone number";
                document.getElementById("tel-status").style.color = "green";
            } else {
                // Telephone number is invalid
                document.getElementById("tel-status").innerHTML = "Invalid telephone number";
                document.getElementById("tel-status").style.color = "red";
            }
        }

        function passwordValid(){
            const passwordInput = document.getElementById('pass').value;

            const strongPasswordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (strongPasswordPattern.test(passwordInput)) {
                // Password is strong
                document.getElementById("password-status").style.color = "green";  
                document.getElementById("password-status").innerHTML = "Password is strong";
            } else {
                // Password is not strong
                document.getElementById("password-status").style.color = "red";
                document.getElementById("password-status").innerHTML = "Password is not strong";
            }
        }

        function cpasswordValid(){
            const passwordInput = document.getElementById('pass');
            const confirmPasswordInput = document.getElementById('cpass');

            const passwordValue = passwordInput.value.trim(); 
            const confirmPasswordValue = confirmPasswordInput.value.trim(); 

            if (passwordValue === confirmPasswordValue) {
                // Passwords match
                document.getElementById("cpassword-status").style.color = "green";
                document.getElementById("cpassword-status").innerHTML = "Passwords are matching";
                
            } else {
                // Passwords do not match
                document.getElementById("cpassword-status").style.color = "red";
                document.getElementById("cpassword-status").innerHTML = "Passwords are not matching";
            }

        }

        function validateEmail() {
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('email-error');
            const emailValue = emailInput.value.trim(); 

            if (emailPattern.test(emailValue)) {
                // Email is valid
                emailError.style.color = 'green';
                emailError.innerHTML = "Email is valid";
            } else {
                // Email is invalid
                emailError.style.color = 'red';
                emailError.innerHTML = "Email is invalid";
            }
        }

        loadBookCategories();
        function loadBookCategories() {
            $.ajax({
                type: 'POST', 
                data: {
                    status: 'list_categories'
                },
                url: './action/book_category.php', 
                success: function (response) {
                    console.log(response);
                    var data = JSON.parse(response);
                    var categories = data.categories;

                    $('#most_written_book_category').empty();

                    $('#most_written_book_category').append('<option value="" disabled selected>Select a category</option>');

                    categories.forEach(function (category) {
                        $('#most_written_book_category').append('<option value="' + category.id + '">' + category.category_name + '</option>');
                    });
                },
                error: function () {
                    console.error('Error fetching book categories');
                }
            });
        }

        function submit(){

            const quill_2 = new Quill('#quill-editor');
            const descriptionHTML = quill_2.root.innerHTML; 

            var fullName = $('#fullName').val();
            var telephoneNumber = $('#telephone').val();
            var nic = $('#nic').val();
            var mostWrittenBookCategory = $('#most_written_book_category').val();
            var country = $('#country').val();
            var language = $('#language').val();
            var password = $('#pass').val();
            var biography = descriptionHTML;

            
            $.ajax({
                type: 'POST',
                url: './action/author.php', 
                data: {
                    status: 'add_author', 
                    full_name: fullName,
                    telephone_number: telephoneNumber,
                    nic: nic,
                    most_written_book_category: mostWrittenBookCategory,
                    country: country,
                    language: language,
                    password: password,
                    biography: biography
                },
                success: function (response) {
                    var result = JSON.parse(response);

                    if (result.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.message
                        });

                        $('#fullName').val('');
                        $('#telephone').val('');
                        $('#nic').val('');
                        $('#most_written_book_category').val('');
                        $('#country').val('');
                        $('#language').val('');
                        $('#pass').val('');
                        $('#cpass').val('');

                        const quill_3 = new Quill('#quill-editor');
                        quill_3.setContents("");

                        document.getElementById("tel-status").innerHTML = "";
                        document.getElementById("nic_status").innerHTML = "";
                        document.getElementById("password-status").innerHTML = "";
                        document.getElementById("cpassword-status").innerHTML = "";

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.message
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong'
                    });
                }
            });

        }

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function nic_validation() {
            var nicInput = document.getElementById("nic");            
            var nicValue = nicInput.value.trim();
            var nicPattern = /^[0-9]{9}[vVxX]$/;
            
            if (nicValue.length === 12 || nicPattern.test(nicValue)) {
                document.getElementById("nic_status").textContent = "NIC is valid";
                document.getElementById("nic_status").classList.remove("text-danger");
                document.getElementById("nic_status").classList.add("text-success");
            } else {
                document.getElementById("nic_status").textContent = "Invalid NIC format";
                document.getElementById("nic_status").classList.remove("text-success");
                document.getElementById("nic_status").classList.add("text-danger");
            }
        }

      
    </script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>