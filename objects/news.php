<?php
class News{
 
    // database connection and table name
    private $conn;
    private $table_name = "articles";
 
    // object properties
    public $idArticle;
    public $titreArticle;
    public $corpsArticle;
    public $idCategorie;
    public $idUser;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    function read(){
        // select all query
        $query = "SELECT idArticle, titreArticle, corpsArticle, imgArticle, statutArticle, datePublication, commentaire, idCategorie, idUser FROM articles";
        // prepare query statement
        $stmt = $this->conn->query($query);
    
        return $stmt;
    }

    // create product
    function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . "
                SET titreArticle=:titreArticle, corpsArticle=:corpsArticle, imgArticle=:imgArticle,  datePublication=:datePublication, idCategorie=:idCategorie, idUser=:idUser";
    
        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->titreArticle=htmlspecialchars(strip_tags($this->titreArticle));
        $this->corpsArticle=htmlspecialchars(strip_tags($this->corpsArticle));
        $this->imgArticle=$this->imgArticle;
        $this->datePublication=htmlspecialchars(strip_tags($this->datePublication));
        $this->idCategorie=htmlspecialchars(strip_tags($this->idCategorie));
        $this->idUser=htmlspecialchars(strip_tags($this->idUser));
    
        // bind values
        $stmt->bindParam(":titreArticle", $this->titreArticle);
        $stmt->bindParam(":corpsArticle", $this->corpsArticle);
        $stmt->bindParam(':imgArticle', $this->imgArticle);
        $stmt->bindParam(':datePublication', $this->datePublication);
        $stmt->bindParam(":idCategorie", $this->idCategorie);
        $stmt->bindParam(":idUser", $this->idUser);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // used when filling up the update product form
    function readOne($id){
        // query to read single record
        $query = "SELECT idArticle, titreArticle, corpsArticle, imgArticle, statutArticle, datePublication, commentaire, articles.idCategorie, idUser 
                    FROM " . $this->table_name . "
                    LEFT JOIN categories ON articles.idCategorie = categories.idCategorie
                    WHERE articles.idArticle = ".$id."
                    LIMIT 1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->idArticle);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->idArticle = $row['idArticle'];
        $this->titreArticle = $row['titreArticle'];
        $this->corpsArticle = $row['corpsArticle'];
        $this->imgArticle = $row['imgArticle'];
        $this->statutArticle = $row['statutArticle'];
        $this->datePublication = $row['datePublication'];
        $this->commentaire = $row['commentaire'];
        $this->idCategorie = $row['idCategorie'];
        $this->idUser = $row['idUser'];
    }

    // update the product
    function update(){
    
        // update query
        $query = "UPDATE " . $this->table_name . "
                SET
                    titreArticle = :titreArticle,
                    corpsArticle = :corpsArticle,
                    idCategorie = :idCategorie,
                    imgArticle = :imgArticle,
                    statutArticle = :statutArticle,
                    datePublication = :datePublication,
                    commentaire = :commentaire,
                    idUser = :idUser
                WHERE
                    idArticle = :idArticle";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->titreArticle=htmlspecialchars(strip_tags($this->titreArticle));
        $this->corpsArticle=htmlspecialchars(strip_tags($this->corpsArticle));
        $this->imgArticle=$this->imgArticle;
        $this->statutArticle=htmlspecialchars(strip_tags($this->statutArticle));
        $this->datePublication=htmlspecialchars(strip_tags($this->datePublication));
        $this->commentaire=htmlspecialchars(strip_tags($this->commentaire));
        $this->idCategorie=htmlspecialchars(strip_tags($this->idCategorie));
        $this->idUser=htmlspecialchars(strip_tags($this->idUser));
        $this->idArticle=htmlspecialchars(strip_tags($this->idArticle));
    
        // bind new values
        $stmt->bindParam(':titreArticle', $this->titreArticle);
        $stmt->bindParam(':corpsArticle', $this->corpsArticle);
        $stmt->bindParam(':imgArticle', $this->imgArticle);
        $stmt->bindParam(':statutArticle', $this->statutArticle);
        $stmt->bindParam(':datePublication', $this->datePublication);
        $stmt->bindParam(':commentaire', $this->commentaire);
        $stmt->bindParam(':idUser', $this->idUser);
        $stmt->bindParam(':idCategorie', $this->idCategorie);
        $stmt->bindParam(':idArticle', $this->idArticle);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function delete($id){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE idArticle = ".$id;
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->idArticle=htmlspecialchars(strip_tags($this->idArticle));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->idArticle);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

}