<?php
  require_once('data.php');
  $class = new Data();

  $chart_init = $class->get_total_cases();
  $all_week = json_encode($chart_init['fecha']);
  $all_cases = json_encode($chart_init['total_casos']);

  $chart_one = $class->get_newcases_to_date();
  $date = json_encode($chart_one['fecha']);
  $new_cases = json_encode($chart_one['casos_nuevos']);
  $diferencial_new_cases = json_encode($chart_one['diferencial']);

  $chart_two = $class->get_media_newcases_to_week();
  $week = json_encode($chart_two['semana']);
  $media_cases = json_encode($chart_two['media']);

  $chart_three = $class->get_activecases_to_date();
  $active_cases = json_encode($chart_three['casos_activos']);
  $diferencial_active_cases = json_encode($chart_three['diferencial']);

  $chart_four = $class->get_newcases_test_to_date();
  $test_done = json_encode($chart_four['pruebas']);
  
  $chart_five = $class->get_newcases_vs_recovery();
  $new_recovery = json_encode($chart_five['recuperados_nuevos']);

?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167533321-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-167533321-1');
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" src="/js/themes/gray.js"></script>
    <title>Análisis Datos COVID</title>
  </head>
  <body>
    <h1>Análisis COVID 19</h1>
    <h8>(*)Gráficos comparativos no incluyen días Lunes por ser días que menos pruebas se realizan</h4>
    <div id="init" style="width:100%; height:400px;"></div>
    <div id="container" style="width:100%; height:400px;"></div>
    <div id="chart2" style="width:100%; height:400px;"></div>
    <div id="chart3" style="width:100%; height:400px;"></div>
    <div id="chart4" style="width:100%; height:400px;"></div>
    <div id="chart5" style="width:100%; height:400px;"></div>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var initChart = Highcharts.chart('init', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: 'Total de Casos'
            },
            xAxis: {
                categories: <?php echo $all_week; ?>
            },
            series: [{
                name: 'Nuevos Casos',
                data: <?php echo $all_cases; ?>
            }],
            tooltip: {
              shared: true
            },
        });

        var myChart = Highcharts.chart('container', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: 'Nuevos Casos vs Diferencial con día anterior'
            },
            xAxis: {
                categories: <?php echo $date; ?>
            },
            series: [{
                name: 'Nuevos Casos',
                data: <?php echo $new_cases; ?>
            },{
                name: 'Diferencial día anterior',
                data: <?php echo $diferencial_new_cases; ?>
            }],
            tooltip: {
              shared: true
            },
        });

        var myChart2 = Highcharts.chart('chart2', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: 'Promedio de Nuevos Casos por Semana'
            },
            xAxis: {
                categories: <?php echo $week; ?>
            },
            series: [{
                name: 'Promedio Nuevos Casos',
                data: <?php echo $media_cases; ?>
            }],
            tooltip: {
              shared: true
            },
        });

        var myChart3 = Highcharts.chart('chart3', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: 'Casos Activos vs Diferencial con día anterior'
            },
            xAxis: {
                categories: <?php echo $date; ?>
            },
            series: [{
                name: 'Casos Activos',
                data: <?php echo $active_cases; ?>
            },{
                name: 'Diferencial día anterior',
                data: <?php echo $diferencial_active_cases; ?>
            }],
            tooltip: {
              shared: true
            },
        });

        var myChart4 = Highcharts.chart('chart4', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: 'Casos Nuevos vs Pruebas Realizadas'
            },
            xAxis: {
                categories: <?php echo $date; ?>
            },
            series: [{
                name: 'Casos Nuevos',
                data: <?php echo $new_cases; ?>
            },{
                name: 'Pruebas Realizadas',
                data: <?php echo $test_done; ?>
            }],
            tooltip: {
              shared: true
            },
        });

        var myChart5 = Highcharts.chart('chart5', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: 'Casos Nuevos vs Recuperados Nuevos'
            },
            xAxis: {
                categories: <?php echo $date; ?>
            },
            series: [{
                name: 'Casos Nuevos',
                data: <?php echo $new_cases; ?>
            },{
                name: 'Recuperados Nuevos',
                data: <?php echo $new_recovery; ?>
            }],
            tooltip: {
              shared: true
            },
        });
      });
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>