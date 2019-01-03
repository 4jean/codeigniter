<br>
<div class="row">
    <div class="col-md-12">


        <!--Total Number of Tests by Technician-->
        <div class="col-md-6">
            <div class="tile-stats tile-blue">
                <div class="icon"><i class="fa fa-book"></i></div>
                <div class="num" data-start="0"
                     data-end="<?php echo $this->db->get_where('test', ['technician_id' => $user_id] )->num_rows();?>"
                     data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Tests</h3>
                    <p>Total Tests Conducted by me</p>
            </div>
        </div>

        <!--Total Number of Reports by Technician-->
        <div class="col-md-6">
            <div class="tile-stats tile-brown">
                <div class="icon"><i class="fa fa-file-text-o"></i></div>
                <div class="num" data-start="0"
                     data-end="<?php echo $this->db->get_where('report', ['technician_id' => $user_id] )->num_rows();?>"
                     data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Reports</h3>
                <p>My Reports</p>
            </div>
        </div>


    </div>
</div>