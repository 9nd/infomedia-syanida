<?php


// $link = mysqli_connect("localhost", "root", "", "trans_profiling");
$link = mysqli_connect("10.194.51.88", "root", "", "infomedia_app");
$mysqli = new mysqli("10.194.51.88","root","","infomedia_app");
// $mysqli = new mysqli("localhost", "root", "", "trans_profiling");
// $updateid = $mysqli->query("SELECT * FROM t_telegram_receive");
// var_dump($updateid->fetch_array()['text']);


$botToken = "1412649509:AAFRJ4Dbe1KvNBR56qa0Y9nzZsxXuHRWdMU";

$website = "https://api.telegram.org/bot" . $botToken;

$ch = curl_init($website . '/getUpdates');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$arraynya = json_decode($result);
// $updateid = $mysqli->query("SELECT * FROM t_telegram_receive");
// var_dump($updateid->fetch_all());
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
    if (isset($datanya->message->from->language_code)) {
        $language_code = $datanya->message->from->language_code;
    } else {
        $language_code = "";
    }
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

    // $updateid = $this->db->query("SELECT * FROM t_telegram_receive WHERE update_id='$update_id'");
    $updateid = mysqli_query($link, "SELECT * FROM t_telegram_receive WHERE update_id='$update_id'");
    $chatidsys = mysqli_query($link, "SELECT * FROM sys_user WHERE chat_id_telegram='$chatid'");
    $rowcountchat = mysqli_num_rows($chatidsys);

    if (count($updateid->fetch_all()) == 0) {
        // $this->db->insert("t_telegram_receive", $data);


        $mysqli->query("INSERT INTO t_telegram_receive(update_id, messege_id, is_bot, first_name, last_name, username, language_code, chat_id, date, text) 
        VALUES('$update_id', '$message_id', '$is_bot', '$first_name', '$last_name', '$username', '$language_code', '$chatid', '$date', '$text')");



        // $chatidsys = mysqli_fetch_array($chatidsys);
        if ($rowcountchat != 0) {
            $fetch = mysqli_fetch_array($chatidsys);
            send($text, $fetch['agentid'],   $fetch['opt_level'], $chatid);
        } else {
            $pesan = "/pembukaan";
            $checktext = explode("#", $text);
          
            if (count($checktext) < 3) {
                $pesan = "Sepertinya anda belum ter-registrasi,
Untuk Registrasi ketik registrasi#AGENTID#password, 
contoh : registrasi#A00001#123jjhuf";
send_manual($pesan, '0', '0', $chatid);
            } else {
                $password = _generate($checktext[2]);
                if ($checktext[0] == "registrasi") {
                    $check = mysqli_query($link, "SELECT * FROM sys_user WHERE agentid='$checktext[1]' AND passuser='$password'");
                    $check1 = mysqli_query($link, "SELECT * FROM sys_user WHERE agentid='$checktext[1]' AND passuser='$password' AND chat_id_telegram IS NOT NULL");
                    // $agentid = $check->row()->agentid;
                    if (count($check->fetch_all()) < 1) {
                        $pesan = "maaf data dengan agentid = '$checktext[1]' tidak ditemukan, atau agentid & password yang anda inputkan salah
silahkan coba kembali";
                        send_manual($pesan, '0', '0', $chatid);
                    } else if (count($check1->fetch_all()) > 1) {
                        $pesan = "maaf data dengan agentid = '$checktext[1]' telah digunakan, 
silahkan hubungi IT";
                        send_manual($pesan, '0', '0', $chatid);
                    } else {

                        mysqli_query($link, "UPDATE sys_user SET chat_id_telegram='$chatid' WHERE agentid='$checktext[1]'");
                        $pesan = "registrasi berhasil dengan agentid = '$checktext[1]' ";
                        send_manual($pesan, $checktext['1'], '0', $chatid);
                        send('/help', $checktext['1'], '0', $chatid);
                    }
                } else {
                    send($pesan, '0', '0', $chatid);
                }
            }
        }
    }
}

function send($pesan, $agentid, $opt_level, $chat_id)
{

    // $mysqli = new mysqli("localhost", "root", "", "trans_profiling");
    $mysqli = new mysqli("10.194.51.88","root","","infomedia_app");

    //config
    $parameter = array();
    $botToken = "1412649509:AAFRJ4Dbe1KvNBR56qa0Y9nzZsxXuHRWdMU";
    $website = "https://api.telegram.org/bot" . $botToken;


    //get template
    $get_template = get_template();
    if (isset($get_template[$pesan]['template'])) {

        $pesan = $get_template[$pesan]['template'];
        if ($agentid != null) {
            $pesan = 'Hallo ' . $agentid . ',
' . $pesan;
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
        if ($agentid != null) {
            $pesan = 'Hallo ' . $agentid . ',
' . $pesan;
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
    if (isset($arraynya->result->chat->username)) {
        $chatusername = $arraynya->result->chat->username;
    } else {
        $chatusername = "";
    }

    $chattype = $arraynya->result->chat->type;
    $date = $arraynya->result->date;
    $text = $arraynya->result->text;


    $mysqli->query("INSERT INTO t_telegram_send(messageid, fromid, fromisbot, fromfirstname, fromusername, chatid, chatfirst_name, chatlast_name, chatusername, chattype, date, text) 
    VALUES('$messageid', '$fromid', '$fromisbot', '$fromfirstname', '$fromusername', '$chatid', '$chatfirst_name', '$chatlast_name', '$chatusername', '$chattype', '$date', '$text')");
}

function send_manual($pesan, $agentid, $opt_level, $chat_id)
{
    // $mysqli = new mysqli("localhost", "root", "", "trans_profiling");
    $mysqli = new mysqli("10.194.51.88","root","","infomedia_app");
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
    if (isset($arraynya->result->chat->username)) {
        $chatusername = $arraynya->result->chat->username;
    } else {
        $chatusername = "";
    }
    $chattype = $arraynya->result->chat->type;
    $date = $arraynya->result->date;
    $text = $arraynya->result->text;


    $mysqli->query("INSERT INTO t_telegram_send(messageid, fromid, fromisbot, fromfirstname, fromusername, chatid, chatfirst_name, chatlast_name, chatusername, chattype, date, text) 
    VALUES('$messageid', '$fromid', '$fromisbot', '$fromfirstname', '$fromusername', '$chatid', '$chatfirst_name', '$chatlast_name', '$chatusername', '$chattype', '$date', '$text')");
}



function get_pembukaan()
{
    // $mysqli = new mysqli("localhost", "root", "", "trans_profiling");
    $mysqli = new mysqli("10.194.51.88","root","","infomedia_app");

    $query = $mysqli->query("SELECT * FROM t_telegram_dictionary WHERE command = '/pembukaan'");
    if ($query->fetch_array() != null) {
        $data = $query->fetch_array();
    } else {
        $data = 0;
    }
    return $data;
}



function get_template()
{
    // $mysqli = new mysqli("localhost", "root", "", "trans_profiling");
    $mysqli = new mysqli("10.194.51.88","root","","infomedia_app");

    $data = array();
    $query = $mysqli->query("SELECT * FROM t_telegram_dictionary");
    while ($datas = mysqli_fetch_assoc($query)) {
        // echo $data['command']. "<br/>";
        $command = $datas['command'];
        $data['' . $command . '']['template'] = $datas['template'];
    }
    return $data;
}

function _generate($data = 'xseusgh')
{
    $f1 = sha1($data);
    $f2 = md5('dxmn' . $f1 . 'zdnhs');
    return $f2;
}
