<style>
  label {
    font-weight: 500;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/@fengyuanchen/datepicker@0.6.5/dist/datepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@fengyuanchen/datepicker@0.6.5/dist/datepicker.min.css" rel="stylesheet">

<form style="margin-top: 50px;" action="<?php echo base_url() ?>updateExtendlicense" method="post" id="ilicneseform">
  <div class="form-group">
    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $record[0]['id']; ?>">
    <label for="exampleInputEmail1">Company Name</label>
    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $record[0]['company_name']; ?>" placeholder="Enter Company Name">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Address</label>
    <input type="text" class="form-control" id="address" name="address" value="<?php echo $record[0]['address']; ?>" placeholder="Enter Address">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">City</label>
    <input type="text" class="form-control" id="city" name="city" value="<?php echo $record[0]['city']; ?>" placeholder="Enter City Name">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contact Name</label>
    <input type="text" class="form-control" id="contact_name" name="contact_name" value="<?php echo $record[0]['contact_name']; ?>" placeholder=" Enter Contact Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Contact Number</label>
    <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $record[0]['contact_number']; ?>" placeholder="Enter Contact Number">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Start Date</label>
    <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $record[0]['start_date']; ?>" placeholder="Enter Start Date" data-toggle="datepicker">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">End data</label>
    <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $record[0]['end_date']; ?>" placeholder="Enter End Date" data-toggle="datepicker">
  </div>
  <div class="form-group">
    <label for="plan_name">Plan name</label>
    <select name="plan_id" class="browser-default custom-select">
      <option selected> Select plan</option>
      <?php
      
        foreach ($plan_name as $name) {
        ?>
          <option value="<?php echo $name->id; ?>" <?php if($name->id == $record[0]['plan_id']){ echo "selected"; } ?> ><?php echo $name->name; ?> </option>
        <?php
        }
        ?>
      </select>
  </div>
  <div class="form-group">
    <label for="user_access_token">User access token</label>
    <input type="text" class="form-control" id="user_access_token" name="user_access_token" value="<?php echo $record[0]['user_access_token']; ?>" placeholder="user access  password" >
  </div>
  <div class="form-group">
    <label for="user_access_password">User access password</label>
    <input type="text" class="form-control" id="user_access_password" name="user_access_password" value="<?php echo $record[0]['user_access_ps']; ?>" placeholder="user access password" >

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Status</label>
    <select name="status" class="form-control">
      <option <?php echo ($record[0]['status'] == "Active") ? "selected" : ""; ?>>Active</option>
      <option <?php echo ($record[0]['status'] == "Inactive") ? "selected" : ""; ?>>Inactive</option>

    </select>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
  <a href="<?php echo base_url() ?>IlicenseList" class="btn btn-danger">Back</a>
</form>
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