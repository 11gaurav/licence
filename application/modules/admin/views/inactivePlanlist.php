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
            <span id="heading">Inactive Plan List</span>
            <a href="activePlanlist" class="btn btn-primary float-right">Active List</a>
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
                    <th style="text-align: center;">Inactive By</th>
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
                        <td><?php echo $record->updated_user ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
</body>

</html>