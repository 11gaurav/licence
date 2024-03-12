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
  <form style="margin-top: 50px;" action="changePasswordSave" method="post" id="userform">
  <h3 style="color: green;"><?php echo empty($success) ? "" :$success ?></h3>
  <h3 style="color: red;"><?php echo empty($failure) ? "" :$failure ?></h3>
  <div class="form-group">
      <label for="password">Old Password</label>
      <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder=" Enter Old   Password">
    </div>    
    <div class="form-group">
      <label for="password">New Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder=" Enter Password">
    </div>
    <div class="form-group">
      <label for="confirm_ps">Confirm Password</label>
      <input type="password" class="form-control" id="confirm_ps" name="confirm_ps" placeholder="Re-enter password">

    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<script>
  $(document).ready(function() {
   
    $("#userform").validate({
      rules: {
        oldpassword:{
            "required": true
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
        oldpassword:{
            "required": "Old Password is required"
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