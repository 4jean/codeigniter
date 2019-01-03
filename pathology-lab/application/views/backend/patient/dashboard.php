<br>
<div class="row">
    <div class="col-md-12">


        <!--Total Number of Patient Reports-->
        <div class="col-md-4">
            <div class="tile-stats tile-brown">
                <div class="icon"><i class="fa fa-file-text-o"></i></div>
                <div class="num" data-start="0"
                     data-end="<?php echo $this->db->get_where('report', ['patient_id' => $user_id] )->num_rows();?>"
                     data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Reports</h3>
                <p>My Reports</p>
            </div>
        </div>


    </div>
</div>