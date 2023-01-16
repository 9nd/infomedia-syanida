<!-- START: Footer-->
    <footer class="site-footer">
        2020 © Sy-ANIDA
    </footer>
    <!-- END: Footer-->



    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
        <i class="icon-arrow-up"></i>
    </a>

    <!-- <script>
            "use strict";
            document.querySelector('.sweet-4').onclick = function(){
       swal({
         title: "Apa anda yakin?",
         type: "warning",
         showCancelButton: true,
         confirmButtonClass: 'btn-danger',
         confirmButtonText: 'Ya, hapus!',
         closeOnConfirm: false,
         //closeOnCancel: false
       },
       function(){
         swal("Deleted!", "Your imaginary file has been deleted!", "success");
       });
     };
       </script> -->

    <!-- START: Template JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- END: Template JS-->

    <!-- START: APP JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/app.js"></script>
    <!-- END: APP JS-->



    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.barfiller.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->

    <!---- START page datatable--->
    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page Script JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/datatable.script.js"></script>
    <!-- END: Page Script JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/sweetalert.script.js"></script>

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/chartjs-plugin-datalabels.min.js"></script>
    
    <script>
      // get all date input fields
        let dateInputs = document.querySelectorAll('[type="datetime-local"]');
        dateInputs.forEach(el => {
            // register double click event to change date input to text input and select the value
            el.addEventListener('dblclick', () => {
                el.type = "text";
                
                // After changing input type with JS .select() wont work as usual
                // Needs timeout fn() to make it work
                setTimeout(() => {
                  el.select();
                })
            });
            
            // register the focusout event to reset the input back to a date input field
            el.addEventListener('focusout', () => {
                el.type = "datetime-local";
            });
        });
  </script>

    <script type="text/javascript">
            $('#notifikasi').slideDown('slow').delay(2000).slideUp('slow');
        </script>
     <script type="text/javascript">
    $(document).ready(function () {
      $("#solusi").hide();
      
      $("#tidak").on("click",function(){
          $("#solusi").hide();
        });
      $("#tidak2").on("click",function(){
          $("#solusi").hide();
        });
       $("#ya").on("click",function(){
          $("#solusi").show();
        });
    });
  </script>

   <script type="text/javascript">
    $(document).ready(function () {
          $("#channel_available_label").hide();
          $("#channel_available").hide();
          $("#keterangan_label").hide();
          $("#keterangan").hide();
          $("#twitter_avail").hide();
          $("#facebook_avail").hide();
          $("#instagram_avail").hide();
          $("#whatsapp_avail").hide();
          $("#telegram_avail").hide();
          $("#twitter_label").hide();
          $("#facebook_label").hide();
          $("#instagram_label").hide();
          $("#whatsapp_label").hide();
          $("#telegram_label").hide();
          $("#twitter_label").hide();
          $("#input_twitter").hide();
          $("#facebook_input").hide();
          $("#status_tw").hide();
          $("#status_tw_label").hide();
          $("#facebook_input").hide();
          $("#status_fb").hide();
          $("#status_fb_label").hide();
          $("#ig").hide();
          $("#status_ig_label").hide();
          $("#status_ig").hide();
          $("#wa_kirim").hide();
          $("#wa_kirim_2").hide();
          $("#status_wa_label").hide();
          $("#status_wa").hide();
          $("#keterangan_label_telegram").hide();
          $("#keterangan_telegram").hide();
          // $("#email_label").hide();
          $("#status_email_label").hide();
          $("#status_email").hide();
          $("#channel_available_label_2").hide();
          $("#channel_available_2").hide();
          $("#keterangan_label_2").hide();
          $("#keterangan_2").hide();
          $("#twitter_avail_2").hide();
          $("#facebook_avail_2").hide();
          $("#instagram_avail_2").hide();
          $("#whatsapp_avail_2").hide();
          $("#telegram_avail_2").hide();
          $("#twitter_label_2").hide();
          $("#facebook_label_2").hide();
          $("#instagram_label_2").hide();
          $("#whatsapp_label_2").hide();
          $("#telegram_label_2").hide();
          $("#twitter_label_2").hide();
          $("#input_twitter_2").hide();
          $("#facebook_input_2").hide();
          $("#status_tw_2").hide();
          $("#status_tw_label_2").hide();
          $("#facebook_input_2").hide();
          $("#status_fb_2").hide();
          $("#status_fb_label_2").hide();
          $("#ig_2").hide();
          $("#status_ig_label_2").hide();
          $("#status_ig_2").hide();
          $("#wa_kirim").hide();
          $("#status_wa_label_2").hide();
          $("#status_wa_2").hide();
          $("#keterangan_label_telegram_2").hide();
          $("#keterangan_telegram_2").hide();
          $("#email_label").hide();
          $("#email_label_2").hide();
          $("#status_email_label_2").hide();
          $("#status_email_2").hide();
          $("#email_kirim").hide();
          $("#email_kirim_2").hide();

      
      $("#tidak").on("click",function(){
          $("#channel_available_label").hide();
          $("#channel_available").hide();
          $("#twitter_avail").hide();
          $("#facebook_avail").hide();
          $("#instagram_avail").hide();
          $("#whatsapp_avail").hide();
          $("#telegram_avail").hide();
          $("#twitter_label").hide();
          $("#facebook_label").hide();
          $("#instagram_label").hide();
          $("#whatsapp_label").hide();
          $("#telegram_label").hide();
          $("#twitter_label").hide();
          $("#input_twitter").hide();
          $("#keterangan_label").hide();
          $("#keterangan").hide();
          $("#status_tw").hide();
          $("#status_tw_label").hide();
          $("#facebook_input").hide();
          $("#status_fb").hide();
          $("#status_fb_label").hide();
          $("#ig").hide();
          $("#status_ig_label").hide();
          $("#status_ig").hide();
          $("#wa_kirim").hide();
          $("#status_wa_label").hide();
          $("#status_wa").hide();
          $("#keterangan_label_telegram").hide();
          $("#keterangan_telegram").hide();
          $("#email_label").hide();
          $("#status_email_label").hide();
          $("#status_email").hide();
          $("#email_kirim").hide();
        });

      $("#tidak2").on("click",function(){
          $("#channel_available_label_2").hide();
          $("#channel_available_2").hide();
          $("#keterangan_label_2").hide();
          $("#keterangan_2").hide();
          $("#twitter_avail_2").hide();
          $("#facebook_avail_2").hide();
          $("#instagram_avail_2").hide();
          $("#whatsapp_avail_2").hide();
          $("#telegram_avail_2").hide();
          $("#twitter_label_2").hide();
          $("#facebook_label_2").hide();
          $("#instagram_label_2").hide();
          $("#whatsapp_label_2").hide();
          $("#telegram_label_2").hide();
          $("#twitter_label_2").hide();
          $("#input_twitter_2").hide();
          $("#facebook_input_2").hide();
          $("#status_tw_2").hide();
          $("#status_tw_label_2").hide();
          $("#facebook_input_2").hide();
          $("#status_fb_2").hide();
          $("#status_fb_label_2").hide();
          $("#ig_2").hide();
          $("#status_ig_label_2").hide();
          $("#status_ig_2").hide();
          $("#wa_kirim").hide();
          $("#status_wa_label_2").hide();
          $("#status_wa_2").hide();
          $("#keterangan_label_telegram_2").hide();
          $("#keterangan_telegram_2").hide();
          $("#email_label_2").hide();
          $("#status_email_label_2").hide();
          $("#status_email_2").hide()
          $("#email_kirim_2").hide();
        });

       $("#ya").on("click",function(){
          $("#channel_available_label").show();
          $("#channel_available").show();
          $("#keterangan_label").show();
          $("#keterangan").show();
          $("#twitter_avail").show();
          $("#facebook_avail").show();
          $("#instagram_avail").show();
          $("#whatsapp_avail").show();
          $("#telegram_avail").show();
          $("#twitter_label").show();
          $("#facebook_label").show();
          $("#instagram_label").show();
          $("#whatsapp_label").show();
          $("#telegram_label").show();
          $("#twitter_label").show();
          $("#input_twitter").hide();
          $("#facebook_input").hide();
          $("#status_tw").hide();
          $("#status_tw_label").hide();
          $("#facebook_input").hide();
          $("#status_fb").hide();
          $("#status_fb_label").hide();
          $("#ig").hide();
          $("#status_ig_label").hide();
          $("#status_ig").hide();
          $("#wa_kirim").hide();
          $("#status_wa_label").hide();
          $("#status_wa").hide();
          $("#keterangan_label_telegram").hide();
          $("#keterangan_telegram").hide();
          $("#email_label").show();
          $("#status_email_label").show();
          $("#status_email").show();
          $("#email_kirim").show();
        });

       $("#ya2").on("click",function(){
          $("#channel_available_label_2").show();
          $("#channel_available_2").show();
          $("#keterangan_label_2").show();
          $("#keterangan_2").show();
          $("#twitter_avail_2").show();
          $("#facebook_avail_2").show();
          $("#instagram_avail_2").show();
          $("#whatsapp_avail_2").show();
          $("#telegram_avail_2").show();
          $("#twitter_label_2").show();
          $("#facebook_label_2").show();
          $("#instagram_label_2").show();
          $("#whatsapp_label_2").show();
          $("#telegram_label_2").show();
          $("#twitter_label_2").show();
          $("#input_twitter_2").hide();
          $("#facebook_input_2").hide();
          $("#status_tw_2").hide();
          $("#status_tw_label_2").hide();
          $("#facebook_input_2").hide();
          $("#status_fb_2").hide();
          $("#status_fb_label_2").hide();
          $("#ig_2").hide();
          $("#status_ig_label_2").hide();
          $("#status_ig_2").hide();
          $("#wa_kirim").hide();
          $("#status_wa_label_2").hide();
          $("#status_wa_2").hide();
          $("#keterangan_label_telegram_2").hide();
          $("#keterangan_telegram_2").hide();
          $("#email_label_2").show();
          $("#status_email_label_2").show();
          $("#status_email_2").show();
          $("#email_kirim_2").show();
        });

       $("#twitter_avail").on("click",function(){
          $("#channel_available_label").show();
          $("#channel_available").show();
          $("#keterangan_label").show();
          $("#keterangan").show();
          $("#twitter_avail").show();
          $("#facebook_avail").show();
          $("#instagram_avail").show();
          $("#whatsapp_avail").show();
          $("#telegram_avail").show();
          $("#twitter_label").show();
          $("#facebook_label").show();
          $("#instagram_label").show();
          $("#whatsapp_label").show();
          $("#telegram_label").show();
          $("#twitter_label").show();
          $("#input_twitter").show();
          $("#status_tw").show();
          $("#status_tw_label").show();
          $("#facebook_input").hide();
          $("#status_fb").hide();
          $("#status_fb_label").hide();
          $("#ig").hide();
          $("#status_ig_label").hide();
          $("#status_ig").hide();
          $("#wa_kirim").hide();
          $("#status_wa_label").hide();
          $("#status_wa").hide();
          $("#keterangan_label_telegram").hide();
          $("#keterangan_telegram").hide();
          $("#email_label").show();
          $("#status_email_label").show();
          $("#status_email").show();
          $("#email_kirim").show();

        });

       $("#twitter_avail_2").on("click",function(){
          $("#channel_available_label_2").show();
          $("#channel_available_2").show();
          $("#keterangan_label_2").show();
          $("#keterangan_2").show();
          $("#twitter_avail_2").show();
          $("#facebook_avail_2").show();
          $("#instagram_avail_2").show();
          $("#whatsapp_avail_2").show();
          $("#telegram_avail_2").show();
          $("#twitter_label_2").show();
          $("#facebook_label_2").show();
          $("#instagram_label_2").show();
          $("#whatsapp_label_2").show();
          $("#telegram_label_2").show();
          $("#twitter_label_2").show();
          $("#input_twitter_2").show();
          $("#facebook_input_2").hide();
          $("#status_tw_2").show();
          $("#status_tw_label_2").show();
          $("#facebook_input_2").hide();
          $("#status_fb_2").hide();
          $("#status_fb_label_2").hide();
          $("#ig_2").hide();
          $("#status_ig_label_2").hide();
          $("#status_ig_2").hide();
          $("#wa_kirim").hide();
          $("#status_wa_label_2").hide();
          $("#status_wa_2").hide();
          $("#keterangan_label_telegram_2").hide();
          $("#keterangan_telegram_2").hide();
          $("#email_label_2").show();
          $("#status_email_label_2").show();
          $("#status_email_2").show();
          $("#email_kirim_2").show();
        });

       $("#facebook_avail").on("click",function(){
          $("#channel_available_label").show();
          $("#channel_available").show();
          $("#keterangan_label").show();
          $("#keterangan").show();
          $("#twitter_avail").show();
          $("#facebook_avail").show();
          $("#instagram_avail").show();
          $("#whatsapp_avail").show();
          $("#telegram_avail").show();
          $("#twitter_label").show();
          $("#facebook_label").show();
          $("#instagram_label").show();
          $("#whatsapp_label").show();
          $("#telegram_label").show();
          $("#twitter_label").show();
          $("#input_twitter").hide();
          $("#status_tw").hide();
          $("#status_tw_label").hide();
          $("#facebook_input").show();
          $("#status_fb").show();
          $("#status_fb_label").show();
          $("#ig").hide();
          $("#status_ig_label").hide();
          $("#status_ig").hide();
          $("#wa_kirim").hide();
          $("#status_wa_label").hide();
          $("#status_wa").hide();
          $("#keterangan_label_telegram").hide();
          $("#keterangan_telegram").hide();
          $("#email_label").show();
          $("#status_email_label").show();
          $("#status_email").show();
          $("#email_kirim").show();
        });

    $("#facebook_avail_2").on("click",function(){
          $("#channel_available_label_2").show();
          $("#channel_available_2").show();
          $("#keterangan_label_2").show();
          $("#keterangan_2").show();
          $("#twitter_avail_2").show();
          $("#facebook_avail_2").show();
          $("#instagram_avail_2").show();
          $("#whatsapp_avail_2").show();
          $("#telegram_avail_2").show();
          $("#twitter_label_2").show();
          $("#facebook_label_2").show();
          $("#instagram_label_2").show();
          $("#whatsapp_label_2").show();
          $("#telegram_label_2").show();
          $("#twitter_label_2").show();
          $("#input_twitter_2").hide();
          $("#status_tw_2").hide();
          $("#status_tw_label_2").hide();
          $("#facebook_input_2").show();
          $("#status_fb_2").show();
          $("#status_fb_label_2").show();
          $("#ig_2").hide();
          $("#status_ig_label_2").hide();
          $("#status_ig_2").hide();
          $("#wa_kirim_2").hide();
          $("#status_wa_label_2").hide();
          $("#status_wa_2").hide();
          $("#keterangan_label_telegram_2").hide();
          $("#keterangan_telegram_2").hide();
          $("#email_label_2").show();
          $("#status_email_label_2").show();
          $("#status_email_2").show();
          $("#email_kirim_2").show();
        });

       $("#instagram_avail").on("click",function(){
          $("#channel_available_label").show();
          $("#channel_available").show();
          $("#keterangan_label").show();
          $("#keterangan").show();
          $("#twitter_avail").show();
          $("#facebook_avail").show();
          $("#instagram_avail").show();
          $("#whatsapp_avail").show();
          $("#telegram_avail").show();
          $("#twitter_label").show();
          $("#facebook_label").show();
          $("#instagram_label").show();
          $("#whatsapp_label").show();
          $("#telegram_label").show();
          $("#twitter_label").show();
          $("#input_twitter").hide();
          $("#status_tw").hide();
          $("#status_tw_label").hide();
          $("#facebook_input").hide();
          $("#status_fb").hide();
          $("#status_fb_label").hide();
          $("#ig").show();
          $("#status_ig_label").show();
          $("#status_ig").show();
          $("#wa_kirim").hide();
          $("#status_wa_label").hide();
          $("#status_wa").hide();
          $("#keterangan_label_telegram").hide();
          $("#keterangan_telegram").hide();
          $("#email_label").show();
          $("#status_email_label").show();
          $("#status_email").show();
          $("#email_kirim").show();
        });

       $("#instagram_avail_2").on("click",function(){
          $("#channel_available_label_2").show();
          $("#channel_available_2").show();
          $("#keterangan_label_2").show();
          $("#keterangan_2").show();
          $("#twitter_avail_2").show();
          $("#facebook_avail_2").show();
          $("#instagram_avail_2").show();
          $("#whatsapp_avail_2").show();
          $("#telegram_avail_2").show();
          $("#twitter_label_2").show();
          $("#facebook_label_2").show();
          $("#instagram_label_2").show();
          $("#whatsapp_label_2").show();
          $("#telegram_label_2").show();
          $("#twitter_label_2").show();
          $("#input_twitter_2").hide();
          $("#status_tw_2").hide();
          $("#status_tw_label_2").hide();
          $("#facebook_input_2").hide();
          $("#status_fb_2").hide();
          $("#status_fb_label_2").hide();
          $("#ig_2").show();
          $("#status_ig_label_2").show();
          $("#status_ig_2").show();
          $("#wa_kirim_2").hide();
          $("#status_wa_label_2").hide();
          $("#status_wa_2").hide();
          $("#keterangan_label_telegram_2").hide();
          $("#keterangan_telegram_2").hide();
          $("#email_label_2").show();
          $("#status_email_label_2").show();
          $("#status_email_2").show();
          $("#email_kirim_2").show();
        });

       $("#whatsapp_avail").on("click",function(){
          $("#channel_available_label").show();
          $("#channel_available").show();
          $("#keterangan_label").show();
          $("#keterangan").show();
          $("#twitter_avail").show();
          $("#facebook_avail").show();
          $("#instagram_avail").show();
          $("#whatsapp_avail").show();
          $("#telegram_avail").show();
          $("#twitter_label").show();
          $("#facebook_label").show();
          $("#instagram_label").show();
          $("#whatsapp_label").show();
          $("#telegram_label").show();
          $("#twitter_label").show();
          $("#input_twitter").hide();
          $("#status_tw").hide();
          $("#status_tw_label").hide();
          $("#facebook_input").hide();
          $("#status_fb").hide();
          $("#status_fb_label").hide();
          $("#ig").hide();
          $("#status_ig_label").hide();
          $("#status_ig").hide();
          $("#wa_kirim").show();
          $("#status_wa_label").show();
          $("#status_wa").show();
          $("#keterangan_label_telegram").hide();
          $("#keterangan_telegram").hide();
          $("#email_label").show();
          $("#status_email_label").show();
          $("#status_email").show();
          $("#email_kirim").show();
        });

       $("#whatsapp_avail_2").on("click",function(){
          $("#channel_available_label_2").show();
          $("#channel_available_2").show();
          $("#keterangan_label_2").show();
          $("#keterangan_2").show();
          $("#twitter_avail_2").show();
          $("#facebook_avail_2").show();
          $("#instagram_avail_2").show();
          $("#whatsapp_avail_2").show();
          $("#telegram_avail_2").show();
          $("#twitter_label_2").show();
          $("#facebook_label_2").show();
          $("#instagram_label_2").show();
          $("#whatsapp_label_2").show();
          $("#telegram_label_2").show();
          $("#twitter_label_2").show();
          $("#input_twitter_2").hide();
          $("#status_tw_2").hide();
          $("#status_tw_label_2").hide();
          $("#facebook_input_2").hide();
          $("#status_fb_2").hide();
          $("#status_fb_label_2").hide();
          $("#ig_2").hide();
          $("#status_ig_label_2").hide();
          $("#status_ig_2").hide();
          $("#wa_kirim_2").show();
          $("#status_wa_label_2").show();
          $("#status_wa_2").show();
          $("#keterangan_label_telegram_2").hide();
          $("#keterangan_telegram_2").hide();
          $("#email_label_2").show();
          $("#status_email_label_2").show();
          $("#status_email_2").show();
          $("#email_kirim_2").show();
        });

       $("#telegram_avail").on("click",function(){
          $("#channel_available_label").show();
          $("#channel_available").show();
          $("#keterangan_label").show();
          $("#keterangan").show();
          $("#twitter_avail").show();
          $("#facebook_avail").show();
          $("#instagram_avail").show();
          $("#whatsapp_avail").show();
          $("#telegram_avail").show();
          $("#twitter_label").show();
          $("#facebook_label").show();
          $("#instagram_label").show();
          $("#whatsapp_label").show();
          $("#telegram_label").show();
          $("#twitter_label").show();
          $("#input_twitter").hide();
          $("#status_tw").hide();
          $("#status_tw_label").hide();
          $("#facebook_input").hide();
          $("#status_fb").hide();
          $("#status_fb_label").hide();
          $("#ig").hide();
          $("#status_ig_label").hide();
          $("#status_ig").hide();
          $("#wa_kirim").hide();
          $("#status_wa_label").hide();
          $("#status_wa").hide();
          $("#keterangan_label_telegram").show();
          $("#keterangan_telegram").show();
          $("#email_label").show();
          $("#status_email_label").show();
          $("#status_email").show();
          $("#email_kirim").show();
        });

       $("#telegram_avail_2").on("click",function(){
          $("#channel_available_label_2").show();
          $("#channel_available_2").show();
          $("#keterangan_label_2").show();
          $("#keterangan_2").show();
          $("#twitter_avail_2").show();
          $("#facebook_avail_2").show();
          $("#instagram_avail_2").show();
          $("#whatsapp_avail_2").show();
          $("#telegram_avail_2").show();
          $("#twitter_label_2").show();
          $("#facebook_label_2").show();
          $("#instagram_label_2").show();
          $("#whatsapp_label_2").show();
          $("#telegram_label_2").show();
          $("#twitter_label_2").show();
          $("#input_twitter_2").hide();
          $("#status_tw_2").hide();
          $("#status_tw_label_2").hide();
          $("#facebook_input_2").hide();
          $("#status_fb_2").hide();
          $("#status_fb_label_2").hide();
          $("#ig_2").hide();
          $("#status_ig_label_2").hide();
          $("#status_ig_2").hide();
          $("#wa_kirim_2").hide();
          $("#status_wa_label_2").hide();
          $("#status_wa_2").hide();
          $("#keterangan_label_telegram_2").show();
          $("#keterangan_telegram_2").show();
          $("#email_label_2").show();
          $("#status_email_label_2").show();
          $("#status_email_2").show();
          $("#email_kirim_2").show();
        });

        $("#email_avail").on("click",function(){
          $("#channel_available_label").show();
          $("#channel_available").show();
          $("#keterangan_label").show();
          $("#keterangan").show();
          $("#twitter_avail").show();
          $("#facebook_avail").show();
          $("#instagram_avail").show();
          $("#whatsapp_avail").show();
          $("#telegram_avail").show();
          $("#twitter_label").show();
          $("#facebook_label").show();
          $("#instagram_label").show();
          $("#whatsapp_label").show();
          $("#telegram_label").show();
          $("#twitter_label").show();
          $("#input_twitter").hide();
          $("#status_tw").hide();
          $("#status_tw_label").hide();
          $("#facebook_input").hide();
          $("#status_fb").hide();
          $("#status_fb_label").hide();
          $("#ig").hide();
          $("#status_ig_label").hide();
          $("#status_ig").hide();
          $("#wa_kirim").hide();
          $("#status_wa_label").hide();
          $("#status_wa").hide();
          $("#keterangan_label_telegram").hide();
          $("#keterangan_telegram").hide();
          $("#email_label").show();
          $("#email_kirim").show();
          $("#status_email_label").show();
          $("#status_email").show();
        });

        $("#email_avail_2").on("click",function(){
          $("#channel_available_label_2").show();
          $("#channel_available_2").show();
          $("#keterangan_label_2").show();
          $("#keterangan_2").show();
          $("#twitter_avail_2").show();
          $("#facebook_avail_2").show();
          $("#instagram_avail_2").show();
          $("#whatsapp_avail_2").show();
          $("#telegram_avail_2").show();
          $("#twitter_label_2").show();
          $("#facebook_label_2").show();
          $("#instagram_label_2").show();
          $("#whatsapp_label_2").show();
          $("#telegram_label_2").show();
          $("#twitter_label_2").show();
          $("#input_twitter_2").hide();
          $("#status_tw_2").hide();
          $("#status_tw_label_2").hide();
          $("#facebook_input_2").hide();
          $("#status_fb_2").hide();
          $("#status_fb_label_2").hide();
          $("#ig_2").hide();
          $("#status_ig_label_2").hide();
          $("#status_ig_2").hide();
          $("#wa_kirim_2").hide();
          $("#status_wa_label_2").hide();
          $("#status_wa_2").hide();
          $("#keterangan_label_telegram_2").hide();
          $("#keterangan_telegram_2").hide();
          $("#email_label_2").show();
          $("#email_kirim_2").show();
          $("#status_email_label_2").show();
          $("#status_email_2").show();
        });
    });
  </script>

   <script type="text/javascript">
    $(document).ready( function () {
    $('#tbl_omnix').DataTable({
      rowReorder: {
            selector: 'td:nth-child(2)'
        },
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "aLengthMenu": [[10,40,80],[ 10,40,80]],
      <?php if ($optlevel != 8): ?>
          dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'pdf', 'print'
        ]
      <?php endif ?>
    });
});
</script>


</body>
<!-- END: Body-->

</html>