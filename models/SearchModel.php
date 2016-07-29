<?php

class SearchModel  extends connect{
    
    public function search($clientId,$clientPhone){
        $a = $this-> db->query(" SELECT * FROM `bus_corder` INNER JOIN `bus_schedule` ON `bus_corder`.`sid`=`bus_schedule`.`sid`
        INNER JOIN `bus_date` ON `bus_corder`.`did`=`bus_date`.`did`
        WHERE `bus_corder`.`clientId`='".$clientId. "' and `bus_corder`.`clientPhone`='".$clientPhone."'");
        $data = $a->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function deletes($oid){
        $a = $this->db->query("DELETE FROM `bus_corder` WHERE `oid`='".$oid."' " );
       return "1"; 
        
    }
}
?>