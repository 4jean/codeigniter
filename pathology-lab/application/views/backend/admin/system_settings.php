<hr/>

<div class="row">
    <?php echo form_open(base_url() . 'admin/system_settings/update',
        array('class' => 'form-horizontal form-groups-bordered', 'target' => '_top')); ?>
    <div class="col-md-12">
        <?php
        $name = $this->crud_model->get_settings('system_name');
        $system_phone = $this->crud_model->get_settings('phone');
        $system_email = $this->crud_model->get_settings('system_email');
        $system_host = $this->crud_model->get_settings('system_host');
        $system_password = $this->crud_model->get_settings('system_password');
        $system_address = $this->crud_model->get_settings('address');
        $skin_colour = $this->crud_model->get_settings('skin_colour');
        $twilio_sender_phone_number = $this->crud_model->get_settings('twilio_sender_phone_number');
        $twilio_auth_token = $this->crud_model->get_settings('twilio_auth_token');
        $twilio_account_sid = $this->crud_model->get_settings('twilio_account_sid');
        ?>

        <div class="panel panel-primary">

            <div class="panel-heading">
                <div class="panel-title">
                    System Settings
                </div>
            </div>

            <div class="panel-body">

                <div class="form-group">
                    <label for="system_name" class="col-sm-3 control-label">System Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="system_name" data-validate="required" class="form-control"
                               name="system_name"
                               value="<?php echo $system_name; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <input id="address" type="text" class="form-control" name="address"
                               value="<?php echo $system_address; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="col-sm-3 control-label">Phone</label>
                    <div class="col-sm-9">
                        <input id="phone" type="text" class="form-control" name="phone"
                               value="<?php echo $system_phone; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="skin_colour" class="col-sm-3 control-label">Skin Colour</label>
                    <div class="col-sm-9">
                        <select class="selectboxit" name="skin_colour" id="skin_colour">
                            <option value="" <?php if ($skin_colour == '') echo 'selected'; ?>>Default</option>
                            <?php
                            $skins = ['Black', 'Blue', 'Cafe', 'Green', 'Purple', 'Red', 'White'];
                            foreach ($skins as $skin):
                                ?>
                                <option
                                    value="<?= $skin ?>" <?php if ($skin_colour == $skin) echo 'selected'; ?>><?= $skin ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
<!--Email Settings-->
                <h3><strong>EMAIL SETTINGS</strong></h3>
                <hr>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">System Email</label>
                    <div class="col-sm-9">
                        <input type="email" id="email" class="form-control" name="system_email" data-validate = "email"
                               value="<?php echo $system_email; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">System Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="password" class="form-control" name="system_password"
                               value="<?php echo $system_password; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="system_host" class="col-sm-3 control-label">System Host</label>
                    <div class="col-sm-9">
                        <input type="text" id="system_host" class="form-control" name="system_host"
                               value="<?php echo $system_host; ?>">
                    </div>
                </div>

                <!--SMS Settings-->
                <h3><strong>SMS SETTINGS (TWILLO)</strong></h3>
                <hr>
                <div class="form-group">
                    <label for="twilio_account_sid" class="col-sm-3 control-label">Twillo Account SID</label>
                    <div class="col-sm-9">
                        <input type="text" id="twilio_account_sid" class="form-control" name="twilio_account_sid"
                               value="<?php echo $twilio_account_sid; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="twilio_auth_token" class="col-sm-3 control-label">Twillo Auth Token</label>
                    <div class="col-sm-9">
                        <input type="text" id="twilio_auth_token" class="form-control" name="twilio_auth_token"
                               value="<?php echo $twilio_auth_token; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="twilio_sender_phone_number" class="col-sm-3 control-label">Twillo Sender Phone Number</label>
                    <div class="col-sm-9">
                        <input type="text" id="twilio_sender_phone_number" class="form-control" name="twilio_sender_phone_number"
                               value="<?php echo $twilio_sender_phone_number; ?>">
                    </div>
                </div>

            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-info btn-lg">Save Changes</button>
            </div>
        </div>

        <?php echo form_close(); ?>

    </div>

</div>