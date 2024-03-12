<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <a href="<?php echo base_url('admin/species/list_species') ?>" class="btn btn-sm btn-primary">
                    <i class="fa fa-list"></i>&nbsp;Back
                </a>
            </div>
            <h4 class="page-title"><strong><?php echo empty($form_caption) ? "" : $form_caption; ?></strong></h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
                    $validation_errors = validation_errors();
                    if (!empty($validation_errors))
                    {
                        ?>
                        <div class="col-xs-12 alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">
                                &times;
                            </button>
                            <?php echo $validation_errors; ?>
                        </div>
                        <?php
                    }
                ?>

                <?php
                    $attributes = array('id' => 'species-form', 'class' => 'form-horizontal');
                    echo form_open_multipart($form_action, $attributes);
                ?>   
                <input type="hidden" name="species_id" id="species_id" value="<?php echo empty($species_id) ? NULL : $species_id; ?>">

                <div class="form-group row">                        
                    <label class="col-md-3 col-form-label" for="species_name">Species Name<font color="red">*</font></label>
                    <div class="col-md-6">
                        <?php
                            $data = array(
                                'name' => 'species_name',
                                'id' => 'species_name',
                                'value' => set_value('species_name', empty($species_name) ? NULL : $species_name),
                                'class' => 'form-control',
                                'placeholder' => 'Enter Species Name',
                                'autofocus' => 'autofocus',
                            );
                            echo form_input($data);
                        ?>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-9 offset-sm-3">
                        <button type="submit" name="save"  id="button" class="btn btn-primary mr-2"> <i class="fa fa-save" aria-hidden="true"></i> Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div><!-- end col -->
</div>
<!-- end row -->

<script>
    $(document).ready(function () {

        $("#species-form").validate({
            rules: {
                species_name: {"required": true},
            },
            messages: {
                species_name: {"required": "Enter Species Name"},
            }
        });

    });
</script>
