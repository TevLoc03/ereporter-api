<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/news.php';
 
// get database connection
$db= new Database();
 
// prepare product object
$product = new News($db->conn);


// set ID property of product to be edited
$product->idArticle = isset($_GET['idArticle']) ? $_GET['idArticle'] : die();
 
// read the details of product to be edited
$product->readOne($product->idArticle);

// create array
$product_arr = array(
    "idArticle" =>  $product->idArticle,
    "titreArticle" => $product->titreArticle,
    "corpsArticle" => $product->corpsArticle,
    "imgArticle" => $product->imgArticle,
    "statutArticle" => $product->statutArticle,
    "datePublication" => $product->datePublication,
    "commentaire" => $product->commentaire,
    "idCategorie" => $product->idCategorie,
    "idUser" => $product->idUser
);
 
// make it json format
print_r(json_encode($product_arr));
?>