<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/news.php';
 
// get database connection
$db = new Database();
 
// prepare product object
$product = new News($db->conn);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$product->idArticle = $_POST['idArticle'];
 
// set product property values
$product->titreArticle = $_POST['titreArticle'];
$product->corpsArticle = $_POST['corpsArticle'];
$product->imgArticle = $_POST['imgArticle'];
$product->statutArticle = $_POST['statutArticle'];
$product->commentaire = $_POST['commentaire'];
$product->idCategorie = $_POST['idCategorie'];
$product->idUser = $_POST['idUser'];

// update the product
if($product->update()){
    header('location:localhost:8080/admin-ereporter/administration/testUpdate.php?idArticle='.$product->idArticle);
    echo '{';
        echo '"message": "Article mis à jour."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Impossible de mettre à jour l\'article."';
    echo '}';
}
?>