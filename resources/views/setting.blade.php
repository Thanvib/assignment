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
</head>
<body> 


<div class="container">
  <h3>Reservation Settings</h3>

   


      <div class="col-md-6">

  <div class="card">
    <div class="card-body">

  <form>


    <div class="form-group">
      <label for="email">Numbers: </label>
      <input type="number" class="form-control number" placeholder="Enter number" name="number">
    </div>
    <div class="form-group">
      <label for="sel1">Groups:</label>
      <select class="form-control group" name="group">

         @foreach($g as $key=> $val)
        <option value=" {{$key}} "> {{$val}} </option>
         @endforeach
      </select>
    </div>
   <div class="form-group">
      <label for="sel1">Day:</label>
      <select class="form-control day" name="day">
         @foreach($d as $key=> $val)
        <option value=" {{$key}} "> {{$val}} </option>
         @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="sel1">Time Zone:</label>
      <select class="form-control tz" name="tz">
         @foreach($tz as $key=> $val)
        <option value=" {{$key}} "> {{$val}} </option>
         @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary postbutton">Submit</button>
  
  

  </form>

  <div class="writeinfo"></div> 

</div>
</div>
</div></div>


<!-- <script>
  $(document).on("click", ".setting_submit", function () {
    var settingId = $(this).val('settingid');

    alert(settingId);

    $.ajax({
      url: base_url+'SettingController/setting_submit',
      type: 'post',
      setting_id: settingId,

      success: function(response) {

        if(response.status == 'success') 
        {
          //reload datatable after update
          //gameDataTable.ajax.reload();
        }

        //alert(response.message);
      },

    });
  });
</script> -->

<!-- load jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- provide the csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(".postbutton").click(function(e){

              e.preventDefault();

                let data = {};
                data._token = CSRF_TOKEN;
                data.number = $(".number").val();
                data.day = $(".day").val();
                data.group = $(".group").val();
                data.tz = $(".tz").val();

                $.ajax({
                    /* the route pointing to the post function */
                    url: '/postajax',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: data,
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 
                      $(".writeinfo").empty();
                       $(".writeinfo").append(data.msg); 
                    }
                }); 
            });
       });    
    </script>

</body>
</html>
