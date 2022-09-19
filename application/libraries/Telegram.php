<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Telegram
{

    function send_manual($pesan, $agentid, $opt_level, $chat_id)
    {
        //config
        $parameter = array();
        $botToken = "1676733678:AAH7rEX3xix1orXF88XEl-KO1ynskKT_v-Q";
        $website = "https://api.telegram.org/bot" . $botToken;

        // $pesannya = str_replace(str_split('(),;'), ' ', $pesan);
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
        $ci =   &get_instance(); 
        $ci->db->insert("t_telegram_send", $data);
    }
}
