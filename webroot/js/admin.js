
$(document).ready(function(){

  var currentPhotoseN;
  var selectedUpFiles = [];
  var selected = false;

  if (window.location.pathname === '/aflaitedMarketingSelling/pages/admin/productedit.php') {
    var names = $("#prePhotoNames").val();
    selected = true;
    currentPhotoseN = names.split(",");
    currentPhotoseN.pop();
    updateUP();
  }

  $(document).on("click", ".photo-cross-up", function() {
    var currentIndex = $(this).data("current-index");
    var currentPhoto = $(this).data("current-photo");
    if(currentPhoto == "yes"){
      currentPhotoseN.splice(currentIndex, 1);
    }else{
      currentIndex = currentIndex - currentPhotoseN.length;
      selectedUpFiles.splice(currentIndex, 1);
    }
    updateUP();
  });

  function updateUP(){
    var photoArea = $(".photoese-area");
    photoArea.empty(); // Remove all child elements
    var ind = 0;
    for (var i = 0; i < currentPhotoseN.length; i++) {
      photoArea.append(
        "<div class='photo-div'><img src='../../webroot/images/products/"+currentPhotoseN[i]+"'><img data-current-photo='yes' data-current-index='"+ind+"' class='photo-cross-up' src='../../webroot/images/site/crosDisenable.png'></div>"
      );
      ind++;
    }
    for (var i = 0; i < selectedUpFiles.length; i++) {
      var filePath = URL.createObjectURL(selectedUpFiles[i]);
      photoArea.append(
        "<div class='photo-div'><img src='"+ filePath +"'><img data-current-photo='no' data-current-index='"+ind+"' class='photo-cross-up' src='../../webroot/images/site/crosDisenable.png'></div>"
      );
      ind++;
    }
    photoArea.append("<div class='last-photo-div photo-div'><label id='input-plus-label' for='photosUPInput'><i id='input-plus-label-i' class=' hoverable fa fa-plus'></i></label><input type='file'  name='photos' id='photosUPInput' multiple></div>");
  }


  
  $(document).on("change", "#photosUPInput", function(){
  var fileInput = document.getElementById('photosUPInput');
  var files = fileInput.files;
  var totalInsideImageCount = $(".photoese-area").children().length - 1;
  var toInImCo = totalInsideImageCount + files.length;
  if(toInImCo > 8){
    alert("You Can Select Just 8 Picture!!!");
  }else{
    for (var i = 0; i < files.length; i++) {
       var filePath = URL.createObjectURL(files[i]);
       // Get the file type
       var fileType = files[i].type;

       // Check the file type
       if (fileType === "image/jpeg" || fileType == "image/jpg" || fileType === "image/png") {
        selectedUpFiles.push(files[i]);
         var currentIndex = (selectedUpFiles.length - 1) + (currentPhotoseN.length);
         var toInImCo = totalInsideImageCount + files.length;
         $(".last-photo-div").before(
          "<div class='photo-div'><img src='"+filePath+"'><img data-current-photo='no' data-current-index='"+currentIndex+"' class='photo-cross-up' src='../../webroot/images/site/crosDisenable.png'></div>"
         );
       }else{
         alert("Please Select jpeg or jpg or png!!!");
       }
     }
   }
   if(toInImCo == 8){
     $("#input-plus-label").on("click", function(event) {
       event.preventDefault();
     });

     $("#input-plus-label-i").removeClass("hoverable");
     $("#input-plus-label-i").addClass("disabled");
   }

});
  
  
//update product form
$("#updateProduct").click(function() {

  var totalstar = 0;
  $('.list-inline-item').each(function(index) {
    if($(this).find('i').hasClass('fa-star')){
      totalstar++;
    }
  });

  var formData = new FormData();
  for (var i = 0; i < selectedUpFiles.length; i++) {
    formData.append('photos[]', selectedUpFiles[i]);
  }
  for (var i = 0; i < currentPhotoseN.length; i++) {
    formData.append('photosNames[]', currentPhotoseN[i]);
  }
  var productID = $('input[name="productID"]').val();
  var pname = $('input[name="pname"]').val();
  var pTitle = $('#pTitle').val();
  var pDescription = $('#pDescription').val();
  var pCategory = $('#pCategory').val();
  var pBrand = $('#pBrand').val();
  var PostId = $('#PostId').val();
  var qtyStock = $('input[name="qtyStock"]').val();
  var purchasePrice = $('input[name="purchasePrice"]').val();
  var salesPrice = $('input[name="salesPrice"]').val();
  var weight = $('input[name="weight"]').val();
  var discoutPercentage = $('input[name="discoutPercentage"]').val();
  var link = $('input[name="link"]').val();
  var linkName = $('input[name="linkName"]').val();
  var rating = $('input[name="rating"]').val();
  var featured =0;
  if ($('input[name="featured"]').prop('checked')) {
    featured = 1;
  }

  // Append the productID to the formData
  formData.append('productID', productID);
  formData.append('pname', pname);
  formData.append('pTitle', pTitle);
  formData.append('pDescription', pDescription);
  formData.append('pCategory', pCategory);
  formData.append('pBrand', pBrand);
  formData.append('PostId', PostId);
  formData.append('qtyStock', qtyStock);
  formData.append('purchasePrice', purchasePrice);
  formData.append('salesPrice', salesPrice);
  formData.append('weight', weight);
  formData.append('discoutPercentage', discoutPercentage);
  formData.append('link', link);
  formData.append('linkName', linkName);
  formData.append('featured', featured);
  formData.append('totalstar', totalstar);
  formData.append('rating', rating);
  
  // Send the form data to the PHP server
  $.ajax({
    url: '../../pages/phpProces/updateProduct.php',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      if(response == 1){
        window.location.href = '../../pages/admin/productdetails.php?productID='+productID;
      }else if(response == -1 ){
        alert("Faild! Can not select the pImage table");
      }else if(response == -2){
        alert("Faild! Can not delete from pImage table");
      }else if(response == -3){
        alert("Faild! Can not update the product table");
      }else if(response == -4){
        alert("Faild! Can not upload the selected files");
      }else if(response == -5){
        alert("Faild! Can not insert to pimage table");
      }else{
        console.log(response);
      }
    },
    error: function(error) {
      alert('Invalid Error: ' + error); // Handle any errors
    }
  });
});


    
  
  
  
  
  
  
    var selectedFiles = [];

    $(document).on("change", "#photosInput", function(){
    var fileInput = document.getElementById('photosInput');
    var files = fileInput.files;
    var totalInsideImageCount = $(".photoese-area").children().length - 1;
    var toInImCo = totalInsideImageCount + files.length;
    if(toInImCo > 8){
      alert("You Can Select Just 8 Picture!!!");
    }else{
      for (var i = 0; i < files.length; i++) {
        var filePath = URL.createObjectURL(files[i]);
        // Get the file type
        var fileType = files[i].type;

        // Check the file type
        if (fileType === "image/jpeg" || fileType == "image/jpg" || fileType === "image/png") {
          selectedFiles.push(files[i]);
          var currentIndex = selectedFiles.length - 1;
          var toInImCo = totalInsideImageCount + files.length;
          $(".last-photo-div").before(
            "<div class='photo-div'><img src='"+ filePath +"'><img data-current-index='"+currentIndex+"' class='photo-cross-img' src='../../webroot/images/site/crosDisenable.png'></div>"
          );
        }else{
          alert("Please Select jpeg or jpg or png!!!");
        }
      }
    }
    if(toInImCo == 8){
      $("#input-plus-label").on("click", function(event) {
        event.preventDefault();
      });

      $("#input-plus-label-i").removeClass("hoverable");
      $("#input-plus-label-i").addClass("disabled");
    }

  });

  $(document).on("click", ".photo-cross-img", function() {
    var currentIndex = $(this).data("current-index");
    selectedFiles.splice(currentIndex, 1);
    updateImages();
  });  


  function updateImages() {
    var photoArea = $(".photoese-area");
    photoArea.empty(); // Remove all child elements

    for (var i = 0; i < selectedFiles.length; i++) {
      var filePath = URL.createObjectURL(selectedFiles[i]);
      photoArea.append(
        "<div class='photo-div'><img src='"+ filePath +"'><img data-current-index='"+i+"' class='photo-cross-img' src='../../webroot/images/site/crosDisenable.png'></div>"
      );
    }
    photoArea.append("<div class='last-photo-div photo-div'><label id='input-plus-label' for='photosInput'><i id='input-plus-label-i' class=' hoverable fa fa-plus'></i></label><input type='file'  name='photos' id='photosInput' multiple></div>");
  }


  $(document).on("mouseenter", ".photo-cross-img", function() {
    $(this).attr("src", "../../webroot/images/site/crosEnable.png");
  });

  $(document).on("mouseleave", ".photo-cross-img", function() {
    $(this).attr("src", "../../webroot/images/site/crosDisenable.png");
  });


    // Function to upload files after all form steps are completed
    // insert to table
    function uploadFiles() {

      var totalstar = 0;
      $('.list-inline-item').each(function(index) {
        if($(this).find('i').hasClass('fa-star')){
          totalstar++;
        }
      });

      var formData = new FormData();
      for (var i = 0; i < selectedFiles.length; i++) {
        formData.append('photos[]', selectedFiles[i]);
      }

      var pname = $('input[name="pname"]').val();
      var pTitle = $('#pTitle').val();
      var pDescription = $('#pDescription').val();
      var pCategory = $('#pCategory').val();
      var pBrand = $('#pBrand').val();
      var qtyStock = $('input[name="qtyStock"]').val();
      var purchasePrice = $('input[name="purchasePrice"]').val();
      var salesPrice = $('input[name="salesPrice"]').val();
      var weight = $('input[name="weight"]').val();
      var discoutPercentage = $('input[name="discoutPercentage"]').val();
      var link = $('input[name="link"]').val();
      var linkName = $('input[name="linkName"]').val();
      var rating = $('input[name="rating"]').val();
      var PostId = $('#PostId').val();

      var featured =0;
      if ($('input[name="featured"]').prop('checked')) {
        featured = 1;
      }


      // Append the productID to the formData
      formData.append('pname', pname);
      formData.append('pTitle', pTitle);
      formData.append('pDescription', pDescription);
      formData.append('pCategory', pCategory);
      formData.append('pBrand', pBrand);
      formData.append('qtyStock', qtyStock);
      formData.append('purchasePrice', purchasePrice);
      formData.append('salesPrice', salesPrice);
      formData.append('weight', weight);
      formData.append('discoutPercentage', discoutPercentage);
      formData.append('link', link);
      formData.append('linkName', linkName);
      formData.append('featured', featured);
      formData.append('rating', rating);
      formData.append('totalstar', totalstar);
      formData.append('PostId', PostId);
      

      // Send the form data to the PHP server
      $.ajax({
        url: '../../pages/phpProces/uploadMimages.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          alert(response);
          if(response > 0 ){
            // Redirect to another page
            window.location.href = '../../pages/admin/productdetails.php?productID='+response;
            // Prevent further code execution
            return;
          } 
          // Handle the server response
        },
        error: function(error) {
          alert('Error: ' + error); // Handle any errors
        }
      });
    }
  
    // After all form steps are completed, call the uploadFiles function
    $("#submit").click(function() {
      uploadFiles();
    });

    

    //validation//

    var pname = false;
    var pdiscription = false;
    var ptitle = false;
    checkCondition2();

    function checkCondition2(){
      if ($('#pname').val() != '') { pname = true; }
      if ($('#pTitle').val() != '') { ptitle = true; }
      if ($('#pDescription').val() != '') { pdiscription = true; }
      checkCondition();
    }

    function checkCondition(){
      var step1btn = $('.step1-next-btn');
      if(pname == true && pdiscription == true && ptitle == true){
        if (step1btn.hasClass('step1-btn-disable')) {
          step1btn.removeClass('step1-btn-disable');
          
        }
      }else{
        if (!step1btn.hasClass('step1-btn-disable')) {
          step1btn.addClass('step1-btn-disable');
        }
      }
    }

    $("#pname").keyup(function(){
      var inputText = $(this).val();
      var charCount = inputText.length;
      if(charCount >= 16){
        var first15Chars = inputText.substring(0, 15);
        $(this).val(first15Chars);
        alert("only 15 characher alowed!!!");
        return;
      }
      if(charCount <= 15 && charCount > 0){
        pname = true;
        checkCondition();
        $('.pnameValid').css('display', 'block');
        $('.pnameInvalid').css('display', 'none');
      }else{
        pname = false;
        checkCondition();
        $('.pnameInvalid').css('display', 'block');
        $('.pnameValid').css('display', 'none');

      }
    });
    $("#pTitle").keyup(function(){
      var inputText = $(this).val();
      var charCount = inputText.length;
      if(charCount >= 200){
        var first15Chars = inputText.substring(0, 200);
        $(this).val(first15Chars);
        alert("only 15 characher alowed!!!");
        return;
      }
      if(charCount <= 200 && charCount > 0){
        ptitle = true;
        checkCondition();
        $('.pTitleValid').css('display', 'block');
        $('.pTitleInvalid').css('display', 'none');
      }else{
        ptitle = false;
        checkCondition();
        $('.pTitleInvalid').css('display', 'block');
        $('.pTitleValid').css('display', 'none');

      }
    });
    $("#pDescription").keyup(function(){
      var inputText = $(this).val();
      var charCount = inputText.length;
      if(charCount >= 1000){
        var first15Chars = inputText.substring(0, 1000);
        $(this).val(first15Chars);
        alert("only 1000 characher alowed!!!");
        return;
      }
      if(charCount <= 1000 && charCount > 0){
        pdiscription = true;
        checkCondition();
        $('.pDescriptionValid').css('display', 'block');
        $('.pDescriptionInvalid').css('display', 'none');
      }else{
        pdiscription = false;
        checkCondition();
        $('.pDescriptionInvalid').css('display', 'block');
        $('.pDescriptionValid').css('display', 'none');

      }
    });







