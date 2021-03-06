<br>
<div class="row">
    <div class="col-md-12">

        <?php echo form_open(base_url() . 'admin/technician/create/', array('class' => 'form-horizontal form-groups-bordered validate')); ?>

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Full Name</label>

            <div class="col-sm-5">
                <input type="text" id="name" class="form-control" name="name" data-validate="required"
                       data-message-required="Value required" value="" autofocus>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-5">
                <input id="email" type="email" class="form-control" name="email" data-validate="email" data-rule-required="true"  value="">
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-5">
                <input id="password" type="password" class="form-control" name="password" >
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">Phone</label>
            <div class="col-sm-5">
                <input id="phone" type="text" class="form-control" name="phone" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="address" class="col-sm-3 control-label">Address</label>
            <div class="col-sm-5">
                <input id="address" type="text" class="form-control" name="address" value="">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                <button type="submit" class="btn btn-primary btn-lg">Add Technician</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>