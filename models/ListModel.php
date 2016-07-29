<?php
    
    class ListModel  extends connect{
        
        public function GetList($city1, $city2, $date1, $timeSql1, $timeSql2){
            // 回傳查詢資料
            $a = $this->db->query(" SELECT *, (SELECT SUM(`number`) FROM `bus_corder` where `sid`=`bus_date`.`sid` 
            AND `did`=`bus_date`.`did`) AS Seated FROM `bus_date` INNER JOIN `bus_schedule` ON `bus_date`.`sid`=
            `bus_schedule`.`sid` WHERE `bus_schedule`.`start` =  '".$city1."' AND `bus_schedule`.`end` =  '".$city2."' 
            AND `bus_date`.`date`='".$date1."'".$timeSql1.$timeSql2);
            
            $data = $a->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
     }

?>