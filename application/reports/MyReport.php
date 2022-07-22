<?php
//MyReport.php
require APPPATH."/libraries/koolreport/autoload.php";
class MyReport extends \koolreport\KoolReport
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
                    "connectionString"=>"mysql:host=localhost;dbname=trans_profiling",
                    "username"=>"root",
                    "password"=>"",
                    "charset"=>"utf8"
                )
            )
        );
    }
    function setup()
    {
        $this->src('automaker')
        ->query("Select * from sys_user")
        ->pipe($this->dataStore("sys_user"));
    }
}