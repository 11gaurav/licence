<html>
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<style>

    #heading{
        font-size: 30px;
    }
    </style>
<body>
    <div class="container mt-5">
        <div >
            <span id="heading">Active Plan List</span>
            <a href="inactivePlanlist" class="btn btn-primary float-right">Inactive List</a>
        <hr>
        </div>
        <table data-toggle="table" style="font-size:16px">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Plan Name</th>
                    <th>Trans. Per Month</th>
                    <th>Trans. Per Year</th>
                    <th>Created By</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 0;
                   foreach ($getAllplan as $record) : ?>
                    <tr>
                        <?php $counter = $counter + 1; ?>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $record->name ?></td>
                        <td><?php echo number_format($record->trans_per_month) ?></td>
                        <td><?php echo number_format($record->trans_per_year) ?></td>
                        <td><?php echo $record->username ?></td>
                        <td><a href="makePlanInactive/<?php echo $record->id ?>" onclick="return confirm('Are uou sure you want inactive plan <?php echo $record->name ?>')" class="btn btn-primary active ml-3">Inactive</a> 
                        <a href="editplan/<?php echo $record->id ?>" class="btn btn-success">Edit</a> </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
</body>

</html>