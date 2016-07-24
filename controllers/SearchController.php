<?php

class SearchController extends Controller {
  
  public function search(){
      $this->view("Search/Search1");
      
  } 
  
  public function search2(){
      $clientId = $_POST['clientId'];
      $clientPhone=$_POST['clientPhone'];
      
      $search =  $this->model("SearchModel");
      $data['arr_search'] = $search-> search($clientId,$clientPhone);
      $this->view("Search/Search2",$data);
  }
  
  public function deletesearch(){
    $oid = $_POST['oid'];
    $search =  $this->model("SearchModel");
    $delete = $search->deletes($oid);
  }
}
?>