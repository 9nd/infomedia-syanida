<?php echo _css("selectize,multiselect,datatables") ?>
<?php echo card_open('Form Tambah', 'bg-green', true) ?>

<form id='form-a'>
    <div class='form-group'>
        <label class='form-label'>Tanggal Pembinaan</label>
        <input type='date' class='form-control data-sending focus-color' id='tanggal' name='tanggal'>
    </div>
    <div class='form-group'>
        <label class='form-label'>Nama Agent</label>
        <select name='agentid[]' id="agentid" class="form-control custom-select">

            <?php
            if ($user_categori != 8) {
            ?>
                <option value="0">--Semua Agent--</option>
            <?php
            }
            if ($list_agent_d['num'] > 0) {
                foreach ($list_agent_d['results'] as $list_agent) {
                    $selected = "";
                    if (isset($_GET['agentid'])) {

                        if (count($_GET['agentid']) > 1) {

                            foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
                                if ($v_agentid == $list_agent->agentid) {
                                    $selected = 'selected';
                                }
                            }
                        } else {
                            $selected = ($list_agent->agentid == $_GET['agentid'][0]) ? 'selected' : '';
                        }
                    }
                    echo "<option value='" . $list_agent->agentid . "' " . $selected . ">" . $list_agent->agentid . " | " . $list_agent->nama . "</option>";
                }
            }
            ?>

        </select>
    </div>

    <div class='form-group'>
        <label class='form-label'>Permasalahan</label>
        <form>
            <table class="timecard display nowrap">
                <tr>
                    <td colspan="5">Cari Temuan QC<br><br></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div id="datakasus">

                        </div>

                    </td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                <tr>

                <tr>
                    <td>Id</td>
                    <td>Tgl</td>
                    <td>Parameter</td>
                    <td>NO HP</td>
                    <td>Detail Not Approvve</td>
                    <td></td>
                <tr>

                </tr>
                <tr>

                    <td><input readonly type="text" name="idtemuan" id="idtemuan" class="form-control data-sending" value=""></td>
                    <td><input readonly type="text" name="tanggalk" id="tanggalk" class="form-control data-sending" value=""></td>
                    <td><input readonly type="text" name="parameter" id="parameter" class="form-control data-sending" value=""></td>
                    <td><input readonly type="text" name="no_hp" id="no_hp" class="form-control data-sending" value=""></td>
                    <td><input readonly type="text" name="detail_not_approve" id="detail_not_approve" class="form-control data-sending" value=""></td>
                    <td>
                        <button type="button" name="insertk" id="save" class="btn btn-info"><span class="fe fe-plus-circle"></span></button>
                        <div>
                    </td>
                </tr>
            </table>
        </form>
        <hr>

        <div id="inserted_item_data">

        </div>



    </div>


</form>


<?php echo card_close() ?>

<?php echo _js("selectize,multiselect,datatables") ?>
<script src="<?php echo base_url() ?>assets/jspdf/jspdf.min.js"></script>
<script>
    var page_version = "1.0.8"
</script>

<script>
    $(document).ready(function() {
        $(".add-row").click(function() {
            var idtemuan = $("#idtemuan").val();
            var tanggalk = $("#tanggalk").val();
            var parameter = $("#parameter").val();
            var no_hp = $("#no_hp").val();
            var detail_not_approve = $("#detail_not_approve").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + idtemuan + "</td><td>" + tanggalk + "</td><td>" + parameter + "</td><td>" + no_hp + "</td><td>" + detail_not_approve + "</td></tr>";
            $("#report_table_reg").append(markup);
        });

        // Find and remove selected table rows
        $(".delete-row").click(function() {
            $("table tbody").find('input[name="record"]').each(function() {
                if ($(this).is(":checked")) {
                    $(this).parents("tr").remove();
                }
            });
        });
    });
</script>
<script>
    // var custom_select = $('.custom-select').selectize({});
    // var custom_select_link = $('.custom-select-link');
    $(document).ready(function() {
        $("#add").click(function() {
            var lastField = $("#buildyourform tr:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var fieldWrapper = $("<tr class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
            fieldWrapper.data("idx", intId);
            var fName = $(
                "<td><input type=\"date\" id=\"tanggal" + intId +
                "\" name=\"tanggal" + intId +
                "\" class=\"fieldname form-control data-sending\" /></td><td><input type=\"text\" id=\"parameter" + intId +
                "\" name=\"parameter" + intId +
                "\" class=\"fieldname form-control data-sending\" /></td><td><input type=\"text\" id=\"nohp" + intId +
                "\" name=\"nohp" + intId +
                "\" class=\"fieldname form-control data-sending\" /></td><td><input type=\"text\" id=\"detail" + intId +
                "\" name=\"detail" + intId +
                "\" class=\"fieldname form-control data-sending\" /></td></tr>"
            );
            var fType = $(
                ""
            );
            var removeButton = $(
                "<td><input type=\"button\" class=\"remove btn btn-danger\" value=\"-\" /></td>"
            );
            removeButton.click(function() {
                $(this).parent().alert();

            });
            fieldWrapper.append(fName);
            fieldWrapper.append(fType);
            fieldWrapper.append(removeButton);
            $("#buildyourform").append(fieldWrapper);
        });
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#report_table_reg").DataTable({
            dom: 'Bfrtip'
        });


    });
</script>
<script type="text/javascript">
    $('#agentid').selectize({});
    // $('#agentid').multiselect();
    var page_version = "1.0.8"
</script>
<script>
    $('body').on('change', '#agentid', function() {
        var agentid = $("#agentid").val();
        $.ajax({
            url: "<?php echo base_url() . "Pembinaan/Pembinaan/get_kasus" ?>",
            data: {
                agentid: agentid
            },
            methode: "get",
            success: function(response) {
                $("#datakasus").html(response);
                fetch_item_data();
            }
        });
    });
    $('body').on('change', '#kasus', function() {
        var kasus = $("#kasus option:selected").text();;
        var res = kasus.split("|");
        $('#parameter').val(res[2]);
        $('#no_hp').val(res[3]);
        $('#tanggalk').val(res[1]);
        $('#detail_not_approve').val(res[4]);
        $('#idtemuan').val(res[0]);
    });

    function tanggal() {
        var start = $("#start").val();
        var end = $("#end").val();
        var agentid = $("#agentid").val();
        $.ajax({
            url: "<?php echo base_url() . "Pembinaan/Pembinaan/get_tanggalk" ?>",
            data: {
                start: start,
                end: end,
                agentid: agentid
            },
            methode: "get",
            success: function(response) {
                $("#tanggalk").html(response);
            }
        });
    }

    $('#save').click(function() {
        var idtemuan = $("#idtemuan").val();
        var tanggal = $("#tanggal").val();
        var agentid = $("#agentid").val();
        $.ajax({
            url: "<?php echo base_url() ?>Pembinaan/Pembinaan/insertk",
            method: "POST",
            data: {
                idtemuan: idtemuan,
                agentid: agentid,
                tanggal: tanggal
            },
            success: function(data) {
                alert('sukses');
                fetch_item_data();
            }
        });
    });

    function fetch_item_data() {
        var tanggal = $("#tanggal").val();
        var agentid = $("#agentid").val();
        $.ajax({
            url: "<?php echo base_url() ?>Pembinaan/Pembinaan/fetch",
            method: "POST",
            data: {
                agentid: agentid,
                tanggal: tanggal
            },
            success: function(data) {
                $('#inserted_item_data').html(data);
            }
        })
    }
</script>