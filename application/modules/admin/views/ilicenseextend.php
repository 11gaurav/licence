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
        <a href="sevenDayExtend"><button type="button" class="btn btn-success">Yes</button> </a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

      </div>
    </div>

  </div>
</div>

<div class="container">
  <br>
  <table data-toggle="table" style="font-size:16px">
    <thead>
      <tr>
        <th>S.no</th>
        <th>License Id</th>
        <th>Company Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Extend Date</th>
        <th id="ex_key">Extended Key</th>
        <th>Copy</th>
        <th>Created By</th>
      </tr>
    </thead>
    <tbody>
      <?php $counter = 0;
      foreach ($getAllExtenddata as $record) : ?>

        <?php $counter = $counter + 1; ?>
        <tr>
          <td><?php echo $counter ?></td>
          <td><?php echo $record->linces_id ?></td>
          <td><?php echo $record->company_name ?></td>
          <td><?php echo $record->start_date ?></td>
          <td><?php echo $record->end_date ?></td>
          <td><?php echo $record->extend_date ?></td>
          <td><input id="license-key-<?php echo $counter ?>" value="<?php echo $record->extend_license_key ?>" disabled></td>
          <td><a class="btn copy" data-clipboard-target="#license-key-<?php echo $counter ?>" onclick="copyKey(<?php echo $counter ?>)" id="copy-license-key-<?php echo $counter ?>">Copy</a> </td>
          <td><?php echo $record->username ?></td>
        </tr>
      <?php endforeach ?>

    </tbody>
  </table>
</div>
<script>
      function copyKey(id){
            var copytext = document.createElement("textarea");
            copytext.value = $(`#license-key-${id}`).val();
            document.body.appendChild(copytext);
            copytext.select();
            document.execCommand('copy');
            document.body.removeChild(copytext);

            $(`#copy-license-key-${id}`).text('Copied');
      }



</script>