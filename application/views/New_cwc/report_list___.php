<?php echo _css("selectize,multiselect,datatables") ?>
<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header  justify-content-between align-items-center">
            <h4 class="card-title">Result</h4>
        </div>
        <div class="card-body">
            <div class="box-body table-responsive" id='box-table'>

                <small>
                    <?php
                    echo $debug_agent."<br>";
                    echo $debug_start."<br>";
                    var_dump($debug_agent);
                    echo "<br>";
                    var_dump($debug_start);
                    ?>
                    
                    <?php
                  
                    ?>
                </small>
            </div>
        </div>
    </div>
</div>

<?php echo _js("ybs,selectize,multiselect,datatables") ?>
<script type="text/javascript">
    $('#agentid').selectize({});
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#report_table_reg").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
    });
</script>