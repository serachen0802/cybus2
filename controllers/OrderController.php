<?php

class OrderController extends Controller {
    
    public function FirstStep(){
        if($_POST['sid']==""){
            echo "<script>alert('請選擇車次');</script>";
            header("Refresh:0;url=Index.php");
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
          echo "<script>alert('請選擇票種張數');</script>";
            header("Refresh:0;url=Index.php");
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
        
        
        foreach($data as $key => $value){
    
            $start=$value['start'];
            $end=$value['end'];
        }
    }
}
?>