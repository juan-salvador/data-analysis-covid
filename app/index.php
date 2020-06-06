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

  $chart_predictive = $class->get_predictive_week();
  $date_predictive = json_encode($chart_predictive['fecha']);
  $cases_predictive = json_encode($chart_predictive['predictivo']);

  $chart_three = $class->get_activecases_to_date();
  $active_dates = json_encode($chart_three['fecha']);
  $active_cases = json_encode($chart_three['casos_activos']);
  $diferencial_active_cases = json_encode($chart_three['diferencial']);

  $chart_four = $class->get_newcases_test_to_date();
  $four_date = json_encode($chart_four['fecha']);
  $four_new_cases = json_encode($chart_four['nuevos_casos']);
  $test_done = json_encode($chart_four['pruebas']);
  
  $chart_five = $class->get_newcases_vs_recovery();
  $five_date = json_encode($chart_five['fecha']);
  $five_new_cases = json_encode($chart_five['casos_nuevos']);
  $new_recovery = json_encode($chart_five['recuperados_nuevos']);

  $chart_test = $class->get_new_test_to_total_test();
  $date_general_test = json_encode($chart_test['fecha']);
  $new_general_test = json_encode($chart_test['nuevas_pruebas']);
  $all_test = json_encode($chart_test['total_pruebas']);

  $chart_six = $class->get_new_molecular_fast_test_to_date();
  $date_new_test = json_encode($chart_six['fecha']);
  $new_molecular_test = json_encode($chart_six['nuevas_pruebas_moleculares']);
  $new_fast_test = json_encode($chart_six['nuevas_pruebas_rapidas']);

  $chart_seven = $class->get_new_molecular_test_and_positive_molecular();
  $date_new_test_molecular = json_encode($chart_seven['fecha']);
  $all_new_molecular_test = json_encode($chart_seven['nuevas_pruebas_moleculares']);
  $all_new_positive_molecular = json_encode($chart_seven['nuevas_positivos_molecular']);

  $chart_eight = $class->get_new_fast_test_and_positive_fast();
  $date_new_test_fast = json_encode($chart_eight['fecha']);
  $all_new_fast_test = json_encode($chart_eight['nuevas_pruebas_rápidas']);
  $all_new_positive_fast = json_encode($chart_eight['nuevas_positivos_rápidas']);

