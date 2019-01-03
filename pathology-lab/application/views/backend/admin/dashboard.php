<br>
<div class="row">
    <div class="col-md-12">

        <!--Total Number of Patients-->
        <div class="col-md-3">
            <div class="tile-stats tile-red">
                <div class="icon"><i class="fa fa-group"></i></div>
                <div class="num" data-start="0"
                     data-end="
<?php $number_of_patients = $this->db->get('patient')->num_rows();
                     echo $number_of_patients;
                     ?> "
                     data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Patients</h3>
                <p>Total Patients</p>
            </div>
        </div>

        <!--Total Number of Tests-->
        <div class="col-md-3">
            <div class="tile-stats tile-blue">
                <div class="icon"><i class="fa fa-book"></i></div>
                <div class="num" data-start="0"
                     data-end="<?php echo $this->db->count_all('test');?>"
                     data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Tests</h3>
                    <p>Total Tests</p>
            </div>
        </div>

        <!--Total Number of Reports-->
        <div class="col-md-3">
            <div class="tile-stats tile-brown">
                <div class="icon"><i class="fa fa-file-text-o"></i></div>
                <div class="num" data-start="0"
                     data-end="<?php echo $this->db->count_all('report');?>"
                     data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Reports</h3>
                <p>Total Reports</p>
            </div>
        </div>

        <!--Total Number of Technicians-->
        <div class="col-md-3">
            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-users"></i></div>
                <div class="num" data-start="0"
                     data-end="<?php echo $this->db->count_all('technician');?>"
                     data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Technicians</h3>
                <p>Total Technicians</p>
            </div>
        </div>


    </div>
</div>