// Hide submenus
$('#body-row .collapse').collapse('hide'); 

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left'); 

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    
    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }
    
    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}

$(".custom-file-input").change(function (event) {
    var tmpPath = URL.createObjectURL(event.target.files[0]);
    $(".imagepreview").fadeIn("slow").attr('src', URL.createObjectURL(event.target.files[0]));
    var fileName = $(this).val().split("\\").pop();
    $(this).next('.custom-file-label').html(fileName);
});

function showdiv() {
    document.getElementById("errorDiv").style.display = "none";
}




const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");
let formStepsNum = 0;
nextBtns.forEach(btn =>{
  btn.addEventListener("click",()=>{
    formStepsNum++;
    updateFormSteps();
    updateProgressbar();
  });
});



prevBtns.forEach(btn =>{
  btn.addEventListener("click",()=>{
    formStepsNum--;
    updateFormSteps();
    updateProgressbar();
  });
});




function updateFormSteps(){
  formSteps.forEach(formStep =>{
    formStep.classList.contains("form-step-active") &&
    formStep.classList.remove("form-step-active");
  })

  formSteps[formStepsNum].classList.add("form-step-active");
}



function updateProgressbar(){
  progressSteps.forEach((progressStep, idx) => {
    if(idx < formStepsNum + 1){
      progressStep.classList.add('progress-step-active');
    }else{
      progressStep.classList.remove('progress-step-active');
    }
  });

  const progressActive = document.querySelectorAll(".progress-step-active");
  
  progress.style.width = ((progressActive.length - 1) / (progressSteps.length - 1 )) * 100 + "%";
}








