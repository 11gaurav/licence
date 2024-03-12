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

    #form_heading {
        font-size: 28px;
    }
</style>
<div class="container">
    <form style="margin-top: 50px;" action="<?php echo empty($row[0]['id']) ? base_url() . "saveplan" : base_url() . "updateplan/" . $row[0]['id']  ?>" method="post" id="planform">
        <div class="form-group">
            <label id="form_heading">Add a Plan</label>
        </div>
        <div class="form-group">
            <label for="plan_name">Plan Name</label>
            <input type="text" class="form-control" id="plan_name" name="plan_name" value="<?php echo empty($row[0]['name']) ? "" : $row[0]['name'] ?>" placeholder="Enter Name">
        </div>
        <div class="form-group">
            <label for="trans_per_month">Transaction per month</label>
            <input type="text" class="form-control" id="trans_per_month" name="trans_per_month" value="<?php echo empty($row[0]['trans_per_month']) ? "" : $row[0]['trans_per_month'] ?>" placeholder="Transaction per month">
        </div>
        <div class="form-group">
            <label for="trans_per_year">Transaction per year</label>
            <input type="text" class="form-control" id="trans_per_year" name="trans_per_year" value="<?php echo empty($row[0]['trans_per_year']) ? "" : $row[0]['trans_per_year'] ?>" placeholder="Transaction per year">
        </div>
        <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        var message;
        $("#planform").validate({
            rules: {
                plan_name: {
                    "required": true,
                    "remote": {
                        url: "<?php echo base_url('check-plan-exist') ?>",
                        type: "post",
                        data: {
                            plan_name: function() {
                                return $("#plan_name").val();
                            }
                        },
                        dataFilter: function(response) {
                            if (response == "exist") return false;
                            else {
                                message = "Plan name already exist";
                                return true;
                            }
                        }
                    }
                },
                trans_per_month: {
                    "required": true,
                    "number": true
                },
                trans_per_year: {
                    "required": true,
                    "number": true
                },
            },
            messages: {
                plan_name: {
                    "required": "Please enter a plan name",
                    "remote": function() {
                        return message
                    }
                },
                trans_per_month: {
                    "required": "Please enter transaction per month",
                    "number": "alphabetic character is not allowed"
                },
                trans_per_year: {
                    "required": "Please enter transaction per year ",
                    "number": "alphabetic character is not allowed"
                },

            }

        });
        $("#trans_per_month,#trans_per_year").keypress(function(e) {
            var char_code = e.keycode || e.which;
            var rex = /^[0-9]/;
            var isValid = rex.test(String.fromCharCode(char_code));
            return isValid;
        });
        $('#trans_per_month,#trans_per_year,#plan_name').bind("cut copy paste", function(e) {
            e.preventDefault();
        });

    });
</script>