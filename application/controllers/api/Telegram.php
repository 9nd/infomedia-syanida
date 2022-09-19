<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Telegram extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Custom_model/Tahun_model', 'tahun');
        // $this->load->model('Absensi/Absensi_model', 't_absensi');
    }


    function get_update()
    {
        // echo "halu";
        $botToken = "1676733678:AAH7rEX3xix1orXF88XEl-KO1ynskKT_v-Q";

        $website = "https://api.telegram.org/bot" . $botToken;

        $ch = curl_init($website . '/getUpdates');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        $arraynya = json_decode($result);
        // echo $result;
        // var_dump($arraynya->result);
        foreach ($arraynya->result as $datanya) {
            $update_id = $datanya->update_id;
            $message_id = $datanya->message->from->id;
            $is_bot = $datanya->message->from->is_bot;
            $first_name = $datanya->message->from->first_name;
            $last_name = $datanya->message->from->last_name;
            if (isset($datanya->message->from->username)) {
                $username = $datanya->message->from->username;
            } else {
                $username = 0;
            }

            $language_code = $datanya->message->from->language_code;
            $chatid = $datanya->message->chat->id;
            $date = $datanya->message->date;
            $text = $datanya->message->text;

            $data = array(
                "update_id" => "$update_id",
                "messege_id" => "$message_id",
                "is_bot" => "$is_bot",
                "first_name" => "$first_name",
                "last_name" => "$last_name",
                "username" => "$username",
                "language_code" => "$language_code",
                "chat_id" => "$chatid",
                "date" => "$date",
                "text" => "$text"
            );
            $updateid = $this->db->query("SELECT * FROM t_telegram_receive WHERE update_id='$update_id'");
            $chatidsys = $this->db->query("SELECT * FROM sys_user WHERE chat_id_telegram='$chatid'");

            if (count($updateid->result()) == 0) {
                $this->db->insert("t_telegram_receive", $data);
                if (count($chatidsys->result()) != 0) {
                    $this->send($text, $chatidsys->row()->agentid,  $chatidsys->row()->opt_level, $chatid);
                } else {
                    $pesan = "/pembukaan";
                    $checktext = explode("_", $text);
                    // var_dump($checktext);
                    if ($checktext[0] == "registrasi") {
                        $check = $this->db->query("SELECT * FROM sys_user WHERE agentid='$checktext[1]'");
                        $check1 = $this->db->query("SELECT * FROM sys_user WHERE agentid='$checktext[1]' AND chat_id_telegram IS NOT NULL");
                        // $agentid = $check->row()->agentid;
                        if (count($check->result()) < 1) {
                            $pesan = "maaf data dengan agentid = '$checktext[1]' tidak ditemukan, silahkan hubungi IT";
                            $this->send_manual($pesan, '0', '0', $chatid);
                        } else if (count($check1->result()) > 1) {
                            $pesan = "maaf data dengan agentid = '$checktext[1]' telah digunakan, silahkan hubungi IT";
                            $this->send_manual($pesan, '0', '0', $chatid);
                        } else {
                            $data = array(
                                "chat_id_telegram" => "$chatid"
                            );
                            $this->db->set($data);
                            $this->db->where('agentid', $checktext[1]);
                            $this->db->update('sys_user');
                            $pesan = "registrasi berhasil dengan agentid = '$checktext[1]' ";
                            $this->send_manual($pesan, $checktext['1'], '0', $chatid);
                            $this->send('/help', $checktext['1'], '0', $chatid);
                        }
                    } else {
                        $this->send($pesan, '0', '0', $chatid);
                    }
                }
            }
        }
    }

    function get_pembukaan()
    {
        $query = $this->db->query("SELECT * FROM t_telegram_dictionary WHERE command = '/pembukaan'");
        if ($query->row() != null) {
            $data = $query->row();
        } else {
            $data = 0;
        }
        return $data;
    }

    function hitung_chatid($chatid, $text)
    {
        $query = $this->db->query("SELECT * FROM sys_user WHERE chat_id_telegram='$chatid'")->row();

        if ($query != null) {
            $data = array("chat_id_telegram" => $querys->row()->chat_id, "text" => "$text", "opt_level" => "$query->opt_level", "agentid" => "$query->agentid");
        } else {
            $data = 0;
        }

        return $data;
    }

    function send($pesan, $agentid, $opt_level, $chat_id)
    {
        //config
        $parameter = array();
        $botToken = "1412649509:AAFRJ4Dbe1KvNBR56qa0Y9nzZsxXuHRWdMU";
        $website = "https://api.telegram.org/bot" . $botToken;


        //get template
        $get_template = $this->get_template();
        if (isset($get_template[$pesan]['template'])) {

            if (isset($get_template[$pesan]['template'])) {
                $pesan = $get_template[$pesan]['template'];
            } else {
                $pesan = $get_template['/help']['template'];
            }
            if ($agentid != 0) {
                $pesan = 'Hallo, ' . $agentid . '|' . $pesan;
            }
            $parameter = array('chat_id' => $chat_id, 'text' => "$pesan", 'parse_mode' => 'HTML');

            $ch = curl_init($website . '/sendMessage');
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ($parameter));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
        } else {
            $pesan = $get_template['/help']['template'];
            $parameter = array('chat_id' => $chat_id, 'text' => "$pesan", 'parse_mode' => 'HTML');
            $ch = curl_init($website . '/sendMessage');
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ($parameter));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
        }

        $arraynya = json_decode($result);
        // var_dump($arraynya);

        $messageid = $arraynya->result->message_id;
        $fromid = $arraynya->result->from->id;
        $fromisbot = $arraynya->result->from->is_bot;
        $fromfirstname = $arraynya->result->from->first_name;
        $fromusername = $arraynya->result->from->username;
        $chatid = $arraynya->result->chat->id;
        $chatfirst_name = $arraynya->result->chat->first_name;
        $chatlast_name = $arraynya->result->chat->last_name;
        $chatusername = $arraynya->result->chat->username;
        $chattype = $arraynya->result->chat->type;
        $date = $arraynya->result->date;
        $text = $arraynya->result->text;

        $data = array(
            "messageid" => $messageid,
            "fromid" => $fromid,
            "fromisbot" => $fromisbot,
            "fromfirstname" => $fromfirstname,
            "fromusername" => $fromusername,
            "chatid" => $chatid,
            "chatfirst_name" => $chatfirst_name,
            "chatlast_name" => $chatlast_name,
            "chatusername" => $chatusername,
            "chattype" => $chattype,
            "date" => $date,
            "text" => $text
        );
        $this->db->insert("t_telegram_send", $data);
    }
    function send_manual($pesan, $agentid, $opt_level, $chat_id)
    {
        //config
        $parameter = array();
        $botToken = "1412649509:AAFRJ4Dbe1KvNBR56qa0Y9nzZsxXuHRWdMU";
        $website = "https://api.telegram.org/bot" . $botToken;


        //get template
        $parameter = array('chat_id' => $chat_id, 'text' => "$pesan", 'parse_mode' => 'HTML');
        $ch = curl_init($website . '/sendMessage');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($parameter));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);


        $arraynya = json_decode($result);
        // var_dump($arraynya);

        $messageid = $arraynya->result->message_id;
        $fromid = $arraynya->result->from->id;
        $fromisbot = $arraynya->result->from->is_bot;
        $fromfirstname = $arraynya->result->from->first_name;
        $fromusername = $arraynya->result->from->username;
        $chatid = $arraynya->result->chat->id;
        $chatfirst_name = $arraynya->result->chat->first_name;
        $chatlast_name = $arraynya->result->chat->last_name;
        $chatusername = $arraynya->result->chat->username;
        $chattype = $arraynya->result->chat->type;
        $date = $arraynya->result->date;
        $text = $arraynya->result->text;

        $data = array(
            "messageid" => $messageid,
            "fromid" => $fromid,
            "fromisbot" => $fromisbot,
            "fromfirstname" => $fromfirstname,
            "fromusername" => $fromusername,
            "chatid" => $chatid,
            "chatfirst_name" => $chatfirst_name,
            "chatlast_name" => $chatlast_name,
            "chatusername" => $chatusername,
            "chattype" => $chattype,
            "date" => $date,
            "text" => $text
        );
        $this->db->insert("t_telegram_send", $data);
    }

    function get_template()
    {
        $data = array();
        $query = $this->db->query("SELECT * FROM t_telegram_dictionary");

        foreach ($query->result() as $sa) {
            $data[$sa->command]['template'] = $sa->template;
        }
        return $data;
        // var_dump($data);
    }

    ////////////////cron cek data moss///////////
    function cek_datamoss()
    {
        $curdate = DATE("Y-m-d");
        $curdate_h = DATE("Y-m-d H:i:s");
        $cek_datamoss = $this->db->query("
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
	SUMBER <> 'TVV'
	AND UPDATE_BY <> 'SYS' 
	AND DATE( tgl_insert ) = '$curdate' 
	AND `status` IN ( '0', '3', NULL ) 
AND ( update_by IS NULL OR update_by = '' ) 
AND layanan <> 'TVV'
AND update_by <> 'SYS'
HAVING
	selisih > 3 
ORDER BY
	slg DESC")->result();
        // echo var_dump($cek_datamoss);
        if (count($cek_datamoss) > 0) {

            $chatidsys = $this->db->query("SELECT * FROM sys_user WHERE opt_level=9")->result();
            $listnointernet = "";
            foreach ($cek_datamoss as $listmoss) {
                $listnointernet = $listmoss->no_speedy . " | " . $listnointernet;
            }
            $pesan = "WARNING !!! CEK DATA MOSS, NO SPEEDY : ".$listnointernet. "telah lebih dari 3 MENIT";
            foreach($chatidsys as $listsend){
                $this->send($pesan, $listsend->agentid,  $listsend->opt_level, $listsend->chatid);
            }
            $hasil = "ada antrian";
           
        }else{
            $chatidsys = $this->db->query("SELECT * FROM sys_user WHERE opt_level=9")->result();
            
            $pesan = "INFORMATION, DATA MOSS AMAN (TIDAK ADA LEBIH DARI 3 MENIT)";
            foreach($chatidsys as $listsend){
                $this->send($pesan, $listsend->agentid,  $listsend->opt_level, $listsend->chatid);
            }
            $hasil = "gak ada antrian";
        }
        echo  $hasil;
    }
}
