<br>
<div class="row">
    <div class="col-md-12">

        <?php echo form_open(base_url() . 'technician/report/create/', array('class' => 'form-horizontal form-groups-bordered validate')); ?>

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Report Name</label>

            <div class="col-sm-5">
                <input type="text" id="name" class="form-control" name="name" data-validate="required"
                       data-message-required="Value required" value="" autofocus>
            </div>
        </div>

        <div class="form-group">
            <label for="patient_id" class="col-sm-3 control-label">Patient Name</label>
            <div class="col-sm-5">
                <select id="patient_id" class="form-control select2" name="patient_id" data-validate="required"
                        data-rule-required="true">
                    <option value="">Select Patient</option>
                    <?php
                    $patients = $this->crud_model->get_db('patient');
                    foreach ($patients as $row):
                        $patient_id = $row['patient_id'];
                        $patient_name = $row['name'];
                        ?>
                        <option value="<?= $patient_id ?>"><?= $patient_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-5">
                <textarea id="description" class="form-control" name="description" cols="20" rows="7"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                <button type="submit" class="btn btn-primary btn-lg">Add report</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>