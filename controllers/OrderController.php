<?php

class OrderController extends Controller {
    
    public function FirstStep(){
        if($_POST['sid']==""){
            // echo "<script>alert('請選擇車次');</script>";
            header("Refresh:0;url=https://lab-sera-chen.c9users.io/cybusEasy/");
            
        }

        $this->view("Order/FirstStep");
    }
    
    public function SecondStep(){
        $sid=$_POST['sid'];
        $did=$_POST['did'];
        
        $model =  $this->model("OrderModel");
        $data['arr_data'] = $model->GetData($sid, $did);
        $this->view("Order/SecondStep", $data);
    }
    
    public function thirdStep(){
        if($_POST['price']==""){
        //   echo "<script>alert('請選擇票種張數');</script>";
          header("Refresh:0;url=https://lab-sera-chen.c9users.io/cybusEasy/");
        }
        
        $sid=$_POST['sid'];//    
        $did=$_POST['did'];
        
        $model =  $this->model("OrderModel");
        
        $data['arr_data'] = $model->GetThirdData($sid, $did);
        
        $data2['arr_data'] = $model->GetThirdData2($sid, $did);
        foreach($data2['arr_data'] as $k => $val){
            $res.=$val['seat'].",";
        }
        $data['res']=substr($res,0,-1);
        
        $this->view("Order/ThirdStep", $data); //這個
    }
    
    public function InsertOrder(){
        $sid=$_POST['sid'];
        $did=$_POST['did'];
        $clientId=$_POST['clientId'];
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        //被選擇的座位
        $seat=$_POST['snum'];
        $ordertime=date("Y-m-d h:i:s");
        //全票.半票.來回
        $ticket=$_POST['ticket'];
        $ticket1=$_POST['ticket'];
        //張數
        $TicketNumr=$_POST['TicketNum'];
        //總金額
        $TotalPrice=$_POST['TotalPrice'];
        //取票代碼
        $date=date("Y-m-d H:i");
        $ticrand=substr(strtotime($date),-7).substr($clientId,-3);
        $backstart=$_POST['backstart'];
        $backend=$_POST['backend'];
        
        $model =  $this->model("OrderModel");
        $oid = $model->InsertSeated($sid, $did, $clientId, $name, $phone, $seat, $ordertime, $ticket, $TicketNumr, $TotalPrice, $ticrand);
        
        if($ticket1=="來回票-去程"){
            header('location:Orderback1?oid='.$oid);
        }else{
            header('location:FourthStep?oid='.$oid);
        } 
    }
    
    public function FourthStep(){
        $oid=$_GET["oid"];
        $model =  $this->model("OrderModel");
        $data['arr_data'] = $model->GetFourthData($oid);
        $this->view("Order/FourthStep", $data);
    }
    
    public function Orderback1(){
        $oid= $_GET['oid'];
        $model =  $this->model("OrderModel");
        
        $dataList = $model->GetOrderback1($oid);
        
        foreach($dataList as $key => $value){
    
            $data['start']=$value['start'];
            $data['end']=$value['end'];
        }
        $this->view("Order/Orderback1", $data);
    }
    
    public function Orderback2(){
        $backdate = $_POST['backdate'];
        $backstart=$_POST['backstart'];
        $backend=$_POST['backend'];
    
        $model =  $this->model("OrderModel");
        $data['arr_data'] = $model->GetOrderback2($backdate, $backstart, $backend);
        $this->view("Order/Orderback2", $data);
    }
    
    public function Orderback3(){
        $sid=$_POST['sid'];
        $did=$_POST['did'];
        $oid=$_POST['oid'];

        $model =  $this->model("OrderModel");
        $data['arr_data'] = $model->GetOrderback3_1($sid, $did);
        $data['arr_data2'] = $model->GetOrderback3_2($sid, $did);
        foreach($data['arr_data2'] as $k => $val){
            $res.=$val['seat'].",";
        }
        
        $data['res']=substr($res,0,-1);
        
        
        $data['arr_data3'] = $model->GetOrderback3_3($oid);
        foreach($data['arr_data3'] as $key => $v){
            $data['TicketNumr']=$v['number'];
        }
        $this->view("Order/Orderback3", $data);
    }
    
    public function InsertOrderback(){
        $oid=$_POST['oid'];
        $sid=$_POST['sid'];
        $did=$_POST['did'];
        $seat=$_POST['snum'];
        
        $model =  $this->model("OrderModel");
        $oid2 = $model->InsertOrderback($oid, $sid, $did, $seat);
        header('location:Orderback4?oid2='.$oid2.'&oid='.$oid);
    }
    
    public function Orderback4(){
        $oid2=$_GET["oid2"];
        $oid=$_GET["oid"];
        $model =  $this->model("OrderModel");
        $data['oid'] = $model->GetOrderback4_1($oid);
        $data['oid2'] = $model->GetOrderback4_2($oid2);

        if($data['oid']['type']="來回票-去程"){
            $data['type']="來回票";
        }
        $this->view("Order/Orderback4", $data);
    }
}
?>