//featured checkbox\\

$('.featured-check').change(function() {
  var productID = $(this).data("productid");
  var featured;
  if ($(this).is(':checked')) {
    // Checkbox is checked
    featured = 1;
  } else {
    // Checkbox is unchecked
    featured = 0;
  }

  var formData = new FormData();
  formData.append("featured",featured);
  formData.append("productID",productID);
  // Send the data to the PHP server
  $.ajax({
    url: '../../pages/phpProces/updatefeatured.php',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      if(response >= 0 ){
        // change the value of the featured count
        $("#featured-count").html(response);
        // Prevent further code execution
        return;
      } 
      // Handle the server response
      alert(response);
    },
    error: function(error) {
      alert('Error: ' + error); // Handle any errors
    }
  });


});



//featured post checkbox\\

$('.featured-check-post').change(function() {
  var postid = $(this).data("postid");
  var featured;
  if ($(this).is(':checked')) {
    // Checkbox is checked
    featured = 1;
  } else {
    // Checkbox is unchecked
    featured = 0;
  }

  var formData = new FormData();
  formData.append("featured",featured);
  formData.append("postid",postid);
  // Send the data to the PHP server
  $.ajax({
    url: '../phpProces/updatePostF.php',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      if(response >= 0 ){
        // change the value of the featured count
        $("#featured-count").html(response);
        // Prevent further code execution
        return;
      } 
      // Handle the server response
      alert(response);
    },
    error: function(error) {
      alert('Error: ' + error); // Handle any errors
    }
  });


});






