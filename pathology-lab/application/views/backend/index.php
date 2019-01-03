<?php
$system_name   =    $this->crud_model->get_settings('system_name');
$skin_colour   =    $this->crud_model->get_settings('skin_colour');
$account_type  =	$this->session->userdata('login_type');
$account_name  =	$this->session->userdata('name');
$user_id       =    $this->session->userdata('user_id');
$account_url   =    base_url().$account_type.'/';

	?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title><?php echo $page_title;?> | <?php echo $system_name;?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="<?php echo $system_name;?>" />
	<meta name="author" content="CJ Inspired" />



	<?php include 'includes_top.php';?>

</head>
<body class="page-body <?php if ($skin_colour != '') echo 'skin-' . $skin_colour;?>" >
	<div class="page-container" >
		<?php include $account_type.'/navigation.php';?>
		<div class="main-content">

			<?php include 'header.php';?>

           <h3>
           	<i class="entypo-right-circled"></i>
				<?php echo $page_title;?>
           </h3>

			<?php include $account_type.'/'.$page_name.'.php';?>

			<?php include 'footer.php';?>

		</div>

	</div>
	<?php include 'modal.php';?>
    <?php include 'includes_bottom.php';?>

</body>
</html>