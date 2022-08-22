<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Send_tele_list extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->infomedia = $this->load->database('infomedia', TRUE);
    }


    function cek_datamoss()
    {
        $curdate = DATE("Y-m-d");
        $curdate_h = DATE("Y-m-d H:i:s");
        $cek_datamoss = $this->infomedia->query("
        SELECT
	no_speedy,
	count(*) AS jml,
    tgl_insert as jam_masuk,
	ROUND( time_to_sec(( TIMEDIFF( NOW(), '$curdate_h' ))) / 60 ) AS selisih,
	TIMESTAMPDIFF( SECOND, tgl_insert, lup ) AS slg,
	TIMESTAMPDIFF( SECOND, tgl_insert, click_time ) AS slfc 
FROM
	trans_profiling_validasi_mos 
WHERE
	`status` IN ( '0', '3', NULL ) 
	AND ncli IS NOT NULL 
	AND update_by IS NULL 
	AND DATE( tgl_insert ) = '$curdate' 
HAVING
	selisih > 3 
ORDER BY
	slg DESC")->result();
        $jmlhwo = 0;
        $jmlhwo = $this->infomedia->query("SELECT count(*) as jml
    FROM
        trans_profiling_validasi_mos 
    WHERE
        `status` IN ( '0', '3', NULL ) 
        AND ncli IS NOT NULL 
        AND update_by IS NULL 
    ORDER BY
        tgl_insert DESC")->row()->jml;
        $jmldata = 0;
        $jmldata = count($cek_datamoss);
        $this->load->library('telegram');
        $chatidsys = $this->db->query("SELECT * FROM sys_user WHERE opt_level=9")->result();
        $cekloginmoss = $this->db->query("SELECT
        a.chat_id_telegram 
    FROM
        sys_user a
        LEFT JOIN sys_userlogin b ON a.id = b.iduser 
    WHERE
        a.kategori = 'MOS' 
        AND (from_unixtime( b.login_time, '%Y-%m-%d' ) = DATE(CURDATE()) OR (from_unixtime( b.login_time, '%Y-%m-%d' ) - 1) = DATE(CURDATE() -1))
        AND (a.chat_id_telegram > 0)")->result();
        if ($jmldata > 0) {
            $listnointernet = "";
            foreach ($cek_datamoss as $listmoss) {
                $listnointernet = $listmoss->no_speedy . " | " . $listnointernet;
            }
            $pesan = "WARNING !!! 
HARAP CEK DATA MOSS, 
NO SPEEDY : " . $listnointernet . "
telah lebih dari 3 MENIT
WO : " . $jmlhwo;


            $hasil = "ada antrian";
        } else {
            $pesan = "INFORMATION :
DATA MOSS AMAN (TIDAK ADA DATA LEBIH DARI 3 MENIT) 
WO : " . $jmlhwo;

            $hasil = "gak ada antrian";
        }
        foreach ($chatidsys as $listsend) {
            $this->telegram->send_manual($pesan, '',  '', $listsend->chat_id_telegram);
        }

        foreach ($cekloginmoss as $agentmoss) {
            $this->telegram->send_manual($pesan, '',  '', $agentmoss->chat_id_telegram);
        }
        echo  $hasil;
    }

    function testsend()
    {
        $this->load->library('telegram');
        $pesan = "INFORMATION, DATA MOSS AMAN (TIDAK ADA DATA LEBIH DARI 3 MENIT)" . " | WO : " . $jmldata;
        $this->telegram->send_manual($pesan, 'asdf',  '9', '1214868605');
    }
}
