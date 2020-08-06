@include('default.header');

@include('default.nav');
  
<div class="container-fluid text-center">    
  <div class="row content">
    <!-- <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div> -->

    <div class="col-sm-12 text-left"> 
      <h1>Welcome</h1>
      <p>Test CRUD Operation Ajax</p>
      <hr>
      <div class="col-sm-12 " align="right" style="margin-bottom: 20px;">
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add User</button>
      </div>
      
      <div class="col-md-12" style="padding: 100px; background-color: indianred;" id="load_data">


     
      </div>

      
    </div>
    <!-- <div class="col-sm-2 sidenav">
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div> -->
  </div>
</div>

@include('default.footer');

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New User</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
    <form id="adduser" name ="adduser">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" required="">
        </div>

        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="form-group">
          <label for="phone">Phone address:</label>
          <input type="number" class="form-control" id="phone" name="phone">
        </div>

        <div class="form-group">
          <label for="city">City:</label>
          <input type="text" class="form-control" id="city" name="city">
        </div>  

        <div class="form-group">
          <button type="button" id="adduser-button" class="btn btn-primary">Submit</button>
        </div>  
    </form>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id='response'></div>

<script type="text/javascript">

$(document).ready(function() {
  
    // At page load load list
    loadlist();

    // On Add User
    $('#adduser-button').on('click', function(){

        // show that something is loading
        $('#response').html("<b>Loading response...</b>");

        // Call ajax for pass data to other place
        $.ajax({
        type: 'POST',
        url: 'add-user',
        data: $("#adduser").serialize(),
        success: function(data){
          loadlist();
          $("#adduser")[0].reset();
          $('#myModal').trigger('click');
        } 
        })

        .fail(function() { // if fail then getting message

        // just in case posting your form failed
        alert( "Posting failed field left empty." );

        });

        // to prevent refreshing the whole page page
        return false;

    });

});

function loadlist(){
    $.get('{{url('/')}}/loadListAll').done(function (data) {
            $('#load_data').html(data);
    });
}


</script>

