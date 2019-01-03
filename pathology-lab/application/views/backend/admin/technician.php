
<a href="<?php echo $account_url;?>add_technician" class="btn btn-primary pull-right">
	<i class="entypo-plus-circled"></i>
    Add New Technician
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
	$technicians	=	$this->crud_model->get_db('technician' );
	foreach($technicians as $k => $row):?>
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
                        <!-- technician EDITING LINK -->
						<li>
							<a href="<?php echo $account_url;?>edit_technician/<?php echo $row['technician_id'];?>" >
								<i class="entypo-pencil"></i>
                                Edit
							</a>
						</li>
						<li class="divider"></li>

						<!-- technician DELETION LINK -->
						<li>
							<a onclick="confirm_modal('<?php echo $account_url;?>technician/delete/<?php echo $row['technician_id'];?>')" href="#" >
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