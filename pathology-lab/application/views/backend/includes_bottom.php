<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/datatables/responsive/css/datatables.responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">

<!-- Bottom Scripts -->
<script src="<?php echo base_url(); ?>assets/js/gsap/main-gsap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/joinable.js"></script>
<script src="<?php echo base_url(); ?>assets/js/resizeable.js"></script>
<script src="<?php echo base_url(); ?>assets/js/neon-api.js"></script>
<script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/TableTools.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/lodash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>


<script src="<?php echo base_url(); ?>assets/js/neon-calendar.js"></script>
<script src="<?php echo base_url(); ?>assets/js/neon-chat.js"></script>
<script src="<?php echo base_url(); ?>assets/js/neon-custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/neon-demo.js"></script>

<script src="<?php echo base_url(); ?>assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>


<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""): ?>

    <script type="text/javascript">
        toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
    </script>

<?php endif; ?>

<?php if ($this->session->flashdata('error_message') != ""): ?>

    <script type="text/javascript">
        toastr.error('<?php echo $this->session->flashdata("error_message");?>');
    </script>

<?php endif; ?>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

    jQuery(document).ready(function ($) {
        var datatable = $("#dataTable").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [

                    {
                        "sExtends": "xls",
                        "mColumns": [1, 2]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [1, 2]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText": "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(0, false);
                            datatable.fnSetColumnVis(3, false);

                            this.fnPrint(true, oConfig);

                            window.print();

                            $(window).keyup(function (e) {
                                if (e.which == 27) {
                                    datatable.fnSetColumnVis(0, true);
                                    datatable.fnSetColumnVis(3, true);
                                }
                            });
                        }

                    }
                ]
            }

        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

    //    JSPDF

    $('#savePdf').on('click', function () {
        var reportName = $(this).attr('data-report-name');
        var patientName = $(this).attr('data-patient-name');
        var doc = new jsPDF();
        doc.addHTML($('#report_data')[0], 1, 10, {
            'background': '#fff'
        }, function () {
            doc.save(patientName + ' - ' + reportName + '.pdf');
        });
    });

    $('#emailPdf').on('click', function () {
        var report_id = $(this).attr('data-report-id');
        var doc = new jsPDF();
        doc.addHTML($('#report_data')[0], 1, 10, {
            'background': '#fff'
        }, function () {
            var pdf = doc.output();
            $.ajax({
                url: '<?php echo $account_url;?>send_report/'+report_id,
                data: {data: pdf},
                type: "POST",
                //Do not cache the page
                cache: false,
                success: function (resp) {
alert(resp)
                }
            });
        });
    });
</script>