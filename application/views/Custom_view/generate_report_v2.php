<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta http-equiv="refresh" content="300">
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>INFOMEDIA</title>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/sipanda/images/logo_profiling.png">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/sipanda/page_loading/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/sipanda/page_loading/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/sipanda/page_loading/css/component.css" />
        <script src="<?php echo base_url() ?>assets/sipanda/page_loading/js/modernizr.custom.js"></script>
    </head>
    <body>
        <!-- Divisions for loading effects -->
        <div class="la-anim-10 la-animate"></div>
        <!-- main container -->
        <div class="container">
            <header>
                <img src="<?php echo base_url() ?>/assets/sipanda/images/logo_profiling.png" style="width: 300px;">

            </header>
            <div class="main">
                <h1 style="text-align: center;">Sedang melakukan penarikan data Profiling, <br>Mohon untuk tidak menutup aplikasi ini.</h1>
            </div><!-- /main -->
        </div><!-- /container -->
        <script src="<?php echo base_url() ?>assets/sipanda/page_loading/js/classie.js"></script>
        <script>
            var loader = document.getElementById('la-anim-6-loader')
                    , border = document.getElementById('la-anim-6-border')
                    , α = 0
                    , π = Math.PI
                    , t = 15

                    , tdraw;

            function PieDraw() {
                α++;
                α %= 360;
                var r = (α * π / 180)
                        , x = Math.sin(r) * 250
                        , y = Math.cos(r) * -250
                        , mid = (α > 180) ? 1 : 0
                        , anim = 'M 0 0 v -250 A 250 250 1 '
                        + mid + ' 1 '
                        + x + ' '
                        + y + ' z';

                loader.setAttribute('d', anim);
                border.setAttribute('d', anim);
                if (α != 0)
                    tdraw = setTimeout(PieDraw, t); // Redraw
            }

            function PieReset() {
                clearTimeout(tdraw);
                var anim = 'M 0 0 v -250 A 250 250 1 0 1 0 -250 z';
                loader.setAttribute('d', anim);
                border.setAttribute('d', anim);
            }

            var inProgress = false;

            Array.prototype.slice.call(document.querySelectorAll('#la-buttons > button')).forEach(function (el, i) {
                var anim = el.getAttribute('data-anim'),
                        animEl = document.querySelector('.' + anim);

                el.addEventListener('click', function () {
                    if (inProgress)
                        return false;
                    inProgress = true;
                    classie.add(animEl, 'la-animate');

                    if (anim === 'la-anim-6') {
                        PieDraw();
                    }

                    setTimeout(function () {
                        classie.remove(animEl, 'la-animate');

                        if (anim === 'la-anim-6') {
                            PieReset();
                        }

                        inProgress = false;
                    }, 6000);
                });
            });
        </script>
        <script src="<?php echo base_url(); ?>assets/sipanda/js/libs/jquery-1.11.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/sipanda/js/libs/jquery-ui-1.10.4.min.js"></script>
    </body>
</html>

<?php

//echo "Absensi Berhasil Diupdate. <a href='" . base_url() . "'>Kembali</a>";
//$com1 = "select * from ";
//$res1 = $connection->query($com1);
//while ($row1 = $res1->fetch()) {
//    echo $row1['ID'] . "-" . $row1['Finger'] . "-" . $row1['FingerData'] . "<br/>";
//}
/* End of file update.php */
/* Location: ./view/update.php */

/* * ******************************************************************************

  Copyright (C) 2013-2014 by Ahmad Sadikin
  Krusaderin Core v2.0
 *
 * update.php

  Pembuat : Ahmad Sadikin
  E-mail  : lucky_kungpow@yahoo.com
 * Create Date : Dec 30, 2014, 2:49:00 PM
 * ****************************************************************************** */
?>