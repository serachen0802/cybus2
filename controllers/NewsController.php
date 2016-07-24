<?php
class NewsController extends Controller {
    public function news(){
        
        $nid=$_GET['nid'];
        $news =  $this->model("HomeModel");
        $data['news']= $news->news($nid);
        $this->view("Home/News",$data);
    }
    
}
?>