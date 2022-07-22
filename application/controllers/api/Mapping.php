<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mapping extends CI_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Custom_model/Dim_customer_useeprofile_model', 'Dim_customer_useeprofile');
        $this->load->model('Custom_model/Api_monitoring_model', 'Api_monitoring');
        // $this->load->database();
    }

    public function proses_mapping()
    {
        $datana = $this->Dim_customer_useeprofile->live_query("SELECT * FROM N_INDIHOME_202109301051 WHERE MAPPING = 0 LIMIT 150")->result();
        foreach ($datana as $dt) {
            $this->Dim_customer_useeprofile->live_query("UPDATE N_INDIHOME_202109301051 SET MAPPING=1 WHERE ND_SPEEDY = '$dt->ND_SPEEDY' ");
        }
        foreach ($datana as $dt) {
            $this->get_paket_pelanggan($dt->ND_SPEEDY);
        }
    }
    function get_token_telkom()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apigw.telkom.co.id:7777/invoke/pub.apigateway.oauth2/getAccessToken",
            // CURLOPT_URL => "https://apigwsit.telkom.co.id:7777/invoke/pub.apigateway.oauth2/getAccessToken",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>
            // '{
            //     "grant_type":"client_credentials",
            //     "client_id":"e43a7f6c-0377-4aad-be98-3f4bfad70424",
            //     "client_secret":"9df65a56-f426-4abc-82f9-cbe51477f155"
            //     }',
            '{
                    "grant_type":"client_credentials",
                    "client_id":"2d835cea-a851-4b04-8b84-1e0de64d94d0",
                    "client_secret":"08b57c55-c17c-4abb-89d1-1ccc89a2e9b3"
                    }',
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                'Content-Type: application/json',
                "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        return $response->access_token;
    }
    function get_paket_pelanggan($nd = '121604201088')
    {
        $curl = curl_init();
        $token = $this->get_token_telkom();
        curl_setopt_array($curl, array(
            // CURLOPT_URL => "https://apigwsit.telkom.co.id:7777/ws/telkom-moss-getUseeProfile/1.0/getUseeProfile",
            CURLOPT_URL => "https://apigw.telkom.co.id:7777/ws/telkom-moss-getUseeProfile/1.0/getUseeProfile",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "getUseeProfile": {
                "username": "' . $nd . '"
                }
            }
			',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                "cache-control: no-cache",
                'Content-Type: application/json',
                "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc",
                "Authorization: Bearer $token"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        // return $response;
        if (isset($response->getUseeProfileResponse->username)) {

            foreach ($response->getUseeProfileResponse->minipacks as $mpack) {
                $data_input = array(
                    "username" => $response->getUseeProfileResponse->username,
                    "useetype" => $response->getUseeProfileResponse->useetype,
                    "package" => $response->getUseeProfileResponse->package,
                    "numOfSTBs" => $response->getUseeProfileResponse->numOfSTBs,
                    "techname" => $mpack->techname,
                    "crmname" => $mpack->crmname,
                    // "prename" => $mpack->prename,
                    "promo" => $mpack->promo,
                    "status" => $mpack->status,
                    "bill" => $mpack->bill,
                    "last_update" => date('Y-m-d H:i:s')
                );

                $this->Dim_customer_useeprofile->add($data_input);
            }
        }
    }

    function get_tokensms()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://10.194.178.199/HERMES.1/Service/TokenRequest",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "username": "profiling_indihome_premium",
                "password": "ra3rar44r"
                }',
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                'Content-Type: application/json',
                "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        return $response->data->token;
    }
    function get_token_moss()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apigw.telkom.co.id:7777/invoke/pub.apigateway.oauth2/getAccessToken",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
				"grant_type":"client_credentials",
				"client_id":"432b96ed-00bc-40b8-ba28-29582561e35e",
				"client_secret":"8b27a24e-98d0-4dde-aaf4-c18bfe2dfe07"
				}',
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                'Content-Type: application/json',
                "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        return $response->access_token;
    }
    function monitoring_api()
    {
        $this->benchmark->mark('apigw_start');
        $token_apigw = $this->get_token_moss();
        $this->benchmark->mark('apigw_end');
        $durasi_apigw = $this->benchmark->elapsed_time('apigw_start', 'apigw_end');
        if ($token_apigw) {
            $cek = $this->Api_monitoring->live_query("select * FROM api_monitoring WHERE engine = 'API_MOSS' ORDER BY id DESC LIMIT 1")->row();
            if ($cek->status == 0) {
                $this->send_notif_engine("API_MOSS", "UP", $durasi_apigw, "UPDATE STATUS ENGINE");
            }
            $data_input = array(
                "lastupdate" => DATE('Y-m-d H:i:s'),
                "engine" => "API_MOSS",
                "status" => 1,
                "time" => $durasi_apigw
            );
            $this->Api_monitoring->add($data_input);
        } else {
            $data_input = array(
                "lastupdate" => DATE('Y-m-d H:i:s'),
                "engine" => "API_MOSS",
                "status" => 0,
                "time" => $durasi_apigw
            );
            $this->Api_monitoring->add($data_input);
            $this->send_notif_engine("API_MOSS", "DOWN", $durasi_apigw);
        }

        $this->benchmark->mark('sms_start');
        $token_sms = $this->get_tokensms();
        $this->benchmark->mark('sms_end');
        $durasi_sms = $this->benchmark->elapsed_time('sms_start', 'sms_end');
        if ($token_sms) {
            $cek = $this->Api_monitoring->live_query("select * FROM api_monitoring WHERE engine = 'API_SMS_TURBO' ORDER BY id DESC LIMIT 1")->row();
            if ($cek->status == 0) {
                if (intval($cek->time) > 10) {
                    $this->send_notif_engine("API_SMS_TURBO", "DOWN", $durasi_sms);
                }
                $this->send_notif_engine("API_SMS_TURBO", "UP", $durasi_sms, "UPDATE STATUS ENGINE");
            }
            $data_input = array(
                "lastupdate" => DATE('Y-m-d H:i:s'),
                "engine" => "API_SMS_TURBO",
                "status" => 1,
                "time" => $durasi_sms
            );
            $this->Api_monitoring->add($data_input);
        } else {
            $data_input = array(
                "lastupdate" => DATE('Y-m-d H:i:s'),
                "engine" => "API_SMS_TURBO",
                "status" => 0,
                "time" => $durasi_sms
            );
            $this->Api_monitoring->add($data_input);
            if (intval($durasi_sms) > 10) {
                $this->send_notif_engine("API_SMS_TURBO", "DOWN", $durasi_sms);
            }
        }
    }
    function send_notif_engine($engine = "API_SMS_TURBO", $status = "DOWN", $execution_time = "9", $info = "WARNING!!! ")
    {

        $pesan = "<b>" . $info . "</b>
<b>Message From Engine Monitoring Sy-anida</b> 
Engine : " . $engine . "
Status : <b color='red'>" . $status . "</b>
Execution Time : " . $execution_time . "
        ";
        //config
        $parameter = array();
        $botToken = "1676733678:AAH7rEX3xix1orXF88XEl-KO1ynskKT_v-Q";
        $website = "https://api.telegram.org/bot" . $botToken;

        $user_getnotif = $this->Api_monitoring->live_query("select * FROM sys_user WHERE chat_id_telegram IS NOT NULL AND (opt_level = 1 OR opt_level = 7)")->result();
        if (count($user_getnotif) > 0) {
            foreach ($user_getnotif as $ur) {
                $id_telegram = $ur->chat_id_telegram;
                $parameter = array('chat_id' => $id_telegram, 'text' => "$pesan", 'parse_mode' => 'HTML');

                $ch = curl_init($website . '/sendMessage');
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ($parameter));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);
            }
        }
    }
}
