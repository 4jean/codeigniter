
<a href="<?php echo $account_url;?>add_patient" class="btn btn-primary pull-right">
	<i class="entypo-plus-circled"></i>
    Add New patient
</a>
<br><br>
<table class="table table-striped datatable" id="dataTable" style="color:#000; font-size: 14px;">
	<thead>
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
        <th>Address</th>
		<th>Options</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$patients	=	$this->crud_model->get_db('patient');
	foreach($patients as $k => $row):?>
		<tr>
			<td><?php echo $k+=1; ?></td>
            <td><?php echo $row['name'];?></td>
			<td><?php echo $row['email'];?></td>
            <td><?php echo $row['phone'];?></td>
            <td><?php echo $row['address'];?></td>
			<td>

				<div class="btn-group">
					<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						Action <span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <!-- patient EDITING LINK -->
						<li>
							<a href="<?php echo $account_url;?>edit_patient/<?php echo $row['patient_id'];?>" >
								<i class="entypo-pencil"></i>
                                Edit
							</a>
						</li>
						<li class="divider"></li>

						<!-- patient DELETION LINK -->
						<li>
							<a onclick="confirm_modal('<?php echo $account_url;?>patient/delete/<?php echo $row['patient_id'];?>')" href="#" >
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