<!DOCTYPE html>

<html dir="ltr" mozdisallowselectionprint moznomarginboxes>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="<?= base_url() . "assets/template/elearning/" ?>css/style.css">
</head>

<body>
    <script type="text/javascript">
        <?php
        if (!$belum) {
        ?>
            alert("Waktu Ujian Belum Dimulai");
            window.close();
        <?php
        }
        if (!$sudah) {
        ?>
            alert("Waktu Ujian Sudah Selesai");
            window.close();

        <?php
        }
        ?>

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
            var veri_upd = $("#veri_upd").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url() . "Pnp_agent/Pnp_agent/data_proses" ?>",
                data: "id_soal=" + id_soal + "&veri_upd=" + veri_upd,
                success: function(response) {
                    $("#data_proses").html(response);
                }
            });
        }

        function change_jawaban(jawaban) {
            var id_soal = $("#id_soal").val();
            var urutan = $("#urutan").val();
            var veri_upd = $("#veri_upd").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url() . "Pnp_agent/Pnp_agent/input_jawaban" ?>",
                data: "id_soal=" + id_soal + "&urutan=" + urutan + "&veri_upd=" + veri_upd + "&jawaban=" + jawaban,
                success: function() {

                }
            });
            data_proses();
            var urutan = $("#urutan").val();
            $(".jawaban_" + urutan).remove();
            $("#jawaban_" + urutan).attr("class", "done");
            $("<small class='jawaban_" + urutan + "'>" + jawaban + "</small>").appendTo("#urutan_" + urutan);
        }

        function change_duration(waktu_tersisa) {
            var id_soal = $("#id_soal").val();
            var urutan = $("#urutan").val();
            var veri_upd = $("#veri_upd").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url(). "Pnp_agent/Pnp_agent/change_duration" ?>",
                data: "waktu_tersisa=" + waktu_tersisa + "&id_soal=" + id_soal + "&veri_upd=" + veri_upd,
                success: function() {

                }
            });
        }
    </script>
    <div class="paper">
        <div id="viewerContainer">
            <div id="viewer" class="pdfViewer"></div>
        </div>
    </div>
    <div class="pane">
        <div class="pane-timer">
            <span id="hms"><?= $ujian_agent->waktu_tersisa ?></span>
        </div>
        <div class="pane-person">
            <img src="<?php echo base_url() . "YbsService/get_picture/" . $userdata->picture ?>">
            <span><?= $userdata->nama ?>
                <small>Agent Profiling</small>
            </span>
        </div>
        <div class="pane-answer">
            <ul>
                <input type="hidden" name="urutan" id="urutan">
                <input type="hidden" name="id_soal" id="id_soal" value="<?= $ujian->id ?>">
                <input type="hidden" name="veri_upd" id="veri_upd" value="<?= $userdata->agentid ?>">
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
                    if ($controller->jawaban_agent->get_count(array("veri_upd" => $userdata->agentid, "id_soal" => $ujian->id, "urutan" => $i)) > 0) {
                        $r = $controller->jawaban_agent->get_row(array("veri_upd" => $userdata->agentid, "id_soal" => $ujian->id, "urutan" => $i), array("*"));
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

        function count() {

            var startTime = document.getElementById('hms').innerHTML;
            if (startTime == "00:00:00" || startTime == "Invalid" || startTime > "<?= $controller->get_time_string_minute($ujian->durasi_waktu) ?>") {
                alert("waktu Anda Telah Habis.!");
                window.close();
            } else {
                var pieces = startTime.split(":");
                var time = new Date();
                time.setHours(pieces[0]);
                time.setMinutes(pieces[1]);
                time.setSeconds(pieces[2]);
                var timedif = new Date(time.valueOf() - 1000);
                var newtime = timedif.toTimeString().split(" ")[0];

                if (timeStringToFloat("<?= $ujian_agent->waktu_tersisa ?>") < timeStringToFloat(newtime)) {
                    newtime = "00:00:00";
                }
                change_duration(newtime);
                document.getElementById('hms').innerHTML = newtime;
                setTimeout(count, 1000);
            }

        }
        count();
        data_proses();
    </script>
</body>

</html>