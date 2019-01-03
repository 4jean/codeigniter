<br>
<?php
$data['report_id'] = $report_id;
$report_data = $this->crud_model->get_db('report', $data);
foreach ($report_data as $row):
    $patient_id = $row['patient_id'];
    $patient = $this->crud_model->get_db('patient', ['patient_id' => $patient_id]);
    $patient_name = $this->crud_model->get_db('patient', ['patient_id' => $patient_id], 'name');
    $technician_name = $this->crud_model->get_db('technician', ['technician_id' => $row['technician_id']], 'name');
    $ref_no = $row['ref_no'];
    $date = date('D\, dS F\, Y', strtotime($row['date']));
    $report_id = $row['report_id'];
    $report_name = $row['name'];
    $description = $row['description'];
    ?>
<div class="text-center">

    <a href="#" id="savePdf" data-report-name="<?php echo $report_name;?>" data-patient-name="<?php echo $patient_name;?>" class="btn btn-danger btn-lg"><i class="fa fa-file"></i> Export PDF</a>

    <a href="#" id="emailPdf" data-report-id="<?php echo $report_id;?>" class="btn btn-primary btn-lg"><i class="entypo-attach"></i> Email PDF</a>

</div>
<br>
<div id="report_data">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title ">
                            <h3> <strong><i class="fa fa-hospital-o"></i> <?php echo $system_name;?> </strong></h3>
                        </div>
                    </div>

                    <div class="panel-body" style="font-size: 16px; color:#000;">
                       <h3 class="text-center"><strong> MEDICAL  REPORT DETAILS </strong></h3><br>

                        <div class="row">
                            <div class="col-md-6">
                               <div class="col-md-12">
                                   <!--Report Details-->
                                   <div class="col-md-6"><strong>Ref No:</strong></div>
                                   <div class="col-md-6 "><?php echo $ref_no; ?></div>
                                   <div class="col-md-6"><strong>Purpose:</strong></div>
                                   <div class="col-md-6 "><?php echo $report_name; ?></div>
                                   <div class="col-md-6"><strong>Technician:</strong></div>
                                   <div class="col-md-6 "><?php echo $technician_name; ?></div>
                                   <div class="col-md-6"><strong>Date:</strong></div>
                                   <div class="col-md-6 "><?php echo $date; ?></div>
                               </div>
                            </div>
<!--Patient Details-->
                            <?php
                            foreach ($patient as $rowp):
                                $age = $rowp['age'];
                                $gender = $rowp['gender'];
                                $phone  = $rowp['phone'];
                            ?>
                            <div class="col-md-6">
                                <div class="col-md-12">

                                    <div class="col-md-6"><strong>Patient Name</strong></div>
                                    <div class="col-md-6 "><?php echo $patient_name; ?></div>
                                    <div class="col-md-6"><strong>Age:</strong></div>
                                    <div class="col-md-6 "><?php echo $age; ?></div>
                                    <div class="col-md-6"><strong>Gender:</strong></div>
                                    <div class="col-md-6 "><?php echo $gender; ?></div>
                                    <div class="col-md-6"><strong>Phone:</strong></div>
                                    <div class="col-md-6 "><?php echo $phone; ?></div>
                                </div>
                            </div>
<?php endforeach;?>
                        </div>
                        <br><br>
                        <!--Report Description-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="" style="padding: 10px; border: 1px;">
                                    <h4><strong>DESCRIPTION</strong></h4>
                                    <hr>
                                    <span><?php echo $description; ?></span>
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <!--Tests Conducted-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="" style="padding: 10px; border: 1px;">
                                    <h4><strong>TEST(S) CONDUCTED</strong></h4>
                                    <hr>
                                    <?php
                                    $test_data['patient_id'] = $patient_id;
                                    $test_data['report_id'] = $report_id;
                                    $tests = $this->crud_model->get_db('test', $test_data);
                                    foreach($tests as $k => $test):
                                    ?>

                               <span style="font-weight: bold; color: darkred; font-size: 18px;">Test <?=$k+=1?>: <?php echo $test['name']; ?>
                               </span> <br> <br>

                                        <strong>Test Result:</strong> <?php echo $test['result']; ?> <br>
                                        <strong>Comment:</strong> <?php echo $test['comments']; ?> <hr>
                                    <?php endforeach ?>
                                    <div class="text-center">
                                        &copy;  <?=date('Y').' '. $system_name;?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>