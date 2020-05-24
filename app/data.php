<?php
require_once('csv.php');
class Data{

    private $data = [];

    function __construct(){
        $class = new CSV();
        $this->data = $class->load_data();
    }

    public function get_total_cases($to_day=FALSE){
        $total = ['fecha'=>[], 'total_casos'=>[]];
        $count = count($this->data);
        $total_to_day = [];
        if($to_day){
            for($i=0; $i<$count; $i++){
                if($i==0){ continue;}
                $total_to_day[$this->data[$i][3]] = (int)$this->data[$i][8];
            }
            return $total_to_day;
        }

        for($i=0; $i<$count; $i++){
            if($i==0){ continue;}
            array_push($total['fecha'], $this->data[$i][3]);
            array_push($total['total_casos'], (int)$this->data[$i][8]);
        }
        return $total;
    }

    public function get_newcases_to_date(){
        $new_cases = ['fecha'=>[], 'casos_nuevos'=>[], 'diferencial'=>[]];
        $count = count($this->data);

        for($i=0; $i<$count; $i++){
            if($i==0 || $this->data[$i][2] =='lunes'){ continue;}
            array_push($new_cases['fecha'], $this->data[$i][3]);
            array_push($new_cases['casos_nuevos'], (int)$this->data[$i][6]);
            array_push($new_cases['diferencial'], (int)$this->data[$i][7]);
        }
        return $new_cases;
    }

    public function get_newcases_vs_recovery(){
        $new_cases = ['fecha'=>[], 'casos_nuevos'=>[], 'recuperados_nuevos'=>[]];
        $count = count($this->data);

        for($i=0; $i<$count; $i++){
            if($i==0 || $this->data[$i][2] =='lunes'){ continue;}
            array_push($new_cases['fecha'], $this->data[$i][3]);
            array_push($new_cases['casos_nuevos'], (int)$this->data[$i][6]);
            array_push($new_cases['recuperados_nuevos'], (int)$this->data[$i][9]);
        }
        return $new_cases;
    }

    public function get_activecases_to_date(){
        $active_cases = ['fecha'=>[], 'casos_activos'=>[], 'diferencial'=>[]];
        $count = count($this->data);

        for($i=0; $i<$count; $i++){
            if($i==0 || $this->data[$i][2] =='lunes'){ continue;}
            array_push($active_cases['fecha'], $this->data[$i][3]);
            array_push($active_cases['casos_activos'], (int)$this->data[$i][4]);
            array_push($active_cases['diferencial'], (int)$this->data[$i][5]);
        }
        return $active_cases;
    }
    
    public function get_newcases_test_to_date(){
        $active_cases = ['fecha'=>[], 'nuevos_casos'=>[], 'pruebas'=>[]];
        $count = count($this->data);

        for($i=0; $i<$count; $i++){
            if($i==0 || $this->data[$i][2] =='lunes'){ continue;}
            array_push($active_cases['fecha'], $this->data[$i][3]);
            array_push($active_cases['nuevos_casos'], (int)$this->data[$i][6]);
            array_push($active_cases['pruebas'], (int)$this->data[$i][25]);
        }
        return $active_cases;
    }

    public function get_media_newcases_to_week($to_week = FALSE){
        $group_week = [];
        $new_cases = ['semana'=>[], 'media'=>[]];
        $media_to_week = [];
        $count = count($this->data);
        for($i=0; $i<$count; $i++){
            if($i==0 || $this->data[$i][2] =='lunes' || $this->data[$i][3]<'2020-04-07'){ 
                continue;
            }
            $week = strval((int)$this->data[$i][1]);
            $group_week[$week][] = (int)$this->data[$i][6];
        }
        if($to_week){
            foreach($group_week as $week => $group_cases){
                $media = array_sum($group_week[$week])/count($group_week[$week]);
                $media_to_week[$week] = round($media);
            }
            return $media_to_week;
        }
        foreach($group_week as $week => $group_cases){
            $media = array_sum($group_week[$week])/count($group_week[$week]);
            array_push($new_cases['semana'], $week);
            array_push($new_cases['media'], round($media));
        }
        return $new_cases;
    }

