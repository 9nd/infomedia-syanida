<!DOCTYPE html>
<html dir="ltr" mozdisallowselectionprint moznomarginboxes>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="<?php echo base_url() . "assets/template/elearning/" ?>css/style.css">
</head>

<body>
    <script type="text/javascript">
        function get_jawaban(urutan) {
            $("#urutan").val(urutan);
            $("input[type='radio']").attr('checked', false);
            //                $('.jwbn').attr('checked', true)

            $(".active").removeClass("active");
            $("#jawaban_" + urutan).addClass("active");
            if ($('.jawaban_' + urutan).length) {
                var jwb = $('.jawaban_' + urutan).text();
                $('#jawaban_' + jwb).attr('checked', true);
                //                    $('#jawaban_' + jwb).addClass('active');
            }
        }

        function data_proses() {
            var id_soal = $("#id_soal").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url() . "Pnp/Pnp/data_proses" ?>",
                data: "id_soal=" + id_soal,
                success: function(response) {
                    $("#data_proses").html(response);
                }
            });
        }

        function change_jawaban(jawaban) {
            var id_soal = $("#id_soal").val();
            var urutan = $("#urutan").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url() . "Pnp/Pnp/input_jawaban" ?>",
                data: "id_soal=" + id_soal + "&urutan=" + urutan + "&jawaban=" + jawaban,
                success: function() {

                }
            });
            data_proses();
            var urutan = $("#urutan").val();
            $(".jawaban_" + urutan).remove();
            $("#jawaban_" + urutan).attr("class", "done");
            $("<small class='jawaban_" + urutan + "'>" + jawaban + "</small>").appendTo("#urutan_" + urutan);
        }
    </script>
    <div class="paper">
        <div id="viewerContainer">
            <div id="viewer" class="pdfViewer"></div>
        </div>
    </div>
    <div class="pane">
        <div class="pane-timer">
            <span id="hms"><?= $ujian->durasi_waktu ?></span>
        </div>
        <div class="pane-person">
            <span>
                <small><?php echo $ujian->judul ?></small>
            </span>
        </div>
        <div class="pane-answer">
            <ul>
                <input type="hidden" name="urutan" id="urutan">
                <input type="hidden" name="id_soal" id="id_soal" value="<?= $ujian->id ?>">
                <li>
                    <label onclick="change_jawaban('A')">
                        <input type="radio" id="jawaban_A" name="soal">
                        <span>A</span>
                    </label>
                </li>
                <li>
                    <label onclick="change_jawaban('B')">
                        <input type="radio" id="jawaban_B" name="soal">
                        <span>B</span>
                    </label>
                </li>
                <li>
                    <label onclick="change_jawaban('C')">
                        <input type="radio" id="jawaban_C" name="soal">
                        <span>C</span>
                    </label>
                </li>
                <li>
                    <label id="jawaban_d" onclick="change_jawaban('D')">
                        <input type="radio" id="jawaban_D" name="soal">
                        <span>D</span>
                    </label>
                </li>
                <li>
                    <label onclick="change_jawaban('E')">
                        <input type="radio" id="jawaban_E" name="soal">
                        <span>E</span>
                    </label>
                </li>
            </ul>
            <ol>
                <!--<li class="done"> <a href="#"><b>3<small>e</small></b></a></li>-->
                <!--<li> <a href="#"><b>1</b></a></li>-->
                <?php
                for ($i = 1; $i <= $ujian->jumlah_soal; $i++) {
                    if ($controller->jawaban_ujian->get_count(array("id_soal" => $ujian->id, "urutan" => $i)) > 0) {
                        $r = $controller->jawaban_ujian->get_row(array("id_soal" => $ujian->id, "urutan" => $i), array("*"));
                ?>
                        <li id="jawaban_<?= $i ?>" class="done"> <a href="#" onclick="get_jawaban(<?= $i ?>)"><b id="urutan_<?= $i ?>"><?= $i ?><small class='jawaban_<?= $i ?>'><?= $controller->conver_jawaban($r->jawaban) ?></small></b></a></li>
                    <?php
                    } else {
                    ?>
                        <li id="jawaban_<?= $i ?>"> <a href="#" onclick="get_jawaban(<?= $i ?>)"><b id="urutan_<?= $i ?>"><?= $i ?></b></a></li>
                <?php
                    }
                }
                ?>
            </ol>
        </div>
        <div id="data_proses">

        </div>
        <div class="pane-submit">
            <button type="button" onclick="window.close()">Selesai</button>
        </div>
    </div>
    <script src="<?= base_url() . "assets/template/elearning/" ?>js/jquery-1.11.3.min.js"></script>
    <script src="<?= base_url() . "assets/template/elearning/" ?>js/compatibility.js"></script>
    <script src="<?= base_url() . "assets/template/elearning/" ?>js/pdf.js"></script>
    <script src="<?= base_url() . "assets/template/elearning/" ?>js/pdf_viewer.js"></script>
    <script>
        var DEFAULT_URL = '<?= base_url() . "YbsService/get_pnp/" . $ujian->soal ?>';
        var container = document.getElementById('viewerContainer');
        var pdfLinkService = new PDFJS.PDFLinkService();
        var pdfViewer = new PDFJS.PDFViewer({
            container: container,
            linkService: pdfLinkService,
        });
        pdfLinkService.setViewer(pdfViewer);
        PDFJS.getDocument(DEFAULT_URL).then(function(pdfDocument) {
            pdfViewer.setDocument(pdfDocument);
            pdfLinkService.setDocument(pdfDocument, null);
        });
        container.addEventListener('pagesinit', function() {
            pdfViewer.currentScaleValue = 'page-fit';
        });
        container.addEventListener("pagesloaded", function(e) {
            console.log('lets do some !');
        });
        $('.pane-answer ol li a').click(function(e) {
            e.preventDefault();
            $('.pane-answer ol li a').parent().removeClass('active');
            $(this).parent().addClass('active');
            $('.pane-answer').addClass('take-option');
        });
        $('.pane-answer ul li label').click(function() {
            $('.pane-answer ol li a').parent().removeClass('active')
            $('.pane-answer').removeClass('take-option');
        });

        function timeStringToFloat(time) {
            var hoursMinutes = time.split(/[.:]/);
            var hours = parseInt(hoursMinutes[0], 10);
            var minutes = hoursMinutes[1] ? parseInt(hoursMinutes[1], 10) : 0;
            return hours + minutes / 60;
        }

        data_proses();
    </script>
</body>

</html>