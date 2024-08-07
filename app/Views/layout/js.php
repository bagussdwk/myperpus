<!-- jQuery -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $(function() {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
        var areaChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'User Registration',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: []
            }, ]
        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })

        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            // labels: [
            //     'Chrome',
            //     'IE',
            //     'FireFox',
            //     'Safari',
            //     'Opera',
            //     'Navigator',
            // ],
            datasets: [{
                data: [700, 500, 400, 600, 300, 100],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    })

    $(document).ready(function() {
        $('#table1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    $(document).ready(function() {
        $(document).on('click', '#pilihbuku', function() {
            var id = $(this).data('id');
            var kode_buku = $(this).data('kode_buku');
            var pengarang = $(this).data('pengarang');
            var judul = $(this).data('judul');
            var jumlah_stok = $(this).data('jumlah_stok');
            $('#id').val(id);
            $('#kode_buku').val(kode_buku);
            $('#pengarang').val(pengarang);
            $('#judul').val(judul);
            $('#jumlah_stok').val(jumlah_stok);
            $('#modal-buku').modal('hide');
        });
    });
</script>

<script>
    $.widget.bridge('uibutton', $.ui.button);

    $(document).ready(function() {
        $('.nav-toggle').click(function() {
            var collapse_content_selector = $(this).attr('href');
            var toggle_switch = $(this);
            $(collapse_content_selector).toggle(function() {
                if ($(this).css('display') == 'none') {
                    toggle_switch.html('Read More');
                } else {
                    toggle_switch.html('Read Less');
                }
            });
        });

    });

    function previewImg() {
        const userImage = document.querySelector('#user_image');
        const userImageLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        userImageLabel.textContent = userImage.files[0].name;

        const userImageFile = new FileReader();
        userImageFile.readAsDataURL(userImage.files[0]);

        userImageFile.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewCover() {
        const gambar = document.querySelector('#gambar');
        const gambarLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        gambarLabel.textContent = gambar.files[0].name;

        const gambarFile = new FileReader();
        gambarFile.readAsDataURL(gambar.files[0]);

        gambarFile.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/AdminLTE/'); ?>dist/js/adminlte.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/AdminLTE/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>