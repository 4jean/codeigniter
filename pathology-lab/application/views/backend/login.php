<!doctype html>
<?php
$system_name = $this->crud_model->get_settings('system_name');
?>

<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        LOGIN | <?php echo $system_name; ?>
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_page/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_page/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_page/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_page/css/style.css">
    <script src="<?php echo base_url(); ?>assets/login_page/js/vendor/modernizr-2.8.3.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
  </head>
<body>
<div class="main-content-wrapper">
    <div class="login-area">
        <div class="login-header">
            <a href="<?php echo base_url(); ?>index.php?login" class="logo">
                <img src="<?php echo base_url(); ?>assets/login_page/img/logo.png" height="60" alt="">
            </a>
            <h2 class="title"><?php echo $system_name; ?></h2>
        </div>

        <div class="login-content">
            <form method="post" role="form" id="form_login"
                  action="<?php echo base_url(); ?>login/validate_login">

                <div class="form-group">
                    <input type="text" class="input-field" name="name_email" id="name_email" placeholder="Name or Email"
                           required autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="password" class="input-field" name="password" placeholder="Password or Passcode"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">Login<i class="fa fa-lock"></i></button>
            </form>

            <div class="login-bottom-links">
                <a href="<?php echo base_url(); ?>login/forgot_password" class="link">
                    Forgot your password ?
                </a>
            </div>
        </div>
    </div>
    <div class="image-area"></div>
</div>

<script src="<?php echo base_url(); ?>assets/login_page/js/vendor/jquery-1.12.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.js"></script>
<script src="<?php echo base_url(); ?>assets/login_page/js/typeahead.min.js"></script>


<script>
    $('#name_email').typeahead({
        ajax: '<?php echo base_url();?>patient/fetch/'
    });
</script>
<?php if ($this->session->flashdata('login_error') != '') { ?>
    <script type="text/javascript">
        $.notify({
            // options
            title: '<strong>Error!!</strong>',
            message: '<?php echo $this->session->flashdata('login_error');?>'
        }, {
            // settings
            type: 'danger'
        });
    </script>
<?php } ?>

</body>
</html>
