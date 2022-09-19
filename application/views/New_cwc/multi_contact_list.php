<div class="card">
    <div class="card-header  justify-content-between align-items-center">
        <h4 class="card-title">Result</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            <?php
            $on4 = json_decode($on4);
            $salper = json_decode($salper);
            $reguler = json_decode($reguler);
            $indipass = json_decode($indipass);
            $moss = json_decode($moss);
            $on4transpose = array();
            $salpertranspose = array();
            foreach ($on4 as $dataon4) {
                array_push(
                    $on4transpose,
                    array(
                        'sumber' => 'ON4',
                        'nama' => $dataon4->cust_name,
                        'kontak' => $dataon4->cust_hp,
                        'kontakemail' => $dataon4->cust_email,
                        'pstn' => $dataon4->cust_phone1,
                        'twitter' => $dataon4->cust_tw_name,
                        'ig' => $dataon4->cust_ig_name,
                        'facebook' => $dataon4->cust_fb_name
                    )
                );
            }
            $no = 1;
            foreach ($salper as $vdatasalper) {
                if($no >2 && $vdatasalper != null){
                    array_push(
                        $on4transpose,
                        array(
                            'sumber' => 'SALPER',
                            'nama' => $vdatasalper->nama_pelanggan,
                            'kontak' => $vdatasalper->dial_to,
                            'kontakemail' => $vdatasalper->email,
                            'pstn' => '#',
                            'twitter' => '#',
                            'ig' => '#',
                            'facebook' => '#'
                        )
                    );
                }
               
                $no++;
            }
            foreach ($reguler as $datareg) {
                array_push(
                    $on4transpose,
                    array(
                        'sumber' => 'Profiling Reguler',
                        'nama' => $datareg->nama_pelanggan,
                        'kontak' => $datareg->no_handpone,
                        'kontakemail' => $datareg->email,
                        'pstn' => $datareg->no_pstn,
                        'twitter' => 'not provided',
                        'ig' => 'not provided',
                        'facebook' => 'not provided'
                    )
                );
            }
            foreach ($indipass as $dataindipass) {
                array_push(
                    $on4transpose,
                    array(
                        'sumber' => 'Indipass',
                        'nama' => '#',
                        'kontak' => $dataindipass->msisdn,
                        'kontakemail' => $dataindipass->email,
                        'pstn' => '#',
                        'twitter' => '#',
                        'ig' => '#',
                        'facebook' => '#'
                    )
                );
            }
            foreach ($moss as $datamoss) {
                array_push(
                    $on4transpose,
                    array(
                        'sumber' => 'Profiling MOSS',
                        'nama' => $datamoss->nama_pelanggan,
                        'kontak' => $datamoss->no_handpone,
                        'kontakemail' => $datamoss->email,
                        'pstn' => $datamoss->no_pstn,
                        'twitter' => '#',
                        'ig' => '#',
                        'facebook' => '#'
                    )
                );
            }
        //   var_dump($reguler);


            ?>
            <table id="example" class="display table dataTable table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Sumber</th>
                        <th>Nama</th>
                        <th>No inernet</th>
                        <th>Kontak</th>
                        <th>Email</th>
                        <th>PSTN</th>
                        <th>Twitter</th>
                        <th>IG</th>
                        <th>Facebook</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($on4transpose as $datana) {


                    ?>
                        <tr>
                            <td><?php echo $datana['sumber']; ?></td>
                            <td><?php echo $datana['nama']; ?></td>
                            <td><?php echo $_GET['value']; ?></td>
                            <td><?php echo $datana['kontak']; ?></td>
                            <td><?php echo $datana['kontakemail']; ?></td>
                            <td><?php echo $datana['pstn']; ?></td>
                            <td><?php echo $datana['twitter']; ?></td>
                            <td><?php echo $datana['ig']; ?></td>
                            <td><?php echo $datana['facebook']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>