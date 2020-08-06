
 <!-- Datatable Start -->

 <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        
        @foreach ($users as $user)

            <tr>
                <td>{{$user->getAttributes()['id']}}</td>
                <td>{{$user->getAttributes()['name']}}</td>
                <td>{{$user->getAttributes()['email']}}</td>
                <td>{{$user->getAttributes()['phone']}}</td>
                <td>{{$user->getAttributes()['city']}}</td>
                <td>
                    <button type="button" class="btn btn-default" onclick="editUser('<?= $user->getAttributes()['id'] ?>', '<?= $user->getAttributes()['name'] ?>', '<?= $user->getAttributes()['email'] ?>', '<?= $user->getAttributes()['phone'] ?>', '<?= $user->getAttributes()['city'] ?>')">Edit</button>
                    <button type="button" class="btn btn-default" onclick="deleteUser('<?= $user->getAttributes()['id'] ?>', '<?= $user->getAttributes()['name'] ?>')">Delete</button>
                </td>
            </tr>
        @endforeach

        </tbody>
        <tfoot>
            <tr>
            <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>


        <!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
    <form id="edituser">
        <input type="hidden" name="id" id="id" value="">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="ename" name="ename">
        </div>

        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="email" class="form-control" id="eemail" name="eemail">
        </div>

        <div class="form-group">
          <label for="phone">Phone address:</label>
          <input type="number" class="form-control" id="ephone" name="ephone">
        </div>

        <div class="form-group">
          <label for="city">City:</label>
          <input type="text" class="form-control" id="ecity" name="ecity">
        </div>  

        <div class="form-group">
          <button type="button" id="edituser-button" class="btn btn-primary">Submit</button>
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
<!-- Delete Model -->

 <!-- Modal -->
 <div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete User</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
    <form id="deleteuser">
      
        <div class="form-group">
          <label for="name">Are you sure you want to delete this user?:</label>
          <span name="dname" id="dname"></span>
          <input type="hidden" name="did" id="did" value="">
        </div>


        <div class="form-group">
          <button type="button" id="delete-button" class="btn btn-primary">Delete</button>
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




      <!-- Datatable End -->

      <script type="text/javascript">    
        $('#example').DataTable();

        $('#edituser-button').on('click', function(){

            // show that something is loading
            $('#response').html("<b>Loading response...</b>");

            // Call ajax for pass data to other place
            $.ajax({
            type: 'POST',
            url: 'edit-user',
            data: $("#edituser").serialize(),
            success: function(data){
            loadlist();
            $("#edituser")[0].reset();
            $('#myModal2').trigger('click');
            } 
            })

            .fail(function() { // if fail then getting message

            // just in case posting your form failed
            alert( "Posting failed field left empty." );

            });

            // to prevent refreshing the whole page page
            return false;

        });

        $('#delete-button').on('click', function(){

            // show that something is loading
            $('#response').html("<b>Loading response...</b>");

            // Call ajax for pass data to other place
            $.ajax({
            type: 'delete',
            url: 'delete-user',
            data: $("#deleteuser").serialize(),
            success: function(data){
                loadlist();
                $("#deleteuser")[0].reset();
                $('#myModal3').trigger('click');
            } 
            })

            .fail(function() { // if fail then getting message

            // just in case posting your form failed
            alert( "Posting failed." );

            });

            // to prevent refreshing the whole page page
            return false;

        });

        function editUser(id, name, email, phone, city){

            $('#id').val(id);
            $('#ename').val(name);
            $('#eemail').val(email);
            $('#ephone').val(phone);
            $('#ecity').val(city);
            $('#myModal2').modal('show');
       }

       function deleteUser(id, name){
            $('#did').val(id);
            $('#dname').text(name);
            $('#myModal3').modal('show');
        }

      </script>
