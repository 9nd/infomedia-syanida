<?php echo _css('datatables,icheck,selectize,multiselect') ?>
<div class='col-md-12 col-xl-12'>
    <div class="card">
        <div class="card-status bg-green"></div>
        <div class="card-header">
            <h3 class="card-title">FILTER
            </h3>
            <div class="card-options">
                <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class='box-body' id='box-table'>

                <form id='form-a' methode="GET">

                    <div class='col-md-6 col-xl-6'>
                        <div class='form-group'>
                            <label class='form-label'>Mulai Dari</label>
                            <input type='date' min="" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
                        </div>
                    </div>
                    <div class='col-md-6 col-xl-6'>
                        <div class='form-group'>
                            <label class='form-label'>Sampai </label>
                            <input type='date' min="<?php echo date("Y-m-d", strtotime("-" . (date('d') + 15) . " days")); ?>" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
                        </div>
                    </div>
                    <div class='col-md-6 col-xl-6'>
                        <div class='form-group'>
                            <label class='form-label'>Agent </label>
                            <select name='agentid[]' id="agentid" class="form-control custom-select" multiple="multiple">
                                <?php
                                if ($user_categori != 8) {
                                ?>
                                    <option value="0">--Semua Agent--</option>
                                <?php
                                }
                                if ($list_agent['num'] > 0) {
                                    foreach ($list_agent['results'] as $d_agent) {
                                        $selected = "";
                                        if (isset($_GET['agentid'])) {

                                            if (count($_GET['agentid']) > 1) {

                                                foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
                                                    if ($v_agentid == $d_agent->agentid) {
                                                        $selected = 'selected';
                                                    }
                                                }
                                            } else {
                                                $selected = ($d_agent->agentid == $_GET['agentid'][0]) ? 'selected' : '';
                                            }
                                        }
                                        echo "<option value='" . $d_agent->agentid . "' " . $selected . ">" . $d_agent->agentid . "-" . $d_agent->nama . "</option>";
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </div>


                    <div class='col-md-12 col-xl-12'>

                        <div class='form-group'>
                            <button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class='col-md-12 col-xl-12'>
    <div class="card">
        <div class="card-status bg-orange"></div>
        <div class="card-header">
            <h3 class="card-title">Agent Location Periode <?php echo $start . " To " . $end ?>

            </h3>
            <div class="card-options">
                <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">

                            <div class="h1 m-0"><?php echo $online; ?></div>
                            <div class="text-muted mb-4">ONLINE</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">

                            <div class="h1 m-0"><?php echo $disable; ?></div>
                            <div class="text-muted mb-4">LOCATION DISABLE</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">

                            <div class="h1 m-0"><?php echo $summary['kel'];?></div>
                            <div class="text-muted mb-4">KELURAHAN</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">

                            <div class="h1 m-0"><?php echo $summary['kec'];?></div>
                            <div class="text-muted mb-4">KECAMATAN</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">

                            <div class="h1 m-0"><?php echo $summary['city'];?></div>
                            <div class="text-muted mb-4">KAB/KOTA</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">

                            <div class="h1 m-0"><?php echo $summary['state'];?></div>
                            <div class="text-muted mb-4">PROVINSI</div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <?php echo $map['js']; ?>
                    <?php echo $map['html']; ?>
                </div>
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">AGENT LOCATION DETAIL</h3>
                        </div>
                        <div class="card-body">
                            <div class='box-body table-responsive' id='box-table'>
                                <small>
                                    <table class='timecard' id="report_table_reg" style="width: 100%;">
                                        <thead>

                                            <tr>
                                                <th>No.</th>
                                                <th nowrap>Agent ID</th>
                                                <th>Name</th>
                                                <th nowrap>Team Leader</th>
                                                <th>WFH/WFO</th>
                                                <th>Location</th>
                                                <th>Kelurahan</th>
                                                <th>Kecamatan</th>
                                                <th>Kab/Kota</th>
                                                <th>Provinsi</th>
                                                <th>Checkin</th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $na = 0;
                                            if (count($list_agent['num']) > 0) {
                                                foreach ($list_agent['results'] as $ag) {
                                                    $na++;
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $na; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $ag->agentid; ?>
                                                        </td>
                                                        <td nowrap>
                                                            <?php echo $ag->nama; ?>
                                                        </td>
                                                        <td nowrap>
                                                            <?php echo $list_tl[$ag->tl]; ?>
                                                        </td>
                                                        <td >
                                                            <?php echo (in_array($ag->agentid, $agent_wfo)) ? 'WFO' : 'WFH'; ?>
                                                        </td>
                                                        <td nowrap>
                                                            <?php echo (in_array($ag->agentid, $agent_disable)) ? 'Not Allow' : 'Allow'; ?>
                                                        </td>
                                                        <td nowrap id="kel_<?php echo $absen_detail[$ag->agentid]['location']['latitude'] . $absen_detail[$ag->agentid]['location']['longitude']; ?>"><?php echo $absen_detail[$ag->agentid]['location']['kel']; ?></td>
                                                        <td nowrap id="kec_<?php echo $absen_detail[$ag->agentid]['location']['latitude'] . $absen_detail[$ag->agentid]['location']['longitude']; ?>"><?php echo $absen_detail[$ag->agentid]['location']['kec']; ?></td>
                                                        <td nowrap id="city_<?php echo $absen_detail[$ag->agentid]['location']['latitude'] . $absen_detail[$ag->agentid]['location']['longitude']; ?>"><?php echo $absen_detail[$ag->agentid]['location']['city']; ?></td>
                                                        <td nowrap id="state_<?php echo $absen_detail[$ag->agentid]['location']['latitude'] . $absen_detail[$ag->agentid]['location']['longitude']; ?>"><?php echo $absen_detail[$ag->agentid]['location']['state']; ?></td>
                                                        <td nowrap> <?php echo $absen_detail[$ag->agentid]['waktu_in']; ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                </small>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#report_table_reg').DataTable();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo _js('ybs,selectize,datatables,icheck,multiselect') ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#agentid').selectize({});

        function cache_location(latitude, longitude) {
            var geocoder;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(latitude, longitude);

            geocoder.geocode({
                    'latLng': latlng
                },
                function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var add = results[0].formatted_address;
                            var value = add.split(",");
                            var datana =
                                count = value.length;
                            country = value[count - 1];
                            state = value[count - 2];
                            city = value[count - 3];
                            kec = value[count - 4];
                            kel = value[count - 5];
                            $("#kel_" + latitude + longitude).text(kel);
                            $("#kec_" + latitude + longitude).text(kec);
                            $("#city_" + latitude + longitude).text(city);
                            $("#state_" + latitude + longitude).text(state);
                            $.ajax({
                                url: "<?php echo base_url() . "Monev/Monev/cache_location"; ?>",
                                methode: "POST",
                                data: {
                                    latitude: latitude,
                                    longitude: longitude,
                                    country: country,
                                    state: state,
                                    city: city,
                                    kec: kec,
                                    kel: kel
                                },
                                success: function() {


                                }
                            });
                        }
                    }
                }
            );
        }
        <?php
        $n = 1;
        if (count($cache_location) > 0) {
            foreach ($cache_location as $r) {
                $n++;
        ?>
                cache_location('<?php echo $r['latitude'] ?>', '<?php echo $r['longitude'] ?>');
        <?php
                if ($n < $cache_location && $n == 4) {
                    ?>
                    location.reload();
                    <?php
                }
            }
        }
        ?>

    });
</script>