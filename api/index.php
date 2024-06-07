<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'DbConnect.php';
$objDb=new DbConnect;
$conn = $objDb->connect();



$method =$_SERVER['REQUEST_METHOD'];
switch($method){
    case "POST":
        $user=json_decode(file_get_contents('php://input'));
        $sql="INSERT INTO users(id,name,email,mobile,created_at) VALUES (null,:name,:email,:mobile,:created_at)";
        $stmt=$conn->prepare($sql);
        $created_at =date ('Y-m-d');
        $stmt->bindParam(':name',$user->name);
        $stmt->bindParam(':email',$user->email);
        $stmt->bindParam(':mobile',$user->mobile);
        $stmt->bindParam(':created_at',$created_at);
        if($stmt->execute()){
            $resposnse=['status'=>1,'message'=>'Record created Successfully.'];
        } 
        else
        {
            $resposnse=['status'=>0,'message'=>'fail to create recod.'];
        }
        echo json_encode($resposnse);
        break;


}




?>