<?php
    //MyReport.view.php
    use \koolreport\widgets\koolphp\Table;
?>
<html>
    <head>
        <title>MyReport</title></title>
    </head>
    <body>
        <h1>MyReport</h1>
        <h3>List all offices</h3>
        <?php
        echo $this->dataStore("trans_profiling")->filter("veri_call","=","13")->count();
        // Table::create(array(
        //     "dataStore"=>$this->dataStore("trans_profiling")->filter("veri_call","=","13"),
        //     "class"=>array(
        //         "table"=>"table table-hover"
        //     )
        // ));
        ?>
    </body>
</html>