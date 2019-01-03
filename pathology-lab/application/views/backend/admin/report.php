<br><br>
<table class="table table-striped datatable" id="dataTable" style="color:#000; font-size: 14px;">
    <thead>
    <tr>
        <th>#</th>
        <th>Patient Name</th>
        <th>Ref No</th>
        <th>Date</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $reports = $this->crud_model->get_db('report');
    foreach ($reports as $k => $row):
        $patient_id = $row['patient_id'];
        $patient_name = $this->crud_model->get_db('patient', ['patient_id' => $patient_id], 'name');
        $ref_no = $row['ref_no'];
        $date = $row['date'];
        $report_id = $row['report_id'];
        ?>
        <tr>
            <td><?php echo $k += 1; ?></td>
            <td><?php echo $patient_name; ?></td>
            <td><?php echo $ref_no; ?></td>
            <td><?php echo $date; ?></td>
            <td>
                <a href="<?php echo $account_url ?>view_report/<?= $report_id ?>" class="btn btn-info"><i
                        class="fa fa-eye"></i> View</a>
            </td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>