<html>

<head>
    <link href="<?php echo base_url() ?>assets/css/view-license.css" rel="stylesheet" type="text/css">
</head>

<body>
    <br>
    <div class="container ">

        <table class="container-fluid table table-borderless box1" cell-padding>
            <tr>
                <th>ID</th>
                <td><?php echo $record[0]['id']; ?></td>
            </tr>
            <tr>
                <th>Company Name</th>
                <td><?php echo $record[0]['company_name']; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo $record[0]['address']; ?></td>
            </tr>
            <tr>
                <th>City Name</th>
                <td><?php echo $record[0]['city']; ?></td>
            </tr>
            <tr>
                <th>Contact Name</th>
                <td><?php echo $record[0]['contact_name']; ?></td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td><?php echo $record[0]['contact_number']; ?></td>
            </tr>
            <tr>
                <th>Start Date</th>
                <td><?php echo $record[0]['start_date']; ?></td>
            </tr>
            <tr>
                <th>End Date</td>
                <td><?php echo $record[0]['end_date']; ?></td>
            </tr>
            <tr>
                <th>License Key</td>
                <td style="display: flex;"><input id="license-key" value="<?php echo $record[0]['license_key']; ?>" disabled><a class="btn copy" data-clipboard-target="#license-key" id="copy-license-key" data-toggle="tooltip" data-placement="top" title="Copy to clipboard" >Copy</a></td>
            </tr>
            <tr>
                <th>Plan name</th>
                <td><?php echo $record[0]['plan_name']; ?></td>
            </tr>
            <tr>
                <th>Access user token</th>
                <td><?php echo $record[0]['user_access_token']; ?></td>
            </tr>
            <tr>
                <th>Access user password</th>
                <td ><?php echo $record[0]['user_access_ps']; ?></td>
            </tr>
            <tr>
                <th>Created By</th>
                <td><?php echo $record[0]['username']; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo $record[0]['status']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td style=" color:white"><a href="<?php echo base_url() ?>IlicenseList" class="btn btn-danger">Exit</a></td>
            </tr>
        </table>
    </div>
</body>
</html>
<script>
    $(document).ready(function() {

        $("#copy-license-key").on('click', function() {
            var copytext = document.createElement("textarea");
            copytext.value = $("#license-key").val();
            document.body.appendChild(copytext);
            copytext.select();
            document.execCommand('copy');
            document.body.removeChild(copytext);

            $("#copy-license-key").text('Copied');

        });
    });
</script>