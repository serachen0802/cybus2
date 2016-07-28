<?php
    
    class OrderModel  extends connect{
        
        public function GetData($sid, $did){
            $a = $this->db->query(" SELECT * FROM bus_date INNER JOIN bus_schedule ON bus_date.sid=bus_schedule.sid
            WHERE bus_date.sid='".$sid. "'and bus_date.did='".$did."'");
            $data = $a->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        
        public function GetThirdData($sid, $did) {
            $a = $this->db->query(" SELECT * FROM bus_date INNER JOIN bus_schedule ON bus_date.sid=bus_schedule.sid
            WHERE bus_date.sid='".$sid. "' AND bus_date.did='".$did."'");
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
            $tins = $this->db->prepare("INSERT INTO `bus_corder` " .
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
            $a = $this->db->query(" SELECT * FROM bus_corder INNER JOIN bus_schedule ON bus_corder.sid=bus_schedule.sid 
            INNER JOIN bus_date ON bus_corder.did=bus_date.did
            WHERE oid='".$oid."'");
            $data = $a->fetchAll(PDO::FETCH_ASSOC);
            
            return $data;
        }
        
        public function GetOrderback2($backdate, $backstart, $backend) {
            $a = $this->db->query(" SELECT *, (SELECT SUM(number) FROM bus_corder where sid=bus_date.sid AND did=bus_date.did) AS Seated
            FROM bus_date INNER JOIN bus_schedule ON bus_schedule.sid=bus_date.sid WHERE bus_date.date='".$backdate."' 
            AND bus_schedule.start='".$backstart."'
            AND bus_schedule.end='".$backend."'");
            $data = $a->fetchAll(PDO::FETCH_ASSOC);
            
            return $data;
        }
        
        public function GetOrderback3_1($sid, $did) {
            $a = $this->db->query(" SELECT * FROM bus_date INNER JOIN bus_schedule ON bus_date.sid=bus_schedule.sid
            WHERE bus_date.sid='".$sid. "' and bus_date.did='".$did."'");
            $data = $a->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        
        public function GetOrderback3_2($sid, $did) {
            $x = $this->db->query(" SELECT * FROM bus_corder INNER JOIN bus_schedule ON bus_corder.sid=bus_schedule.sid INNER JOIN bus_date ON
                        bus_corder.did=bus_date.did WHERE bus_corder.sid='".$sid."' AND bus_corder.did='".$did."'");
            $data =$x->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        
        public function GetOrderback3_3($oid) {
            $a = $this->db->query(" SELECT * FROM bus_corder WHERE oid='".$oid."'");
            $data = $a->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        
        public function InsertOrderback($oid, $sid, $did, $seat) {
            $a = $this->db->query(" SELECT * FROM bus_corder WHERE oid='".$oid."'");
            $data = $a->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $key => $value){
                $clientId=$value['clientId'];
                $name=$value['clientName'];
                $phone=$value['clientPhone'];
                $ordertime=$value['orderTime'];
                $ticket=$value['type'];
                $TicketNumr=$value['number'];
                $TotalPrice=$value['total'];
                $ticrand=$value['ticrand'];
            }
        
            $tins = $this->db->prepare("INSERT INTO `bus_corder` " .
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
                        ':type'=>"來回票-回程",
                        ':number'=>$TicketNumr,
                        ':total'=>$TotalPrice,
                        ':ticrand'=>$ticrand
                    ));
                    
            $oid2 = $this->db->lastInsertId();
            return $oid2;
        }
        
        public function GetOrderback4_1($oid){
            $o = $this->db->query(" SELECT * FROM bus_corder INNER JOIN bus_schedule ON bus_corder.sid=bus_schedule.sid INNER JOIN bus_date ON
                    bus_corder.did=bus_date.did WHERE bus_corder.oid='".$oid."'");
            $data = $o->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        
        public function GetOrderback4_2($oid2){
            $o2 = $this->db->query(" SELECT * FROM bus_corder INNER JOIN bus_schedule ON bus_corder.sid=bus_schedule.sid INNER JOIN bus_date ON
                    bus_corder.did=bus_date.did WHERE bus_corder.oid='".$oid2."'");
            $data = $o2->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
     }

?>