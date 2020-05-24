<?php
require_once('csv.php');
class Data{

    private $data = [];

    function __construct(){
        $class = new CSV();
        $this->data = $class->load_data();
    }

    public function get_total_cases(){
        $total = ['fecha'=>[], 'total_casos'=>[]];
        $count = count($this->data);

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

    public function get_media_newcases_to_week(){
        $group_week = [];
        $new_cases = ['semana'=>[], 'media'=>[]];
        $count = count($this->data);
        for($i=0; $i<$count; $i++){
            if($i==0 || $this->data[$i][2] =='lunes' || $this->data[$i][3]<'2020-04-07'){ 
                continue;
            }
            $week = strval((int)$this->data[$i][1]);
            $group_week[$week][] = (int)$this->data[$i][6];
        }
        foreach($group_week as $week => $group_cases){
            $media = array_sum($group_week[$week])/count($group_week[$week]);
            array_push($new_cases['semana'], $week);
            array_push($new_cases['media'], round($media, 2));
        }
        return $new_cases;
    }
}
/*
$a = new Data();
$b = $a->get_media_newcases_to_week();

echo json_encode($b);*/