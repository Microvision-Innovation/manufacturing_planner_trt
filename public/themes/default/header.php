<?php

Assets::add_css(array( 'lib/fontawesome-free/css/all.min.css','lib/ionicons/css/ionicons.min.css','lib/typicons.font/typicons.css','lib/fullcalendar/fullcalendar.min.css','lib/morris.js/morris.css','lib/datatables.net-dt/css/jquery.dataTables.min.css','lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css','lib/select2/css/select2.min.css','lib/lightslider/css/lightslider.min.css','lib/line-awesome/css/line-awesome.min.css','lib/quill/quill.snow.css','lib/quill/quill.bubble.css','css/azia.css'));

Assets::add_js(array('lib/moment/min/moment.min.js','lib/jquery-ui/ui/widgets/datepicker.js','lib/bootstrap/js/bootstrap.bundle.min.js','lib/ionicons/ionicons.js','lib/fullcalendar/fullcalendar.min.js','lib/select2/js/select2.full.min.js','js/azia.js','js/app-calendar-events.js','js/app-calendar.js','ajax_req.js'));
//Assets::add_js(array('lib/bootstrap/js/bootstrap.bundle.min.js','lib/ionicons/ionicons.js','lib/datatables.net/js/jquery.dataTables.min.js','lib/datatables.net-dt/js/dataTables.dataTables.min.js','lib/datatables.net-responsive/js/dataTables.responsive.min.js','lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js','lib/select2/js/select2.min.js','lib/jquery.maskedinput/jquery.maskedinput.js','lib/jquery-steps/jquery.steps.min.js','lib/fullcalendar/fullcalendar.min.js','js/app-calendar-events.js','js/app-calendar.js','lib/parsleyjs/parsley.min.js','js/azia.js','ajax_req.js'));

//$inline  = '$(".dropdown-toggle").dropdown();';
//$inline .= '$(".tooltips").tooltip();';
//Assets::add_js($inline, 'inline');

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="TRT Manufacturing Planner">
    <meta name="author" content="Edwin Ombego, ombego@gmail.com">

    <title>TRT Planner <?php echo (ISSET($page_title))?" | ".$page_title:""; ?></title>

    <!-- css files -->
    <link rel="icon" href="<?php echo Template::theme_url('images/favicon.ico');?>" type="image/x-icon" />
    <?php echo Assets::css(); ?>

    <script src='<?php echo Template::theme_url('lib/jquery/jquery.min.js'); ?>'></script>
    <script src="<?php echo Template::theme_url('js/jquery_excel.js');?>"></script>
    <script >
        $(document).ready(function() {
            $("#btnExport").click(function(e) {
                e.preventDefault();

                //getting data from our table
                var data_type = 'data:application/vnd.ms-excel';
                var table_div = document.getElementById('table_wrapper');
                var table_html = table_div.outerHTML.replace(/ /g, ' ');
                var csvData = new Blob([table_html], { type: 'application/vnd.ms-excel' });
                var csvUrl = URL.createObjectURL(csvData);

                var a = document.createElement('a');
                document.body.appendChild(a);
                a.href = csvUrl;
                //a.href = data_type + ', ' + table_html;
                a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
                a.click();
            });
            $("#btndataExport").click(function(e) {
                e.preventDefault();

                //getting data from our table
                var data_type = 'data:application/vnd.ms-excel';
                var table_div = document.getElementById('datatable1');
                var table_html = table_div.outerHTML.replace(/ /g, ' ');
                var csvData = new Blob([table_html], { type: 'application/vnd.ms-excel' });
                var csvUrl = URL.createObjectURL(csvData);

                var a = document.createElement('a');
                document.body.appendChild(a);
                a.href = csvUrl;
                //a.href = data_type + ', ' + table_html;
                a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
                a.click();
            });
            $("#btndataExport2").click(function(e) {
                e.preventDefault();

                //getting data from our table
                var data_type = 'data:application/vnd.ms-excel';
                var table_div = document.getElementById('datatable2');
                var table_html = table_div.outerHTML.replace(/ /g, ' ');
                var csvData = new Blob([table_html], { type: 'application/vnd.ms-excel' });
                var csvUrl = URL.createObjectURL(csvData);

                var a = document.createElement('a');
                document.body.appendChild(a);
                a.href = csvUrl;
                //a.href = data_type + ', ' + table_html;
                a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
                a.click();
            });
        });

//   quick printing feature
        function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
        }

        function popitup2(url) {
            //submits the form
            //document.getElementById("order_comments").submit();
            //Opening the window that prints the order

            newwindow=window.open(url,'name','height=540,width=1000,top=50,left=250');
            if (window.focus) {newwindow.focus()}
            return false;
        }
    </script>

</head>
<body class="az-light az-body">
