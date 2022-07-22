<?php
//MyReport.php
require APPPATH . "/libraries/koolreport/autoload.php";
class Wallboard_wfh extends \koolreport\KoolReport
{
    use \koolreport\clients\Bootstrap;
    function settings()
    {
        return array(
            "assets" => array(
                "path" => "../../assets",
                "url" => base_url() . "assets",
            ),
            "dataSources" => array(
                "profiling" => array(
                    "connectionString" => "mysql:host=10.194.194.61;dbname=db_profiling",
                    "username" => "ayu",
                    "password" => "ayu123",
                    "charset" => "utf8"
                ),
                "infomedia_app" => array(
                    "connectionString" => "mysql:host=10.194.194.61;dbname=infomedia_app",
                    "username" => "ayu",
                    "password" => "ayu123",
                    "charset" => "utf8"
                ),
                // "profiling" => array(
                //     "connectionString" => "mysql:host=localhost;dbname=trans_profiling",
                //     "username" => "root",
                //     "password" => "",
                //     "charset" => "utf8"
                // ),
                // "infomedia_app" => array(
                //     "connectionString" => "mysql:host=localhost;dbname=trans_profiling",
                //     "username" => "root",
                //     "password" => "",
                //     "charset" => "utf8"
                // ),
            )
        );
    }
    function setup()
    {
        $date_now = date('Y-m-d');
        $datetime_now = date('Y-m-d H:i:s');
        $this->src('infomedia_app')
            ->query("Select veri_call,veri_upd,handphone,email,TIMESTAMPDIFF(SECOND, lup, CURRENT_TIMESTAMP) as idle from trans_profiling_daily where DATE(lup) = '$date_now' ORDER BY idx DESC")
            ->pipe($this->dataStore("reguler"));
        $this->src('infomedia_app')
            ->query("SELECT
            m1.veri_upd AS veri_upd,u.nama,
            TIMESTAMPDIFF(
                SECOND,
                m1.lup,
                CURRENT_TIMESTAMP
            ) AS idle
        FROM
            trans_profiling_daily m1
        LEFT JOIN trans_profiling_daily m2 ON (
            m1.veri_upd = m2.veri_upd
            AND m1.lup < m2.lup
            AND DATE(m2.lup) = '$date_now'
        )
        JOIN sys_user u ON u.agentid = m1.veri_upd
        WHERE
            u.tl != '-' AND u.kategori = 'REG' AND
            m2.veri_upd IS NULL
        AND DATE(m1.lup) = '$date_now'
        AND TIMESTAMPDIFF(
                SECOND,
                m1.lup,
                CURRENT_TIMESTAMP
            ) > 300
        GROUP BY
            m1.veri_upd
        ORDER BY idle DESC
            ")
            ->pipe($this->dataStore("idle_data"));
        $this->src('profiling')
            ->query("SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos  WHERE DATE(tgl_insert) = '$date_now'  AND (keterangan NOT LIKE '%galmit%' AND keterangan NOT LIKE '%gagal submit%')")
            ->pipe($this->dataStore("moss"));
        $this->src('infomedia_app')
            ->query("Select agentid,nama,picture from sys_user where opt_level=8 AND kategori='REG' AND tl != '-' ")
            ->pipe($this->dataStore("agent_reguler"));
        $this->src('infomedia_app')
            ->query("Select agentid,nama,picture from sys_user where opt_level=8 AND kategori='MOS' AND tl != '-' ")
            ->pipe($this->dataStore("agent_moss"));
        $this->src('infomedia_app')
            ->query("Select agentid from sys_user_moss where periode_start>='" . date('Y-m-d') . "' AND periode_end<='" . date('Y-m-d') . "' ")
            ->pipe($this->dataStore("agent_moss_avaliable"));
        $this->src('infomedia_app')
            ->query("Select sys_user.agentid,t_absensi.methode from t_absensi JOIN sys_user ON sys_user.nik_absensi=t_absensi.nik where DATE(t_absensi.waktu_in)='" . date('Y-m-d') . "' AND t_absensi.stts='in' AND tl!='-'")
            ->pipe($this->dataStore("activity_login"));
        $this->src('infomedia_app')
            ->query("Select sys_user.agentid,t_absensi.methode from t_absensi JOIN sys_user ON sys_user.nik_absensi=t_absensi.nik where DATE(t_absensi.waktu_in)='" . date('Y-m-d') . "' AND TIME(t_absensi.waktu_in) >= '09:00:00' AND t_absensi.stts='out' AND tl!='-'")
            ->pipe($this->dataStore("activity_logout"));
        $this->src('infomedia_app')
            ->query("Select sys_user_log_in_out.agentid,sys_user.nama,TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,CURRENT_TIMESTAMP) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where DATE(sys_user_log_in_out.login_time)='" . date('Y-m-d') . "' AND sys_user_log_in_out.ket != '' AND ISNULL(sys_user_log_in_out.logout_time) GROUP BY sys_user_log_in_out.agentid ORDER BY sys_user_log_in_out.id DESC ")
            ->pipe($this->dataStore("activity_aux"));
        // $this->src('profiling')
        //     ->query("SELECT count(*) as num_wo FROM dbprofile_validate_forcall_3p WHERE (update_by IS NOT NULL AND update_by != 'BARU' AND update_by != 'baru' AND update_by != '' ) AND ISNULL(lup)")
        //     ->pipe($this->dataStore("wo"));
    }
}
