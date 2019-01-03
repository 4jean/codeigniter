
<br>
<table class="table table-striped datatable" id="dataTable" style="color:#000; font-size: 14px;">
	<thead>
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
        <th>Address</th>
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

		</tr>
	<?php endforeach;?>
	</tbody>
</table>