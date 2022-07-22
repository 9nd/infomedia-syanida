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
        Table::create(array(
            "dataStore"=>$this->dataStore("sys_user")->filter("kategori","=","REG"),
            "class"=>array(
                "table"=>"table table-hover"
            )
        ));
        ?>
    </body>
</html>