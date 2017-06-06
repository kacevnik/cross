<?php
    include("inc/core.php");
    include("inc/report_constructor.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="kacevnik" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <?php include("views/top_include_css.view.php") ?>
    	<title>Японский кроссворд #<?=$crossData['id']?></title>
        <script>
            var cnt = <?php echo $top = str_replace('n', '\'n\'', $top_string); ?>; 
            var cnl = <?php echo $left = str_replace('n', '\'n\'', $left_string); ?>;
        </script>
    </head>
    <body>
<?php include("views/top.view.php") ?>
<?php include("views/header.view.php") ?>
<?php include("views/left.view.php") ?>
<?php include("views/report.view.php") ?>
<?php include("views/footer.view.php") ?>
    <script src="js/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/lib.js"></script>    
    <script src="js/lib2.js"></script>    
    <script src="js/script_report.js"></script>
    <script>
        $(function() {
            $.datepicker.regional['ru'] = { 
                closeText: 'Закрыть', 
                prevText: '&#x3c;Пред', 
                nextText: 'След&#x3e;', 
                currentText: 'Сегодня', 
                monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'], 
                monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'], 
                dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'], 
                dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'], 
                dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'], 
                dateFormat: 'yy-mm-dd', 
                firstDay: 1, 
                isRTL: false 
            };
            
            $.datepicker.setDefaults($.datepicker.regional['ru']); 
            $( "#cal_date" ).datepicker({onClose: function(dateText, inst) {}});
            });
    </script>    
    </body>
</html>