
<a href="<?php echo $account_url;?>add_test" class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    Add Lab Test
</a>
<br><br>
<table class="table table-striped datatable" id="dataTable" style="color:#000; font-size: 14px;">
    <thead>
    <tr>
        <th>#</th>
        <th>Test Name</th>
        <th>Patient Name</th>
        <th>Date</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $t1 = ['technician_id' => $user_id];
    $tests	=	$this->crud_model->get_db('test', $t1);
    foreach($tests as $k => $row):
        $test_name = $row['name'];
        $patient_id = $row['patient_id'];
        $patient_name = $this->crud_model->get_db('patient', ['patient_id' => $patient_id], 'name');
        $date = $row['date'];
        ?>
        <tr>
            <td><?php echo $k+=1; ?></td>
            <td><?php echo $test_name;?></td>
            <td><?php echo $patient_name;?></td>
            <td><?php echo $date;?></td>
            <td>

                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <!-- test EDITING LINK -->
                        <li>
                            <a href="<?php echo $account_url;?>edit_test/<?php echo $row['test_id'];?>" >
                                <i class="entypo-pencil"></i>
                                Edit
                            </a>
                        </li>
                        <li class="divider"></li>

                        <!-- test DELETION LINK -->
                        <li>
                            <a onclick="confirm_modal('<?php echo $account_url;?>test/delete/<?php echo $row['test_id'];?>')" href="#" >
                                <i class="entypo-trash"></i>
                                Delete
                            </a>
                        </li>
                    </ul>
                </div>

            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>