$("#revSubBtn").click(function(event){
  event.preventDefault();
  var review = $("#comment-review-text").val();
  if(review == ""){
    alert("Please Enter Your review first.");
  }else
  {
    var rating = 0;
    $('.list-inline-item').each(function(index) {
      if($(this).find('i').hasClass('fa-star')){
        rating++;
      }
    });

      var productID = $("#productID").val();
      var userID = $("#userID").val();
      var ordersID = $("#ordersID").val();
      var formData = new FormData();
      formData.append('userID', userID);
      formData.append('productID', productID);
      formData.append('ordersID', ordersID);
      formData.append('review', review);
      formData.append('rating', rating);
   // Send the form data to the PHP server
     $.ajax({
      url: '../../pages/phpProces/addToRev.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        if(response >= 0 ){
          
          window.location.href = "../../pages/user/reviewSuccessMsg.php";
          return;
        }else{
          alert(response);
        }
        // Handle the server response
      },
      error: function(error) {
        alert('Error: ' + error); // Handle any errors
      }
    });
  }

});






$('.sr').mouseenter(function(event) {
  if (!selected) {
  var cindex = $('.sr').index(this);
    $('.list-inline-item').each(function(index) {
      if(index <= cindex){
        $(this).find('i').removeClass('fa-star-o');
        $(this).find('i').addClass('fa-star');
      }
    });
  }
}).mouseleave(function(event) {
  if (!selected) {
    var cindex = $('.sr').index(this);
    $('.list-inline-item').each(function(index) {
      if(index <= cindex){
        $(this).find('i').removeClass('fa-star');
        $(this).find('i').addClass('fa-star-o');
      }
    });
  }
}).click(function(event) {
  event.preventDefault();
  selected = true;
  $(this).off('mouseleave');

  var cindex = $('.sr').index(this);
    $('.list-inline-item').each(function(index) {
      if(index <= cindex){
        $(this).find('i').removeClass('fa-star-o');
        $(this).find('i').addClass('fa-star');
      }else{
        $(this).find('i').removeClass('fa-star');
        $(this).find('i').addClass('fa-star-o');
      }
  });
});




});