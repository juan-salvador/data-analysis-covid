<?php
Class CSV {

  private $file_name = 'data.csv';

  public function load_data(){
    $array_data = [];
    if (($file = fopen($this->file_name, "r")) !== FALSE) 
    {
      while (($data = fgetcsv($file, 1000, ",")) !== FALSE) 
      {
        $array_data[] = $data;		
      }
      fclose($file);
    }
    return $array_data;
  }
}
