<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/news.php';
 
// instantiate database and product object
$db = new Database();
 
// initialize object
$product = new News($db->conn);
 
// query products
$stmt = $product->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $products_arr=array();
    $products_arr["articles"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        $product_item=array(
            "idArticle" => $idArticle,
            "titreArticle" => $titreArticle,
            "corpsArticle" => html_entity_decode($corpsArticle),
            "imgArticle" => $imgArticle,
            "statutArticle" => $statutArticle,
            "datePublication" => $datePublication,
            "commentaire" => html_entity_decode($commentaire),
            "idCategorie" => $idCategorie,
            "idUser" => $idUser
        );

        array_push($products_arr["articles"], $product_item);
    }
 
    echo json_encode($products_arr);
}
 
else{
    echo json_encode(
        array("message" => "Aucun article trouvé.")
    );
}
?>