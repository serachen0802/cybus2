<?php

class ListController extends Controller {
    
    public function Index(){
        $city1=$_POST['city1'];
        $city2=$_POST['city2'];
        $orderdate=strtotime($_POST['orderdate']);
        $ordertime1=strtotime($_POST['ordertime1']);
        $ordertime2=strtotime($_POST['ordertime2']);
        $nowtime=strtotime(date('Y-m-d'));//現在時間
        $ordertimef=$_POST['ordertime1'];
        $ordertimes=$_POST['ordertime2'];
        $date1=$_POST['orderdate'];
        // 抓取所選取時間的id

        if ($ordertimef != "") {
            $timeSql1= " AND bus_date.time >= '".$ordertimef."'";
        }
        if ($ordertimes != "") {
            $timeSql2= " AND bus_date.time <= '".$ordertimes."'";
           
        }
        
        $model =  $this->model("ListModel");
        $data['arr_data'] = $model->GetList($city1, $city2, $date1, $timeSql1, $timeSql2);
        $this->view("List/Index",$data);
    }
}
?>