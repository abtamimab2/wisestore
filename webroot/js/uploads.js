
$(document).ready(function () {

    $('.invalid-fname').hide();
    $('.valid-fname').hide();
    $('.invalid-lname').hide();
    $('.valid-lname').hide();
    $('.invalid-uname').hide();
    $('.valid-uname').hide();
    $('.invalid-pn').hide();
    $('.valid-pn').hide();
    $('.invalid-address').hide();
    $('.valid-address').hide();
    $('.invalid-email').hide();
    $('.valid-email').hide();
    $('.invalid-password').hide();
    $('.valid-password').hide();
    $('.error-box').hide();
    $('.valid-cpassword').hide();
    $('.invalid-cpassword').hide();
    $('.valid-image').hide();
    $('.invalid-image').hide();
    $('.valid-dob').hide();
    $('.invalid-dob').hide();
    
    var bfname = false,blname=false,buname = false,buname = false,bpn = false, baddress = false,bemail = false,bpassword = false,bcpassword=false,bimage=false,buemail=false,bdob=false;
    
    $('form input').keyup(function(event) {
        $('.error-box').hide();
    });

    //validation\\
    //firstname\\
    $('input[name="firstName"]').keyup(function(event) {
        var firstName = $('input[name="firstName"]').val();
        var regex = /^[a-zA-Z_]{3,15}$/;
        if (firstName !== "" && regex.test(firstName)) {
            $('.invalid-fname').fadeOut('slow', function() {
                $('.valid-fname').show();
            });
            bfname = true;
        } else {
            $('.valid-fname').fadeOut('slow', function() {
                $('.invalid-fname').show();
            });
            bfname = false;
        }
    });
    //lastname\\
    $('input[name="lastName"]').keyup(function(event) {
        var lastName = $('input[name="lastName"]').val();
        var regex = /^[a-zA-Z_]{3,15}$/;
        if (lastName !== "" && regex.test(lastName)) {
            $('.invalid-lname').fadeOut('slow', function() {
                $('.valid-lname').show();
            });
            blname = true;
        } else {
            $('.valid-lname').fadeOut('slow', function() {
                $('.invalid-lname').show();
            });
            blname = false;
        }
    });
    //username\\
    $('input[name="userName"]').keyup(function(event) {
        var userName = $('input[name="userName"]').val();
        var regex = /^[a-zA-Z_]{3,15}$/;
        if (userName !== "" && regex.test(userName)) {
            $('.invalid-uname').fadeOut('slow', function() {
                $('.valid-uname').show();
            });
            buname = true;
        } else {
            $('.valid-uname').fadeOut('slow', function() {
                $('.invalid-uname').show();
            });
            buname = false;
        }
    });
    //phone number\\
    $('input[name="phoneNumber"]').keyup(function(event) {
        var phoneNumber = $('input[name="phoneNumber"]').val();
        var regex = /^0\d{9}$/;
        if (phoneNumber !== "" && regex.test(phoneNumber)) {
            $('.invalid-pn').fadeOut('slow', function() {
                $('.valid-pn').show();
            });
            bpn = true;
        } else {
            $('.valid-pn').fadeOut('slow', function() {
                $('.invalid-pn').show();
            });
            bpn = false;
        }
    });
    //address\\
    $('input[name="address"]').keyup(function(event) {
        var address = $('input[name="address"]').val();
        var regex =  /^[a-zA-Z0-9\s\-\,\#\.]{5,100}$/;
        if (address !== "" && regex.test(address)) {
            $('.invalid-address').fadeOut('slow', function() {
                $('.valid-address').show();
            });
            baddress = true;
        } else {
            $('.valid-address').fadeOut('slow', function() {
                $('.invalid-address').show();
            });
            baddress = false;
        }
    });
    //email\\
    $('input[name="email"]').keyup(function(event) {
        var email = $('input[name="email"]').val();
        var regex =  /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        var formData = new FormData();
        formData.append('email', email);
        $.ajax({
            url: '../../pages/phpProces/checkemail.php',
              type: 'POST',
              data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                  if(response == 1 ){
                      buemail = false;
                    $('.valid-email').fadeOut('slow', function() {
                        $("#email-unique").html("<i class='fa fa-exclamation-triangle'></i> This email existed <i class='fa fa-exclamation-triangle'></i>");
                    });
                }else if(response == 2){
                    buemail = true;
                    if(bemail){
                        $("#email-unique").html("");
                        $('.valid-email').fadeIn('slow', function() {});
                    }
                }else{

                }
                },
                error: function(error) {
                  alert('Error: ' + error); // Handle any errors
                }
              });


        if (email !== "" && regex.test(email)) {
            $('.invalid-email').fadeOut('slow', function() {
                $('.valid-email').show();
            });
            bemail = true;
        } else {
            $('.valid-email').fadeOut('slow', function() {
                $('.invalid-email').show();
            });
            bemail = false;
        }
    });


    // date of birth
    $('input[name="dob"]').change(function(event) {
        var dob = new Date($('input[name="dob"]').val());
        var currentDate = new Date();
        var minDate = new Date();
        minDate.setFullYear(minDate.getFullYear() - 100); // Minimum age of 100 years
        var maxDate = new Date();
        maxDate.setFullYear(maxDate.getFullYear() - 7); // Maximum age of 7 years
        
        if (dob >= minDate && dob <= maxDate) {
            $('.invalid-dob').fadeOut('slow', function() {
                $('.valid-dob').show();
            });
            bdob = true;
        } else {
            $('.valid-dob').fadeOut('slow', function() {
                $('.invalid-dob').show();
            });
            bdob = false;
        }
    });
    
    
    //password\\
    $('input[name="password"]').keyup(function(event) {
        var password = $('input[name="password"]').val();
        var regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d#!@$^%&*]{8,}$/;
        
        if (password !== "" && regex.test(password)) {
            $('.invalid-password').fadeOut('slow', function() {
                $('.valid-password').show();
            });
            bpassword = true;
        } else {
            $('.valid-password').fadeOut('slow', function() {
                $('.invalid-password').show();
            });
            bpassword = false;
        }
    });
    //confirm password\\
    $('input[name="confirmpassword"]').keyup(function(event) {
        var confirmpassword = $('input[name="confirmpassword"]').val();
        var password = $('input[name="password"]').val();
        
        if (password !== "" && confirmpassword !== "" && password === confirmpassword) {
            $('.invalid-cpassword').fadeOut('slow', function() {
                $('.valid-cpassword').show();
            });
            bcpassword = true;
        } else {
            $('.valid-cpassword').fadeOut('slow', function() {
                $('.invalid-cpassword').show();
            });
            bcpassword = false;
        }
    });
    // Image File Validation
    $('input[type="file"]').change(function(event) {
        $("#php-error-box").html("");
        var fileInput = event.target;
        var file = fileInput.files[0];
        
        if (file) {
            var fileName = file.name;
            var fileSize = file.size;
            var fileExtension = fileName.split('.').pop().toLowerCase();
            var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Add more extensions if needed
            var maxSizeInBytes = 2048576; // 2MB
            
            if (allowedExtensions.includes(fileExtension) && fileSize <= maxSizeInBytes) {
                bimage = true;
                $('.invalid-image').fadeOut('slow', function() {
                    $('.valid-image').show();
                });
            } else {
                bimage = false;
                $('.valid-image').fadeOut('slow', function() {
                    $('.invalid-image').show();
                });
            }
        }
    });
    //rigistration\\
  $("#register-btn").click(function(event)
  {
      event.preventDefault();
    // alert(bfname + " " + blname  + " " +  buname  + " " +  bpn  + " " +  baddress  + " " +  bemail  + " " +  bpassword  + " " +  bcpassword  + " " +  bimage + " " + buemail);
    if(!bfname || !blname || !buname || !bpn || !baddress || !bemail || !bpassword || !bcpassword || !bimage || !buemail || !bdob){
        $('.error-box').show();
        return;
    }
    var productID = $('input[name="productID"]').val();
    var firstName = $('input[name="firstName"]').val();
    var lastName = $('input[name="lastName"]').val();
    var userName = $('input[name="userName"]').val();
    var phoneNumber = $('input[name="phoneNumber"]').val();
    var address = $('input[name="address"]').val();
    var email = $('input[name="email"]').val();
    var password = $('input[name="password"]').val();
    var confirmpassword = $('input[name="confirmpassword"]').val();
    var fileToUpload = $('#fileToUpload')[0].files[0];
    var dob = $('input[name="dob"]').val();
    var gender = $('input[name="gender"]:checked').val();
  
    var formData = new FormData();
    formData.append('firstName', firstName);
    formData.append('lastName', lastName);
    formData.append('userName', userName);
    formData.append('phoneNumber', phoneNumber);
    formData.append('address', address);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('confirmpassword', confirmpassword);
    formData.append('fileToUpload', fileToUpload);
    formData.append('dob', dob);
    formData.append('gender', gender);
    
    // Send the form data to the PHP server
    $.ajax({
    url: '../../pages/phpProces/regesteruser.php',
      type: 'POST',
      data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(response =="product")
            {
                
                window.location.href="../../pages/user/productDetails.php?productID="+productID;
            }else if(response == "index")
            {
                window.location.href="../../pages/user/index.php";

            }
            // this is happen when the error is occur
            $("#php-error-box").html("<i class='fa fa-exclamation-triangle'></i> " + response + " <i class='fa fa-exclamation-triangle'></i>");
        },
        error: function(error) {
          alert('Error: ' + error); // Handle any errors
        }
      });
  });

  
});