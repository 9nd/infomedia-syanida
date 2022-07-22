<?php
require __DIR__ . '/vendor/autoload.php';
//Reading data from spreadsheet.

$client = new \Google_Client();

$client->setApplicationName('Google Sheets and PHP');

$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);

$client->setAccessType('offline');

$client->setAuthConfig(__DIR__ . '/credentials.json');

// $service = new Google_Service_Sheets($client);
// // $spreadsheetId = "1Xa8Pq-c-fKdetQx0lxATZJ2Rz7hY8AdRuLdS42j13lw"; //It is present in your URL
// $spreadsheetId = "1d0mp4NM7ccifbHBDgd7YXHqZo0MPVycEecBqNCV3rn8"; //It is present in your URL

// $get_range = "FB Ads Suvarna!A1:Z10";

// $response = $service->spreadsheets_values->get($spreadsheetId, $get_range);

// $values = $response->getValues();
// echo "<table>";
// if (empty($values)) {
//     print "No data found.\n";
// } else {
//     // echo  "<tr><td>No</td><td> Nama</td><td>No.HP</td></tr>";
//     foreach ($values as $row) {
//         // Print columns A and E, which correspond to indices 0 and 4.
//         echo "<tr><td>".$row[0]."</td><td> ".$row[2]."</td><td>".$row[3]."</td></tr>\n";
//     }
// }
// echo "<table>";

$service = new Google_Service_Sheets($client);
// $spreadsheetId = "1Xa8Pq-c-fKdetQx0lxATZJ2Rz7hY8AdRuLdS42j13lw"; //It is present in your URL
$spreadsheetId = "1d0mp4NM7ccifbHBDgd7YXHqZo0MPVycEecBqNCV3rn8"; //It is present in your URL

$get_range = "FB Ads Suvarna!A1:Q10000";

$response = $service->spreadsheets_values->get($spreadsheetId, $get_range);

$values = $response->getValues();

if (empty($values)) {
    print "No data found.\n";
} else {
    
    foreach ($values as $row) {
        // Print columns A and E, which correspond to indices 0 and 4.
        if($row[0] != 0){
            echo $row[0];
        }
        
    }
}


// var_dump($values);
// $update_range = "A1";
// $values = [['asdasdssss']];
// $body = new Google_Service_Sheets_ValueRange([

//     'values' => $values

// ]);

// $params = [

//     'valueInputOption' => 'RAW'

// ];
// $update_sheet = $service->spreadsheets_values->update($spreadsheetId, $update_range, $body, $params);
