<?php echo _css("selectize,multiselect,datatables") ?>
<?php echo card_open('Form Tambah', 'bg-green', true) ?>

<form id='form-a'>

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
        <label class='form-label'>Tanggal Pembinaan</label>
        <input type='date' class='form-control data-sending focus-color' id='tanggal' name='tanggal'>
    </div>
    <div class='form-group'>
        <label class='form-label'>Permasalahan</label>
        <form>
            <table class="table table-bordered" id="crud_table">
                <tr>
                    <th width="30%">Item Name</th>
                    <th width="10%">Item Code</th>
                    <th width="45%">Description</th>
                    <th width="10%">Price</th>
                    <th width="5%"></th>
                </tr>
                <tr>
                    <td contenteditable="true" class="item_name"></td>
                    <td contenteditable="true" class="item_code"></td>
                    <td contenteditable="true" class="item_desc"></td>
                    <td contenteditable="true" class="item_price"></td>
                    <td></td>
                </tr>
            </table>
            <div align="right">
                <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
            </div>
            <div align="center">
                <button type="button" name="save" id="save" class="btn btn-info">Save</button>
            </div>
            <br />
            <div id="inserted_item_data"></div>
        </form>
        <hr>
        <table class="timecard display nowrap" id="report_table_reg">
            <tr>
                <td>#</td>
                <td>id_temuan</td>
                <td>Tgl</td>
                <td>Parameter</td>
                <td>NO HP</td>
                <td>Detail Not Approvve</td>
                <td></td>
            </tr>

        </table>
        <button type="button" class="delete-row">Delete Row</button>

    </div>


</form>


<?php echo card_close() ?>

<?php echo _js("selectize,multiselect,datatables") ?>

<script>
    var page_version = "1.0.8"
</script>

<script>
    $(document).ready(function() {
        var count = 1;
        $('#add').click(function() {
            count = count + 1;
            var html_code = "<tr id='row" + count + "'>";
            html_code += "<td contenteditable='true' class='item_name'></td>";
            html_code += "<td contenteditable='true' class='item_code'></td>";
            html_code += "<td contenteditable='true' class='item_desc'></td>";
            html_code += "<td contenteditable='true' class='item_price' ></td>";
            html_code += "<td><button type='button' name='remove' data-row='row" + count + "' class='btn btn-danger btn-xs remove'>-</button></td>";
            html_code += "</tr>";
            $('#crud_table').append(html_code);
        });

        $(document).on('click', '.remove', function() {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });

        $('#save').click(function() {
            var item_name = [];
            var item_code = [];
            var item_desc = [];
            var item_price = [];
            $('.item_name').each(function() {
                item_name.push($(this).text());
            });
            $('.item_code').each(function() {
                item_code.push($(this).text());
            });
            $('.item_desc').each(function() {
                item_desc.push($(this).text());
            });
            $('.item_price').each(function() {
                item_price.push($(this).text());
            });
            $.ajax({
                url: "<?php echo base_url()?>Pembinaan/Pembinaan/insertk",
                method: "POST",
                data: {
                    item_name: item_name,
                    item_code: item_code,
                    item_desc: item_desc,
                    item_price: item_price
                },
                success: function(data) {
                    alert(data);
                    $("td[contentEditable='true']").text("");
                    for (var i = 2; i <= count; i++) {
                        $('tr#' + i + '').remove();
                    }
                    fetch_item_data();
                }
            });
        });

        function fetch_item_data() {
            $.ajax({
                url: "<?php echo base_url()?>Pembinaan/Pembinaan/fetch",
                method: "POST",
                success: function(data) {
                    $('#inserted_item_data').html(data);
                }
            })
        }
        fetch_item_data();

    });
</script>