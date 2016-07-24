<?php

class HomeController extends Controller {
    
    function index() {
        $news =  $this->model("HomeModel");
        $data['arr_news'] = $news->newsTitle();
        $this->view("Home/Index",$data);
    }
    
    function city1(){
        $pdo = $this->model("PDOtest");
        $city = $pdo ->city1();
        echo json_encode($city);
    }
    
    function city2(){
        $city1=$_POST['city1'];
        $pdo = $this->model("PDOtest");
        $city = $pdo ->city2($city1);
        echo json_encode($city);
    }
   
}

?>