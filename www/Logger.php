<?
class Logger 
{
    

    public $result; 
    public $result_non_valid; 

    public function validation($array){
        $count = count(array_filter($array));
        if ($count!=6){
             $this->result = false;
        }
        else  $this->result = true;
        
    }

    public function non_valid($array){
        if (preg_match("/^([0-9])+$/", $array['firstname'])) {
            $this->result_non_valid =   $this->result_non_valid +1;
        }
       else if (preg_match("/^([0-9])+$/", $array['lastname'])) {
        $this->result_non_valid =   $this->result_non_valid +1;
        }
       else if (!preg_match("/^([0-9])+$/", $array['age'])) {
        $this->result_non_valid =  $this->result_non_valid +1;
        }
       else if (preg_match("/^([0-9])+$/", $array['address'])) {
        $this->result_non_valid=   $this->result_non_valid +1;
        }
       
    else  $this->result_non_valid = 0;
    }
    
    public function getSqlResult($sql, $json, $mail){
        if((mysql_query($sql)) and ($this->result == true) and ($this->result_non_valid == 0)){
            $log = "\n".'New record:'."\n".date('Y-m-d H:i:s')."\n".$json."\n".'success'."\n\n" ;
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.dat', $log, FILE_APPEND);
            mail($mail, "Проверка отправки", "Запись успешно добавлена!");
        }
        else{
            $log = "\n".'New record:'."\n".date('Y-m-d H:i:s')."\n".$json."\n".'fail'."\n\n" ;
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.dat', $log, FILE_APPEND);
        }
       
        header('Location: http://part_2');
    }
}
?>