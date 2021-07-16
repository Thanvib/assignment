<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Card</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- this file should add inside the <head></head> tag -->
<script src="{{URL::asset('datepicker/js/jquery.min.js')}}"></script>
</head>
<body> 


<div class="container">
  <h3>Reservation </h3>

      <div class="col-md-6">

  <div class="card">
    <div class="card-body">

  <form action="/action_page.php">


    <div class="form-group">
      <label for="email">User Id: </label>
      <input type="text" class="form-control userid" id="email" placeholder="Enter number" name="userid">
    </div>

   <div class="form-group">
     <label for="email">Date: </label>
    <input class="form-control date" id="datetimepicker" type="text" name="date">
    </div>


    <button type="submit" class="btn btn-primary postbutton">Submit</button>
  
  </form>

   <div class="writeinfo"></div> 
   
</div>
</div>
</div></div>

</body>
</html>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- those files should be add after the </body> tag -->
<link rel="stylesheet" type="text/css" href="{{URL::asset('datepicker/css/jquery.datetimepicker.min.css')}}"/>
<script src="{{URL::asset('datepicker/js/jquery.datetimepicker.js')}}"></script>

    <!-- provide the csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(".postbutton").click(function(e){

              e.preventDefault();

                let data = {};
                data._token = CSRF_TOKEN;
                data.userid = $(".userid").val();
                data.date = $(".date").val();

                $.ajax({
                    /* the route pointing to the post function */
                    url: '/reservationpostajax',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: data,
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 
                      if(data.is_booking_restricted){                       
                        $(".writeinfo").append('Added Successfully'); 
                      }
                      else{
                        $(".writeinfo").append('Something went wrong'); 
                      }
                    }
                }); 
            });
       });    
    </script>




<script type="text/javascript">
    $(document).ready(function() {
        $('#datetimepicker').datetimepicker();
    });
</script>