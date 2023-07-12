            <div id="offline-status"></div>
           <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <?= date('Y') ?> <a target="_blank" class="link color-primary" href="https://foietjoie-haiti.org/">FOI ET JOIE HAITI</a>, Tous droits résévés.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Version <?php echo $this->customlib->getAppVersion(); ?>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>backend/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/assets/js/app.js"></script>
   
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?php echo base_url(); ?>backend/assets/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/highlight/highlight.pack.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/notification/snackbar/snackbar.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<?php if(isset($page) && $page == 'Rapport'): ?>
    <script src="<?php echo base_url(); ?>backend/plugins/apex/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/assets/js/dashboard/dash_2.js"></script>
<?php endif; if(isset($page) && $page == 'list'): ?>
    <script src="<?php echo base_url(); ?>backend/plugins/table/datatable/datatables.js"></script>
<?php if(isset($table) && $table == 'html'): ?>
    <script src="<?php echo base_url(); ?>backend/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="<?php echo base_url(); ?>backend/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
     <script>
        $('#html5-extension').DataTable( {
            "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn btn-sm' },
                    { extend: 'csv', className: 'btn btn-sm' },
                    { extend: 'excel', className: 'btn btn-sm' },
                    { extend: 'print', className: 'btn btn-sm' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Rechercher...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 50, 50],
            "pageLength": 10 
        } );
    </script>
<?php endif; if(isset($table) && $table == 'style'): ?>
<script>
     c2 = $('#style-2').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Rechercher...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5 
        });
        multiCheck(c2);
    </script>
<?php endif; ?>
<?php endif; if(isset($page) && $page == 'form'): ?>
    <script src="<?php echo base_url(); ?>backend/assets/js/scrollspyNav.js"></script>
    <script src="<?php echo base_url(); ?>backend/assets/js/forms/bootstrap_validation/bs_validation_script.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/input-mask/input-mask.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <?php if (isset($date) && $date == 'date'):?>
        <script src="<?php echo base_url(); ?>backend/plugins/flatpickr/flatpickr.js"></script>
        <script>let d = flatpickr(document.getElementById('dob'));</script>
    <?php endif; ?>

    <script>
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
        }, false);
    </script>
<?php if(isset($file) && $file == 'file'): ?>
    <script src="<?php echo base_url(); ?>backend/plugins/file-upload/file-upload-with-preview.min.js"></script>
     <script src="<?php echo base_url(); ?>backend/plugins/editors/markdown/simplemde.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/editors/markdown/custom-markdown.js"></script>
    <script>
        new SimpleMDE({
            element: document.getElementById("description"),
            spellChecker: false,
            autosave: {
                enabled: false,
                unique_id: "description",
            },
        });
    </script>
<?php endif; ?>

<?php endif; if(isset($page) && $page == 'viewcourse'): ?>
    <script src="//vjs.zencdn.net/7.10.2/video.min.js"></script>
    <script>
      var player = videojs('#my-player');
        var options = {};
        var player = videojs('#my-player', options, function onPlayerReady() {
          videojs.log('Your player is ready!');
          this.play();
          this.on('ended', function() {
            videojs.log('Awww...over so soon?!');
          });
        });
    </script>
<?php endif; if(isset($page) && $page == 'sendmessage'): ?>
    <script src="<?php echo base_url(); ?>backend/assets/js/apps/mailbox-chat.js"></script>
<?php endif; ?>

<script src="<?php echo base_url(); ?>backend/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>backend/assets/js/jsadmin.js"></script>
<script language="JavaScript">
    $(document).ready(function() {
        let Maintenant = new Date();
        let heures = Maintenant.getHours();
        let minutes = Maintenant.getMinutes();
        let secondes = Maintenant.getSeconds();
        heures = ((heures < 10) ? " 0" : " ") + heures;
        minutes = ((minutes < 10) ? ":0" : ":") + minutes;
        secondes = ((secondes < 10) ? ":0" : ":") + secondes;
        let h = $('#horloge').html(heures + minutes + secondes);
        // setTimeout(h, 1000);  
    });
</script>

</body>
</html>
