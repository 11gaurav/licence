 <html>


 <body>
     <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
     <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
     <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>

     <div class="modal fade" id="mymodal" role="dialog">

         <div class="modal-dialog">

             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title">I-lincese Modal</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>

                 </div>
                 <div class="modal-body">
                     <p>Are You Sure Extends License For Seven Day</p>
                 </div>
                 <div class="modal-footer">
                     <a href="javascript:;"><button type="button" class="btn btn-success" onclick="extendsLicense()">Yes</button> </a>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                 </div>
             </div>

         </div>
     </div>
<br>
     <div class="container">
         <table data-toggle="table" style="font-size:16px">
             <thead>
                 <tr>
                     <th>S.no</th>
                     <th>Company Name</th>
                     <th>Contact Number</th>
                     <th>Start Date</th>
                     <th>End Date</th>
                     <th>Plan</th>
                     <th>Created By</th>
                     <th>Status</th>
                     <th colspan="3" style="text-align: center;">Action</th>
                 </tr>
             </thead>
             <tbody>
                 <?php $counter = 0;
                    foreach ($getAllLicensesData as $record) : ?>
                     <tr>
                         <?php $counter = $counter + 1; ?>
                         <td><?php echo $counter ?></td>
                         <td><?php echo $record->company_name ?></td>
                         <td><?php echo $record->contact_number ?></td>
                         <td><?php echo $record->start_date ?></td>
                         <td><?php echo $record->end_date ?></td>
                         <td><?php echo $record->plan_name ?></td>
                         <td><?php echo $record->username ?></td>
                         <td><?php echo $record->status ?></td>
                         <input type="hidden" name="endDate" id="endDate_<?php echo $record->id ?>" value="<?php echo $record->end_date ?>">
                         <?php if ($record->status == 'Active') { ?>
                             <td><a href="javascript:;" onclick="confirm(<?php echo $record->id ?>)" class="btn btn-info">Extend</a></td>
                         <?php } else { ?>
                             <td style="text-align: center;">---</td>
                         <?php } ?>

                         <td><a href="extendLicenseView/<?php echo $record->id ?>" class="btn btn-primary active">View</a> </td>
                         <td><a href="editExtendlicense/<?php echo $record->id ?>" class="btn btn-success">Edit</a> </td>
                     </tr>
                 <?php endforeach ?>
             </tbody>


 </body>

 </html>
 <script>
     var selectedId = "";

     function confirm(id) {
         selectedId = id;
         $('#mymodal').modal('show');
     }

     function extendsLicense() {
         var linces_id = selectedId;
         var extentDate = $('#endDate_' + linces_id).val();
         $.ajax({
             url: 'extendsLicense',
             method: 'post',
             data: {
                 linces_id: linces_id,
                 extentDate: extentDate
             },
             success: function(data) {
                 if (data == 'success') {
                     window.location.href = "sevenDayExtend";
                 } else {
                     alert(data);
                 }

             }

         })
     }
 </script>