<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/news.php';
 
$db = new Database();
 
$product = new News($db->conn);
 
// get posted data

//$data = json_decode(file_get_contents("php://input"));

// set product property values
$product->titreArticle = $_POST['titreArticle'];
$product->corpsArticle = $_POST['corpsArticle'];
$product->imgArticle = $_POST['imgArticle'];
$product->datePublication = $_POST['datePublication'];
$product->idCategorie = $_POST['idCategorie'];
$product->idUser = $_POST['idUser'];

 
// create the product
if($product->create()){
    echo '{';
        echo '"message": "Votre article a été créer."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    var_dump($_POST,$_SERVER['REQUEST_METHOD']['titreArticle']);
    echo '{';
        echo '"message": "Impossible de créer un produit."';
    echo '}';
}
?>