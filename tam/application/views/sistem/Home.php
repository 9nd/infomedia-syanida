


<body style="background-color:#00acee;color:white;">
    <table width="100%">
        <tr>
            <td width="33%">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">

            </td>
            <td width="34%" style="text-align:center;">
                <h1>PROFILING HOME PAGE</h1>
            </td>
            <td width="33%" style="text-align:right;">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">
            </td>
        </tr>
    </table>
    <table width="100%" style="text-align:center;">
        <tr>
            <td width="15%">

            </td>
            <td width="70%">
                <!-- <h2>PROFILING DASHBOARD</h2> -->
                <!-- <img src="<?php echo base_url('assets/images/logo_profiling.png') ?>" class="fontlogo" alt="" width="50%"> -->
            </td>
            <td width="15%">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <div class="card-body">

                    <div class="row">
                    <?php
                    if($userdata->opt_level == 8){
                        ?>
                         <div class="col-sm-12">
                            <a href="<?php echo base_url()."lockscreen?ket=OUT";?>" class="card p-3 btn btn-danger btn-card">
                                <div class="d-flex align-items-center">
                                    <span class="stamp stamp-md bg-red mr-3">
                                    <i class="fe fe-power"></i>
                                       
                                    </span>
                                    <div class="text-left">
                                        <h2 class="m-0 text-red">BREAK</h2>
                                        <small class="text-muted">Click tombol break, jika anda akan meninggalkan tempat duduk!</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }else{
                        ?>
                         <div class="col-sm-6">
                            <a href="<?php echo base_url()."dashboard/wallboard_moss_v2";?>" class="card p-3 btn btn-info btn-card">
                                <div class="d-flex align-items-center">
                                    <span class="stamp stamp-md bg-orange mr-3">
                                        <i class="fe fe-tag"></i>
                                    </span>
                                    <div class="text-left">
                                        <p class="m-0 text-orange">MENUJU HALAMAN WALLBOARD MOSS</p>
                                        <small class="text-muted">Moss Wallboard Daily</small>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-sm-6">
                            <a href="<?php echo base_url()."dashboard/wallboard_reguler_v2";?>" class="card p-3 btn btn-primary btn-card">
                                <div class="d-flex align-items-center">
                                    <span class="stamp stamp-md bg-blue mr-3">
                                    <i class="fe fe-users"></i>
                                       
                                    </span>
                                    <div class="text-left">
                                        <p class="m-0 text-blue">MENUJU HALAMAN WALLBOARD REGULER</p>
                                        <small class="text-muted">Reguler Wallboard Daily</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                       

                        <div class="col-sm-6">
                            <a href="<?php echo base_url()."dashboard/dashboard";?>" class="card p-3 btn btn-danger btn-card">
                                <div class="d-flex align-items-center">
                                    <span class="stamp stamp-md bg-red mr-3">
                                    <i class="fe fe-bar-chart"></i>
                                    </span>
                                    <div class="text-left">
                                        <p class="m-0 text-red">MENUJU HALAMAN DASHBOARD</p>
                                        <small class="text-muted">Daily Dashboard</small>
                                    </div>
                                </div>
                            </a>
                        </div>
						<div class="col-sm-6">
                            <a href="<?php echo base_url()."Report_profiling/Report_profiling/";?>" class="card p-3 btn btn-success btn-card">
                                <div class="d-flex align-items-center">
                                    <span class="stamp stamp-md bg-green mr-3">
                                    <i class="fe fe-bar-chart"></i>
                                    </span>
                                    <div class="text-left">
                                        <p class="m-0 text-green">MENUJU HALAMAN REPORT</p>
                                        <small class="text-muted">Report By Date</small>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </td>
            <td></td>
        </tr>
    </table>

</body>
