


jQuery('.dropdown-item').click(function () {
    var location = jQuery(this).attr('href');
    window.location.href = location;
    return false;
});

// $(document).ready(function () {

$(document).ready(function () {

    // $(".upl-btn").click(function(){

    $("#but_upload").on("click", function (e) {

        console.log("entered function");

        var fd = new FormData();
        var files = $('#file')[0].files;
        
        var course = $(".course").val();
      //   console.log(course);

      
        
        // Check file selected or not
        if(files.length > 0 ){
           fd.append('file',files[0]);
           fd.append('text', $( "#course option:selected" ).text());

           $.ajax({
              url: 'upload.php',
              type: 'post',
              data: fd,
            //   data:{fd,course},
              contentType: false,
              processData: false,
              success: function(response){

               console.log(response);
                 if(response != 0){
                    $("#imgFile").attr("src",response); 
                    $(".preview img").show(); // Display image element
                    $(".message").text("Image added successfully");
                  //   console.log("Image added successfully");
                 }else{
                  console.log(response);

                    alert('file not uploaded');
                 }
              },
           });
        }else{
           alert("Please select a file.");
        }

      
    });

    $("#avatar").on('click', function () {
        $("#file").click();
    });



});

// });