    public function get_new_test_to_total_test(){
        $active_cases = ['fecha'=>[], 'nuevas_pruebas'=>[], 'total_pruebas'=>[]];
        $count = count($this->data);

        for($i=0; $i<$count; $i++){
            if($i==0){ continue;}
            array_push($active_cases['fecha'], $this->data[$i][3]);
            array_push($active_cases['nuevas_pruebas'], (int)$this->data[$i][25]);
            array_push($active_cases['total_pruebas'], (int)$this->data[$i][27]);
        }
        return $active_cases;
    }

    public function get_new_molecular_fast_test_to_date(){
        $active_cases = ['fecha'=>[], 'nuevas_pruebas_moleculares'=>[], 'nuevas_pruebas_rapidas'=>[]];
        $count = count($this->data);

        for($i=0; $i<$count; $i++){
            if($i==0 || $this->data[$i][2] =='lunes'){ continue;}
            array_push($active_cases['fecha'], $this->data[$i][3]);
            array_push($active_cases['nuevas_pruebas_moleculares'], (int)$this->data[$i][15]);
            array_push($active_cases['nuevas_pruebas_rapidas'], (int)$this->data[$i][20]);
        }
        return $active_cases;
    }

    public function get_new_molecular_test_and_positive_molecular(){
        $active_cases = ['fecha'=>[], 'nuevas_pruebas_moleculares'=>[], 'nuevas_positivos_molecular'=>[]];
        $count = count($this->data);

        for($i=0; $i<$count; $i++){
            if($i==0){ continue;}
            array_push($active_cases['fecha'], $this->data[$i][3]);
            array_push($active_cases['nuevas_pruebas_moleculares'], (int)$this->data[$i][15]);
            array_push($active_cases['nuevas_positivos_molecular'], (int)$this->data[$i][18]);
        }
        return $active_cases;
    }

    public function get_new_fast_test_and_positive_fast(){
        $active_cases = ['fecha'=>[], 'nuevas_pruebas_rápidas'=>[], 'nuevas_positivos_rápidas'=>[]];
        $count = count($this->data);

        for($i=0; $i<$count; $i++){
            if($i==0 || $this->data[$i][3]<'2020-04-08'){ continue;}
            array_push($active_cases['fecha'], $this->data[$i][3]);
            array_push($active_cases['nuevas_pruebas_rápidas'], (int)$this->data[$i][20]);
            array_push($active_cases['nuevas_positivos_rápidas'], (int)$this->data[$i][23]);
        }
        return $active_cases;
    }

    public function get_predictive_week(){
        $current_week = date('W') - 1;
        $current_day = date('l');
        $current_date = date("Y-m-d");
        $predictive = ['fecha' => [], 'predictivo' => []];

        $medias = $this->get_media_newcases_to_week(true);
        $total_cases = $this->get_total_cases(true);

        if($current_day == 'Sunday'){
            $current_week = date('W');
            $current_date = date('Y-m-d',strtotime($current_date.'+ 1 days'));
        }
        $last_sunday = date('Y-m-d',strtotime($current_date.'last sunday'));
        $cases_to_last_sunday = $total_cases[$last_sunday];
        $media_last_week = $medias[$current_week];

        $date_week = date('Y-m-d',strtotime($last_sunday.'+ 1 days'));
        for($i = 0; $i < 7; $i++){
            $cases_to_last_sunday = $cases_to_last_sunday + $media_last_week;
            array_push($predictive['fecha'],$date_week);
            array_push($predictive['predictivo'],$cases_to_last_sunday);
            $date_week = date('Y-m-d',strtotime($date_week.'+ 1 days'));
        }

        return $predictive;
    }
}
/*
$a = new Data();
$b = $a->get_predictive_week();

echo json_encode($b);*/