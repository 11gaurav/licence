<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
    
  <div class="container">
  <br> 
  <table data-toggle="table" style="font-size:16px">
        <thead>
          <tr>
                <th>S.no</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>User type</th>
                <th>Status</th>
                <th>Action</th>
          </tr>
        </thead>
        <tbody>
         <?php $counter = 0;
            foreach ($user_list as $record) : ?>
                <tr>
                    <?php $counter = $counter + 1 ?>
                    <td><?php echo $counter ?></td>
                    <td><?php echo $record->name ?></td>
                    <td><?php echo $record->username ?></td>
                    <td><?php echo $record->email ?></td>
                    <td><?php echo $record->user_type ?></td> 
                    <td><?php echo $record->status ?></td>      
                    <td>
                    <?php
                    if($record->status == 'Active')
                    { 
                    ?>  
                    <a href="makeUserInactive/<?php echo $record->admin_id ?>" onclick="return confirm('Are you sure you want Inactive User <?php echo $record->name ?>')" class="btn btn-info  ml-2">Inactive</a> 
                    <?php
                    }
                    else{
                      ?>
                       <a href="makeUserActive/<?php echo $record->admin_id ?>" onclick="return confirm('Are you sure you want Active User <?php echo $record->name ?>')" class="btn btn-info  ml-2 " style="    padding-inline: 19px;" >Active</a> 
                      <?php 

                    }
                    ?> 
                    <a href="deleteUser/<?php echo $record->admin_id ?>" onclick="return confirm('Are you sure you want delete User <?php echo $record->name ?>')" class="btn btn-primary active ">Delete</a> 
                        <a href="editUser/<?php echo $record->admin_id ?>" class="btn btn-success">Edit</a> </td>
                </tr>
            <?php endforeach ?>
        
        </tbody>
      </table>
  
   </div>