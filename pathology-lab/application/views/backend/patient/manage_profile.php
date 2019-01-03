<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">

            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-user"></i>
                    <?php echo $page_title;?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>


        <div class="tab-content">
            <br>
            <!----EDITING FORM STARTS---->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                        <?php echo form_open(base_url() . 'patient/manage_profile/update/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

                    <?php
                    $data = ['patient_id' => $user_id];
                    $edit_data = $this->crud_model->get_db('patient', $data);
                    foreach($edit_data as $row):
                        ?>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-5">
                                <input id="name" disabled="disabled" type="text" class="form-control" data-validate="required" name="name" value="<?php echo $row['name'];?>" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-5">
                                <input id="email" type="email" class="form-control" name="email" data-validate="email" value="<?php echo $row['email'];?>" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">Phone</label>
                            <div class="col-sm-5">
                                <input id="phone" type="text" class="form-control" name="phone" data-validate="required" value="<?php echo $row['phone'];?>" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-5">
                                <input id="address" type="text" class="form-control" name="address" data-validate="required" value="<?php echo $row['address'];?>" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info btn-lg">Update Profile</button>
                            </div>
                        </div>
                        <?php
                    echo form_close();
                    endforeach;
                    ?>
                </div>
            </div>
            <!----EDITING FORM ENDS-->

        </div>
    </div>
</div>

<br>