 $(document).ready(function() {
        $("#name").hide();
        $("#getConform").hide();

        // Get value on button click and show alert
        $("#getConnect").click(function() {

            var connectID = $("#connect").val();
            $.ajax({
                type: 'POST',
                url: 'connect',
                data: jQuery.param({
                    action: "verify",
                    connectID: connectID
                }),
                success: function(content) {
               
                    if (content !== undefined && content.length > 0) {
                        var json = $.parseJSON(content);

                        var name = json.user_first_name + ' ' + json.user_last_name;
                        $('#name').val(name);
                        $("#getConnect").css("display", "none");
                        $("#name").show();
                        $("#getConform").show();

                    } else {
                        alert("No Connect Found !!");

                    }
                }
            });
        });


        $("#getConform").click(function() {

            var connectID = $("#connect").val();
            var userID = $("#user").val();

            $.ajax({
                type: 'POST',
                url: 'connect',
                data: jQuery.param({
                    action: "conform",
                    connectID: connectID,
                    user: userID
                }),
                success: function(content) {

                    if (content == 1) {
                        alert(" Connect Changed Successfully !! ");
                    } else {
                        alert("Please Check Your ID");
                    }

                }
            });
        });
    });