const crypto = require('crypto');

function back(){
    window.location.href = "./customer_dashboard.php";
}

function generateRandomId() {
    const idLength = 8;
    const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    let id = '';

    for (let i = 0; i < idLength; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        id += characters.charAt(randomIndex);
    }

    return id;
}

function currency_select(){
    var convert_currency = document.getElementById("currency").value;
    const api = "https://api.exchangerate-api.com/v4/latest/USD";
    getCurrencyConvert(api , convert_currency , t_payment);
}

function getCurrencyConvert(api, convert_currency , t_payment) {
    var base_currency = "LKR"; 

    fetch(api)
        .then((response) => response.json())
        .then((data) => {
            if (data.rates[base_currency] && data.rates[convert_currency]) {
                const baseRate = data.rates[base_currency];
                const exchangeRate = data.rates[convert_currency];
                const result = 1 / baseRate * exchangeRate;

                var total_payment = (parseFloat(result)*parseFloat(t_payment)).toFixed(1);
                document.getElementById("total_payment").innerHTML = convert_currency+" "+total_payment;
                setCookie("t_payment" , total_payment , 7 );
            } else {
                console.error(`Currency not found in the API response.`);
            }
        })
        .catch((error) => {
            console.error('Error fetching data from the API:', error);
        });
}

function generateCode(orderId, merchantSecretId, merchantId, amountcurrency) {
    const merchantID = merchantId;
    const merchantSecret = merchantSecretId;
    const orderID = orderId;
    const amount =  2500;
    const currency = amountcurrency;
    
    // Format the amount with two decimal places
    const amountFormatted = amount.toFixed(2);
    
    const hash = getMd5(merchantID + orderID + amountFormatted + currency + getMd5(merchantSecret));    
    return hash;
}

function getMd5(input) {
    return CryptoJS.MD5(input).toString().toUpperCase();
}

// cart crud functions
function delete_btn(id) {
            
    Swal.fire({
        title: 'Confirm Deletion',
        text: 'Are you sure you want to delete this item from your cart?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
           
            $.ajax({
                type: "POST",
                url: "./action/cart.php",
                data: { status: "delete_cart_item", cart_item_id: id },
                dataType: "json",
                success: function(data) {
                    if (data.status === "success") {
                        Swal.fire('Deleted!', data.message, 'success');
                        get_all_cart_data();
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    console.error("AJAX error: " + error);
                    Swal.fire('Error', 'An error occurred while deleting the item.', 'error');
                }
            });
        }
    });
}

function get_all_cart_data(){
    console.log(getCookie("username"));
    $.ajax({
        type: "POST",
        url: "./action/cart.php",
        data: { 
            status: "get_cart_item_list",
            user_id : getCookie("username")
        },
        dataType: "json",
        success: function(data) {
            
            // Clear the existing table rows
            $("#cart_tbl").empty();

            // Loop through the cart items and populate the table
            $.each(data, function(index, item) {
                t_payment = t_payment + (parseInt(item.price)*item.quantity);
                var row = $("<tr>");
                row.append("<td>" + item.product_id + "</td>"); // Assuming product_id is the product code
                row.append("<td>" + item.product_name + "</td>");
                row.append("<td> Rs." + item.price + "</td>");
                row.append("<td class='text-center'>" + item.quantity + "</td>");
                row.append("<td>" + item.added_timestamp + "</td>");
                row.append("<td><button class='btn btn-danger' onclick='delete_btn("+item.cart_item_id+")'>Remove</button></td>"); // Add your action button
                $("#cart_tbl").append(row);
            });

            document.getElementById("total_payment").innerHTML = "LKR "+t_payment;
            document.getElementById("amount").value = t_payment;
            
            setCookie("t_payment" , t_payment , 7 );
        },
        error: function(xhr, status, error) {
            console.error("AJAX error: " + error);
        }
    });
}

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

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function activate_now(){
    if(document.getElementById("amount").value > 5000){
        Swal.fire({
            title: 'Enter Activation Code',
            input: 'text',
            inputAttributes: {
            autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Activate',
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                const activationCode = result.value;
                activate_function_action(activationCode);
            } else if (result.isDismissed) {
            Swal.fire('Cancelled', 'Activation process was cancelled.', 'info');
            }
        });
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: 'Your bill must grater than 5000 for activate oupon.',
        });  
    }
}