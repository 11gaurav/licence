<html>

<head>
    <link href="<?php echo base_url() ?>assets/css/view-license.css" rel="stylesheet" type="text/css">
</head>

<body>
    <br>
    <div class="container ">

        <table class="container-fluid table table-borderless box1" cell-paddin>
            <tr>
                <td>ID</td>
                <td><?php echo $record[0]['id']; ?></td>
            </tr>
            <tr>
                <td>Company Name</td>
                <td><?php echo $record[0]['company_name']; ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $record[0]['address']; ?></td>
            </tr>
            <tr>
                <td>City Name</td>
                <td><?php echo $record[0]['city']; ?></td>
            </tr>
            <tr>
                <td>Contact Name</td>
                <td><?php echo $record[0]['contact_name']; ?></td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td><?php echo $record[0]['contact_number']; ?></td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td><?php echo $record[0]['start_date']; ?></td>
            </tr>
            <tr>
                <td>End Date</td>
                <td><?php echo $record[0]['end_date']; ?></td>
            </tr>
            <tr>
                <td>Created By</td>
                <td><?php echo $record[0]['username']; ?></td>
            </tr>
            <tr>
                <td>License Key</td>
                <td style="display: flex;"><input id="license-key" value="<?php echo $record[0]['license_key']; ?>" disabled><a class="btn copy" data-clipboard-target="#license-key" id="copy-license-key">Copy</a></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?php echo $record[0]['status']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td style=" color:white"><a href="<?php echo base_url() ?>admin/dashboard" class="btn btn-danger">Exit</a></td>

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