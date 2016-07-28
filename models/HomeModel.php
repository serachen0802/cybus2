<?php


 class HomeModel  extends connect{

     
    public function newsTitle(){

        $a = $this->db->query(" SELECT * FROM bus_news ORDER BY date DESC limit 5");
        $data = $a->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    
    public function news($nid){
        $a = $this->db->query(" SELECT * FROM bus_news WHERE nid = '".$nid."'");
        $data = $a->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
 
 }
?>