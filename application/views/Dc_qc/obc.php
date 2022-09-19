
<script>
    $(document).ready(function() {
        var table = $('#datalist').removeAttr('width').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true
        });
    });
    // $('#datalist').DataTable({
    //     dom: 'Bfrtip',
    //     buttons: [
    //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     ],
    //     responsive: true
    // });
</script>
<script>
    function prompt_revalidate(idx) {
        var reason = prompt("Reason QC");
        let addedBtn = $(this);
        if (reason != null && idx != null) {
            $.ajax({
                url: "<?php echo base_url() ?>dc_qc/dc_qc/submit_obc",
                type: "get",
                data: {
                    reason: reason,
                    idx: idx
                },
                success: function(response) {              
                    $('#' + idx).hide();
                    alert(response);
                },
                error: function(xhr) {
                    alert("data GAGAL di re-validate" + xhr);
                }
            });
        }
    }
</script>