<style>
  label {
    font-weight: 500;
  }

  body {
    background-color: #f7f7f7;
  }

  form {
    width: 70%;
    background-color: white;
    padding: 2.25rem !important;
    color: black;
  }
</style>
<div class="container">
  <form style="margin-top: 50px;" action="<?php echo $form_action ?>" method="post" id="userform">
    <div class="form-group">
      <label for="user_name">Name</label>
      <input type="hidden" class="form-control" id="admin_id" name="admin_id" value="<?php echo empty($admin_id)?"":$admin_id ?>"  >
      <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo empty($user_name)?"":$user_name ?>"  placeholder="Enter User Name">

    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username" value="<?php echo empty($username)?"":$username ?>" placeholder="Enter Username">
    </div>
    <div class="form-group">
      <label for="user_email">Email</label>
      <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo empty($user_email)?"":$user_email ?>" placeholder="Enter Email">

    </div>
    <?php
    if(empty($admin_id)?" ":$admin_id == " ")
    { 
    ?>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder=" Enter Password">
    </div>
    <div class="form-group">
      <label for="confirm_ps">Confirm Password</label>
      <input type="password" class="form-control" id="confirm_ps" name="confirm_ps" placeholder="Re-enter password">

    </div>
<?php
    } 
?>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<script>
  $(document).ready(function() {
   
    $("#userform").validate({
      rules: {
        user_name: {
          "required": true
        },
        username: {
          "required": true
        },
        user_email: {
          "required": true,
          'email': true
        },
        password: {
          "required": true
        },
        confirm_ps: {
          "required": true,
          "equalTo":'#password'

        },
      },
      messages: {
        user_name: {
          "required": "User name is required"
        },
        username: {
          "required": "Username is required"
        },
        user_email: {
          "required": "Email is required",
          "email": "please enter a valid email"
        },
        password: {
          "required": "Password is required"
        },
        confirm_ps: {
          "required": "confirm password is required",
          "equalTo":"pasword not match"
        },

      }
    });

  });
</script>