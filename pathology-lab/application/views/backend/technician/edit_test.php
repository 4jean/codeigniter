<br>
<div class="row">
    <div class="col-md-12">

        <?php echo form_open(base_url() . 'technician/test/update/'.$test_id, array('class' => 'form-horizontal form-groups-bordered validate')); ?>

        <?php
        $data['test_id'] = $test_id;
        $test = $this->crud_model->get_db('test', $data);
        foreach ($test as $row2):
        ?>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Test Name</label>

            <div class="col-sm-5">
                <input type="text" id="name" class="form-control" name="name" data-validate="required"
                       data-message-required="Value required" value="<?php echo $row2['name']; ?>" autofocus>
            </div>
        </div>


        <div class="form-group">
            <label for="report_id" class="col-sm-3 control-label">Report Name</label>
            <div class="col-sm-5">
                <select id="report_id" class="form-control select2" name="report_id" data-validate="required"
                        data-rule-required="true">
                    <option value="">Select Report</option>
                    <?php
                    $reports = $this->crud_model->get_db('report');
                    foreach ($reports as $row):
                        $report_id = $row['report_id'];
                        $report_name = $row['name'];
                        ?>
                        <option value="<?= $report_id ?>" <?php if($report_id == $row2['report_id']) echo 'selected' ?>><?= $report_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="patient_id" class="col-sm-3 control-label">Patient Name</label>
            <div class="col-sm-5">
                <select id="patient_id" class="form-control select2" name="patient_id" data-validate="required">
                    <option value="">Select Patient</option>
                    <?php
                    $patients = $this->crud_model->get_db('patient');
                    foreach ($patients as $row):
                        $patient_id = $row['patient_id'];
                        $patient_name = $row['name'];
                        ?>
                        <option value="<?= $patient_id; ?>" <?php if($patient_id == $row2['patient_id']) echo 'selected' ?>><?= $patient_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="comments" class="col-sm-3 control-label">Comments</label>
            <div class="col-sm-5">
                <textarea id="comments" class="form-control" name="comments" cols="20" rows="7"><?php echo $row2['comments']; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="test_result" class="col-sm-3 control-label">Test Result</label>

            <div class="col-sm-5">
                <input type="text" id="test_result" class="form-control" name="test_result" data-validate="required"
                       data-message-required="Value required" value="<?php echo $row2['result']; ?>" >
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
            </div>
        </div>
        <?php endforeach; ?>
        <?php echo form_close(); ?>
    </div>
</div>