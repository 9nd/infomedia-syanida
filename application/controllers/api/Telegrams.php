<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Telegrams extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Custom_model/Tahun_model', 'tahun');
        // $this->load->model('Absensi/Absensi_model', 't_absensi');
    }


    // function send($pesan, $chat_id)
    function send()
    {
        //config
        $botToken = "1412649509:AAFRJ4Dbe1KvNBR56qa0Y9nzZsxXuHRWdMU";


        $website = "https://api.telegram.org/bot" . $botToken;
        $chatId = '1214868605';  //** ===>>>NOTE: this chatId MUST be the chat_id of a person, NOT another bot chatId !!!**
        $params = [
            'chat_id' => '1214868605',
            'text' => 'test'
        ];
        // $params = [
        //     'chat_id' => $chatId,
        //     'text' => $pesan
        // ];
        //
        $ch = curl_init($website . '/sendMessage');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        // $data = array(
        //     'chat_id' => $chatId,
        //     'pesan' => $pesan,

        // );
        // $this->db->insert("t_telegram_send", $data);
    }
    function index(){
        echo "index";   
    }
    function get_update()
    {
        echo "halu";
        // $botToken = "1412649509:AAFRJ4Dbe1KvNBR56qa0Y9nzZsxXuHRWdMU";

        // $website = "https://api.telegram.org/bot" . $botToken;

        // $ch = curl_init($website . '/getUpdates');
        // curl_setopt($ch, CURLOPT_HEADER, false);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // $result = curl_exec($ch);
        // curl_close($ch);

        // $arraynya = json_decode($result);
        // echo $result;
        // var_dump($arraynya->result);
        
    }
}
