<a href="<?php echo $account_url; ?>add_report" class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    Add Medical Report
</a>
<br><br>
<table class="table table-striped datatable" id="dataTable" style="color:#000; font-size: 14px;">
    <thead>
    <tr>
        <th>#</th>
        <th>Patient Name</th>
        <th>Ref No</th>
        <th>Date</th>
        <th>Options</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $t1 = ['technician_id' => $user_id];
    $reports = $this->crud_model->get_db('report', $t1);
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
            <td>

                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <!-- report EDITING LINK -->
                        <li>
                            <a href="<?php echo $account_url; ?>edit_report/<?php echo $row['report_id']; ?>">
                                <i class="entypo-pencil"></i>
                                Edit
                            </a>
                        </li>
                        <li class="divider"></li>

                        <!-- report DELETION LINK -->
                        <li>
                            <a onclick="confirm_modal('<?php echo $account_url; ?>report/delete/<?php echo $row['report_id']; ?>')"
                               href="#">
                                <i class="entypo-trash"></i>
                                Delete
                            </a>
                        </li>
                    </ul>
                </div>

            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>