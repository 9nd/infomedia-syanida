<?php
//MyReport.php
require APPPATH."/libraries/koolreport/autoload.php";
class Wallboard_reguler extends \koolreport\KoolReport
{
    use \koolreport\clients\Bootstrap;
    function settings()
    {
        return array(
            "assets"=>array(
                "path"=>"../../assets",
                "url"=>"assets",
            ),
            "dataSources"=>array(
                "automaker"=>array(
                    "connectionString"=>"mysql:host=10.194.194.61;dbname=db_profiling",
                    "username"=>"ayu",
                    "password"=>"ayu123",
                    "charset"=>"utf8"
                )
            )
        );
    }
    function setup()
    {
        $this->src('automaker')
        ->query("Select * from trans_profiling where DATE(lup) = '20200326' ")
        ->pipe($this->dataStore("trans_profiling"));
    }
}