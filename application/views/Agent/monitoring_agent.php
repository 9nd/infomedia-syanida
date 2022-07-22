<div class="row">
    <div class="col-md-12 col-xl-12" >

        <div class="form-group " style="color:#a3a8ac;font-size:12px">
            <button type="button" class="btn btn-primary btn-filter" id="semua"></button>
            <button type="button" class="btn btn-success btn-filter" id="green"></button>
            <button type="button" class="btn btn-danger btn-filter" id="red"></button>
            <button type="button" class="btn btn-warning btn-filter" id="yellow"></button>
        </div>

    </div>
    <div class="col-xl-12" style="color:#a3a8ac;font-size:12px;text-align:center;">
        <div class="row row-cards">

            <?php

            if ($agent['num'] > 0) {
                foreach ($agent['results'] as $ag) {
                    $color = "red";
                    $login = $this->sys_user_log_login->get_row(array("id_user" => $ag->id, "DATE_FORMAT(FROM_UNIXTIME(login_time), '%Y-%m-%d') =" => date('Y-m-d')), array("*"), array("id" => "DESC"));
                    if ($login) {
                        $color = "green";
                        $logout = $this->sys_user_log_login->get_row(array("id" => $login->id), array("*"), array("id" => "DESC"));
                        if ($logout->logout_time != '') {
                            $color = "red";
                        } else {
                            $log_keluar = $this->Sys_log->get_row(array("id_user" => $ag->id, "DATE_FORMAT(login_time, '%Y-%m-%d') =" => date('Y-m-d')), array("*"), array("id" => "DESC"));
                            if ($log_keluar) {
                                if ($log_keluar->logout_time == '') {
                                    $color = "yellow";
                                }
                            }
                        }
                    }



            ?>
                    <!--image 1-->
                    <div class="col-sm-2 col-lg-2 data-<?php echo $color; ?> data-semua">

                        <div class="media">
                            <div class="media-body">
                                <span class="avatar " id="agent_1_foto" style="border: 5px solid <?php echo $color; ?>;width: 100px;height: 100px;background-image: url(<?php echo base_url() . "YbsService/get_foto_agent/" . $ag->picture; ?>)"></span>
                                <br><span id="agent_1_nama"><?php echo $ag->nama ?></span>
                                <br><span id="agent_1_num"><?php echo $ag->agentid ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- end image 1-->
            <?php
                }
            }

            ?>

        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-filter").click(function() {
            var elem = $(this).attr("id");
            switch(elem){
                case "semua":
                    $(".data-semua").show();
                break;
                case "red":
                    $(".data-red").show();
                    $(".data-yellow").hide();
                    $(".data-green").hide();
                break;
                case "yellow":
                    $(".data-yellow").show();
                    $(".data-red").hide();
                    $(".data-green").hide();
                break;
                case "green":
                    $(".data-green").show();
                    $(".data-yellow").hide();
                    $(".data-red").hide();
                   
                break;
            }
           
        });
    });
</script>