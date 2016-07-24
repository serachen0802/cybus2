<?php
    require_once('connect.php');
    
    class OrderModel  extends connect{
        
        public function GetData($sid, $did){
            $a = $this->db->query(" SELECT * FROM bus_date INNER JOIN bus_schedule ON bus_date.sid=bus_schedule.sid
            WHERE bus_date.sid='".$sid. "'and bus_date.did='".$did."'");
            $data = $a->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        
        
        public function GetThirdData($sid, $did) {
            $a = $this->db->query(" SELECT * FROM bus_date INNER JOIN bus_schedule ON bus_date.sid=bus_schedule.sid
            WHERE bus_date.sid='".$sid. "' and bus_date.did='".$did."'");
            $data = $a->fetchAll(PDO::FETCH_ASSOC);
            
            return $data;
        }
        
        public function GetThirdData2($sid, $did) {
            $x = $this->db->query(" SELECT * FROM bus_corder INNER JOIN bus_schedule ON bus_corder.sid=bus_schedule.sid INNER JOIN bus_date ON
                            bus_corder.did=bus_date.did WHERE bus_corder.sid='".$sid."' AND bus_corder.did='".$did."'");
            $data =$x->fetchAll(PDO::FETCH_ASSOC);
            
            return $data; 
        }
        
        public function InsertSeated($sid, $did, $clientId, $name, $phone, $seat, $ordertime, $ticket, $TicketNumr, $TotalPrice, $ticrand) {
            $tins = $this->db->prepare("insert into `bus_corder` " .
                    "(`sid`,`did`,`clientId`,`clientName`,`clientPhone`,`seat`,`orderTime`,`type`,`number`,`total`,`ticrand`)".
                    "values(:sid,:did,:clientId,:clientName,:clientPhone,:seat,:orderTime,:type,:number,:total,:ticrand)"
                  );
            $tins->execute(array(
                        ':sid' =>$sid,
                        ':did' =>$did,
                        ':clientId' =>$clientId,
                        ':clientName'=>$name,
                        ':clientPhone'=>$phone,
                        ':seat'=>$seat,
                        ':orderTime'=>$ordertime,
                        ':type'=>$ticket,
                        ':number'=>$TicketNumr,
                        ':total'=>$TotalPrice,
                        ':ticrand'=>$ticrand
                    ));
                
            return $oid = $this->db->lastInsertId();
        }
        
        public function GetFourthData($oid) {
            $o = $this->db->query(" SELECT * FROM bus_corder INNER JOIN bus_schedule ON bus_corder.sid=bus_schedule.sid INNER JOIN bus_date ON
                    bus_corder.did=bus_date.did WHERE bus_corder.oid=".$oid);
            $data = $o->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        
        public function GetOrderback1($oid) {
            
        }
     }

?>