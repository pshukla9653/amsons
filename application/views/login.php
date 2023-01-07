<html>
    <head>
        <title>Codeigniter AJAX form Submission Demo</title>
    </head>
    <body> 
	<div id="message"></div>
	<form name="log" enctype='application/json'>
  First name:<br>
  <input type="text" name="email" id="email"  value="Mickey">
  <br>
  Last name:<br>
  <input type="text" name="lastname" value="Mouse">
  <br><br>
  <input id="submit" type="submit" value="Submit">
</form>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <script type="text/javascript">
        $("#submit").click(function(e) {
            e.preventDefault();
            var email_id = $("email").val();
            $.ajax({
                url: "<?php echo site_url('login/submit'); ?>",
                method: "POST",
                data: {email:  $('#email').val()},
                success: function(data) {
                    $("#message").html(data);
                },
                error: function() {
                    alert("Please enter valid email id!");
                }
            });
        });
        </script>

    </body>
</html>