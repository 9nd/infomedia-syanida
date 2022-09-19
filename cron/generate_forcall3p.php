<?php
//SITE BANDUNG

date_default_timezone_set('Asia/Jakarta');
$servername = "10.194.194.61";
$username = "ayu";
$password = "ayu123";
$dbname = "db_profiling";
///connect to db

$connect_cms_bdg = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect_cms_bdg->connect_error) {
    die("Connection failed: " . $connect_cms_bdg->connect_error);
}
$limit=5;
for($z=0;$z<=$limit;$z++){
    $verified_status = 0;
    $dapros_status = 0;
    // API URL
    $url = 'http://10.194.52.203/infomedia_app/api/Public_Access/get_dapros';
    // Create a new cURL resource
    $ch = curl_init($url);

    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Execute the POST request
    $result = curl_exec($ch);
    // Close cURL resource
    curl_close($ch);
    $res = json_decode($result);

    if (isset($res->NCLI)) {
        $ncli = $res->NCLI;

        $data_insert = (array) $res;
        if ($ncli) {
            $verified_status = 0;
            $dapros_status = 0;

            ///check verified
            $s_check_verified = 'SELECT ncli,lup FROM trans_profiling_verifikasi WHERE ncli="' . $ncli . '" ORDER BY lup DESC';
            $q_check_verified = $connect_cms_bdg->query($s_check_verified);

            if ($q_check_verified->num_rows > 0) {
                // output data of each row
                while ($d_check_verified = $q_check_verified->fetch_assoc()) {
                    $now = strtotime("-1 years", strtotime(date('Y-m-d H:i:s')));
                    $d_verified = strtotime($d_check_verified['lup']);
                    ///check 1 years
                    if ($d_verified > $now) {
                        $verified_status = 1;
                    }
                }
            }

            ///check daros
            $s_check_dapros = 'SELECT ncli,lup,status FROM dbprofile_validate_forcall_3p WHERE ncli="' . $ncli . '" ORDER BY lup DESC';
            $q_check_dapros = $connect_cms_bdg->query($s_check_dapros);
            if ($q_check_dapros->num_rows > 0) {
                // output data of each row
                while ($d_check_dapros = $q_check_dapros->fetch_assoc()) {
                    if ($d_check_dapros['status'] == 1) {
                        $now = strtotime("-1 years", strtotime(date('Y-m-d H:i:s')));
                        $d_dapros = strtotime($d_check_dapros['lup']);
                        if ($d_dapros > $now) {
                            $dapros_status = 1;
                        }
                    } else {
                        $dapros_status = 0;
                    }
                }
            }


            $r_data = $data_insert;
            if ($verified_status == 0 && $dapros_status == 0) {

                /////add data to forcal3p
                // header('Content-Type: application/json');
                // echo json_encode($data_insert);

                $s_input_dapros = 'INSERT INTO dbprofile_validate_forcall_3p 
                (ncli, no_pstn, no_speedy,nama_pelanggan,no_handpone,email,nama_pastel,alamat,KOTA,sumber,no_tgl,status,status2,status3)
                VALUES
                ("' . $r_data['NCLI'] . '","' . $r_data['NO_PSTN'] . '","' . $r_data['NO_SPEEDY'] . '","' . $r_data['NAMA_PELANGGAN'] . '","' . $r_data['NO_HP'] . '","' . $r_data['EMAIL'] . '","' . $r_data['NAMA_PEMILIK'] . '","' . $r_data['ALAMAT'] . '","' . $r_data['KOTA'] . '","' . $r_data['SUMBER'] . '","' . date("Y-m-d H:i:s") . '",0,0,0)';

                if ($connect_cms_bdg->query($s_input_dapros) === TRUE) {
                    echo "New record created successfully <br>";
                } else {
                    echo "Error: " . $s_input_dapros . "<br>" . $connect_cms_bdg->error;
                }
            } else {
                if ($dapros_status == 0) {
                    // header('Content-Type: application/json');
                    // echo json_encode($data_insert);
                    /////add data to forcal3p
                    $this->distribution->delete(array('ncli' => $ncli, 'status' => 0));
                    $d_dapros = "DELETE FROM dbprofile_validate_forcall_3p WHERE ncli='$ncli' AND status=0  ";
                    if ($connect_cms_bdg->query($d_dapros) === TRUE) {
                        echo "Record deleted successfully <br>";
                    } else {
                        echo "Error deleting record: " . $connect_cms_bdg->error;
                    }

                    $s_input_dapros = 'INSERT INTO dbprofile_validate_forcall_3p 
                    (ncli, no_pstn, no_speedy,nama_pelanggan,no_handpone,email,nama_pastel,alamat,KOTA,sumber,no_tgl,status,status2,status3)
                    VALUES
                    ("' . $r_data['NCLI'] . '","' . $r_data['NO_PSTN'] . '","' . $r_data['NO_SPEEDY'] . '","' . $r_data['NAMA_PELANGGAN'] . '","' . $r_data['NO_HP'] . '","' . $r_data['EMAIL'] . '","' . $r_data['NAMA_PEMILIK'] . '","' . $r_data['ALAMAT'] . '","' . $r_data['KOTA'] . '","' . $r_data['SUMBER'] . '","' . date("Y-m-d H:i:s") . '",0,0,0)';
                    if ($connect_cms_bdg->query($s_input_dapros) === TRUE) {
                        echo "New record created successfully <br>";
                    } else {
                        echo "Error: " . $s_input_dapros . "<br>" . $connect_cms_bdg->error;
                    }
                }
            }

            $url = 'http://10.194.52.203/infomedia_app/api/Public_Access/update_dapros/' . $ncli;
            // Create a new cURL resource
            $ch = curl_init($url);

            // Set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            // Return response instead of outputting
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Execute the POST request
            $result = curl_exec($ch);
            // Close cURL resource
            curl_close($ch);
        }
    }
}

$connect_cms_bdg->close();