?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Primary Meta Tags -->
    <title>Análisis Datos COVID en Perú</title>
    <meta name="title" content="Análisis Datos COVID en Perú">
    <meta name="description" content="Gráficos estadisticos con comparativos respecto al desarrollo del COVID en el Perú">
    <meta name="keywords" content="covid19, peru, covid en peru, covid peru"/>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://covidenperu.com/">
    <meta property="og:title" content="Análisis Datos COVID en Perú">
    <meta property="og:description" content="Gráficos estadisticos con comparativos respecto al desarrollo del COVID en el Perú">
    <meta property="og:image" content="http://covidenperu.com/splash.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://covidenperu.com/">
    <meta property="twitter:title" content="Análisis Datos COVID en Perú">
    <meta property="twitter:description" content="Gráficos estadisticos con comparativos respecto al desarrollo del COVID en el Perú">
    <meta property="twitter:image" content="http://covidenperu.com/splash.jpg">

    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">

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
    <title>Análisis Datos COVID en Perú</title>
  </head>
  <body style="background-color: #343a4e;">
    <div class="container">
        <h1 class="text-center font-weight-bold" style="color: white;">Análisis COVID 19</h1>
        <div class="alert alert-primary" role="alert">
            (*)Gráficos comparativos no incluyen días Lunes por ser días que menos pruebas se realizan
        </div>
        <div class="alert alert-danger" role="alert">
            Fuente: Minsa / Fechas: Mayo-Junio 2020
        </div>
    <div class="row row-cols-1 row-cols-md-1">
        <div class="col mb-4">
            <div class="card border-info">
            <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                Total de Casos Reportados: 191758 Casos
            </div>
            <div id="init" class="card-body" style="width:100%; height:400px;">
            </div></div>
        </div>
        <div class="col mb-4">
            <div class="card border-info">
            <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                Nuevos Casos vs Diferencial con día anterior(*) - 4358 Nuevos Casos Reportados
            </div>
            <div id="container" class="card-body" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card border-info">
                <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                    Promedio de Nuevos Casos por Semana
                </div>
                <div id="chart2" class="card-body" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card border-info">
                <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                    Estimado de Total de Casos en la Semana
                </div>
                <div id="chartPredictive" class="card-body" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card border-info">
                <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                    Casos Activos vs Diferencial con día anterior - 103726 Casos Activos
                </div>
                <div id="chart3" class="card-body" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card border-info">
                <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                    Casos Nuevos vs Pruebas Realizadas - 18535 Nuevas Pruebas Realizadas
                </div>
                <div id="chart4" class="card-body" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card border-info">
                <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                    Casos Nuevos vs Recuperados Nuevos - 3517 Recuperados Nuevos
                </div>
                <div id="chart5" class="card-body" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card border-info">
                <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                    Total de Pruebas y Nuevas Pruebas Realizadas - 1173003 Total de Pruebas Realizadas
                </div>
                <div id="chartTest" class="card-body" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card border-info">
                <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                    Nuevas Pruebas Moleculares y Nuevas Pruebas Rápidas
                </div>
                <div id="chart6" class="card-body" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card border-info">
                <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                    Nuevas Pruebas Moleculares y Nuevas Pruebas Moleculares Positivas
                </div>
                <div id="chart7" class="card-body" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card border-info">
                <div class="card-header text-center text-white font-weight-bold bg-info mb-3">
                    Nuevas Pruebas Rápidas y Nuevas Pruebas Rápidas Positivas
                </div>
                <div id="chart8" class="card-body" style="width:100%; height:400px;"></div>
            </div>
        </div>
    </div>
    </div>
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
        <div class="container text-center">
        <small>Copyright &copy; Juan Carlos Salvador Garcia</small>
        </div>
    </footer>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var initChart = Highcharts.chart('init', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title:{
                text: null
            },
            xAxis: {
                categories: <?php echo $all_week; ?>
            },
            series: [{
                name: 'Total Casos',
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
                text: ''
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
                text: ''
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

        var myChartPredictive = Highcharts.chart('chartPredictive', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: <?php echo $date_predictive; ?>
            },
            series: [{
                name: 'Estimado de Total de Casos',
                data: <?php echo $cases_predictive; ?>
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
                text: ''
            },
            xAxis: {
                categories: <?php echo $active_dates; ?>
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
                text: ''
            },
            xAxis: {
                categories: <?php echo $four_date; ?>
            },
            series: [{
                name: 'Casos Nuevos',
                data: <?php echo $four_new_cases; ?>
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
                text: ''
            },
            xAxis: {
                categories: <?php echo $five_date; ?>
            },
            series: [{
                name: 'Casos Nuevos',
                data: <?php echo $five_new_cases; ?>
            },{
                name: 'Recuperados Nuevos',
                data: <?php echo $new_recovery; ?>
            }],
            tooltip: {
              shared: true
            },
        });

        var myChartTest = Highcharts.chart('chartTest', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: <?php echo $date_general_test; ?>
            },
            series: [{
                name: 'Nuevas Pruebas Realizadas',
                data: <?php echo $new_general_test; ?>
            },{
                name: 'Total de Pruebas Realizadas',
                data: <?php echo $all_test; ?>
            }],
            tooltip: {
              shared: true
            },
        });

        var myChart6 = Highcharts.chart('chart6', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: <?php echo $date_new_test; ?>
            },
            series: [{
                name: 'Nuevas Pruebas Moleculares',
                data: <?php echo $new_molecular_test; ?>
            },{
                name: 'Nuevas Pruebas Rápidas',
                data: <?php echo $new_fast_test; ?>
            }],
            tooltip: {
              shared: true
            },
        });

        var myChart7 = Highcharts.chart('chart7', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: <?php echo $date_new_test_molecular; ?>
            },
            series: [{
                name: 'Nuevas Pruebas Moleculares',
                data: <?php echo $all_new_molecular_test; ?>
            },{
                name: 'Resultados Positivos',
                data: <?php echo $all_new_positive_molecular; ?>
            }],
            tooltip: {
              shared: true
            },
        });

        var myChart8 = Highcharts.chart('chart8', {
            chart: {
                type: 'line',
                zoomType: 'x'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: <?php echo $date_new_test_fast; ?>
            },
            series: [{
                name: 'Nuevas Pruebas Rápidas',
                data: <?php echo $all_new_fast_test; ?>
            },{
                name: 'Resultados Positivos',
                data: <?php echo $all_new_positive_fast; ?>
            }],
            tooltip: {
              shared: true
            },
        });
      });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>