<style>
  body {
    background-color: #f7f7f7;
  }

  form {
    width: 70%;
    background-color: white;
    padding: 2.25rem !important;
    color: black;
  }

  label {
    font-weight: 500;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/@fengyuanchen/datepicker@0.6.5/dist/datepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@fengyuanchen/datepicker@0.6.5/dist/datepicker.min.css" rel="stylesheet">
<div class="container">
  <form style="margin-top: 50px;" action="saveLicense" method="post" id="ilicneseform">
    <div class="form-group">
      <h2>Add a license</h2>
      <hr>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Company Name</label>
      <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name">

    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Address</label>
      <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">City</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="Enter City Name">

    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Contact Name</label>
      <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder=" Enter Contact Name">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Contact Number</label>
      <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number">

    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Start Date</label>
      <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Enter Start Date" data-toggle="datepicker">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">End data</label>
      <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Enter End Date" data-toggle="datepicker">
    </div>
    <div class="form-group">
      <label for="select_plan">Plan</label>

      <select name="plan_id" class="browser-default custom-select">
      <option selected> Select plan</option>
      <?php
        foreach ($plan_name as $name) {
        ?>
          <option value="<?php echo $name->id; ?>"><?php echo $name->name; ?> </option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="user_access_token">User access token</label>
      <input type="text" class="form-control" id="user_access_token" name="user_access_token" placeholder="Enter user access token">
    </div>
    <div class="form-group">
      <label for="user_access_password">User access password</label>
      <input type="text" class="form-control" id="user_access_password" name="user_access_password" placeholder="Enter user access password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<script>
  $(document).ready(function() {

    $("#ilicneseform").validate({
      rules: {
        company_name: {
          "required": true
        },
        address: {
          "required": true
        },
        city: {
          "required": true
        },
        contact_name: {
          "required": true
        },
        contact_number: {
          "required": true
        },
        start_date: {
          "required": true
        },
        end_date: {
          "required": true
        },
      },
      messages: {
        company_name: {
          "required": "Enter Company Name"
        },
        address: {
          "required": "Enter Address "
        },
        city: {
          "required": "Enter City"
        },
        contact_name: {
          "required": "Enter Contact Name "
        },
        contact_number: {
          "required": "Enter Contact Number"
        },
        start_date: {
          "required": "Enter Start Date "
        },
        end_date: {
          "required": "Enter End Date "
        },
      }
    });

  });
  $(function() {
    $('[data-toggle="datepicker"]').datepicker({
      autoHide: true,
      zIndex: 2048,
      format: 'yyyy-mm-dd',
      startDate: moment(),
    });
  });
</script>