<?php
require_once("./models/User.php");
class CheckValues {
    public static function checkForCorrectValues($value,$typeOfCheck,$length) {
        $correctCharacters = true;
        switch($typeOfCheck) {
            case "digit": 
                $correctCharacters = ctype_digit($value);
                break;
            case "alpha":
                $correctCharacters = ctype_alpha($value);
                break;
            case "alnum":
                $correctCharacters = ctype_alnum($value);
                break;
            case "data":
                $correctCharacters = DateTime::createFromFormat('Y-m-d G:i:s', $value);
                break;
        }
        $correctCharacters = $correctCharacters && (strlen($value) <= $length);
        return $correctCharacters;
    }

    public static function createMsgError($value) {
        return "Error Processing Request, $value Has Incorrect Characters Or Is Too Long";
    }
}
class Articolo
{
    private $ID;

    private $titolo;

    private $descrizione;

    private $testo;


    private $autore;


    private $dataPub;


    private $upVotes;


    private $downVotes;


    private $imgPath;

    private $altImg;


    function __construct($ID, $titolo, $descrizione, $testo, $autore, $dataPub, $upVotes, $downVotes, $imgPath, $altImg)
    {
        try {$this->setID($ID);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
        try {$this->setTitolo($titolo);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
        try {$this->setTesto($testo);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
        try {$this->setDescrizione($descrizione);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
        try {$this->setAutore($autore);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
        try {$this->setDataPub($dataPub);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
        try {$this->setUpVotes($upVotes);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
        try {$this->setDownVotes($downVotes);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
        try {$this->setImgPath($imgPath);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
        try {$this->setAltImg($altImg);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
    }

    public function setImgPath($value)
    {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 255);
        if($correctCharacters) 
            $this->imgPath = "../img/Sala_del_Consiglio_dei_Ministri_(Palazzo_Chigi,_Roma).jpeg";//$value;
        else 
            throw new Exception(CheckValues::createMsgError("ImgPath"), 1);
    }
    public function getImgPath()
    {
        return $this->imgPath;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setID($value)
    {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "digit", 6);
        if($correctCharacters) 
            $this->ID = $value;
        else 
            throw new Exception(CheckValues::createMsgError("ID"), 1);
    }

    public function getTitolo()
    {
        return $this->titolo;
    }

    function setTitolo($value)
    {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 126);
        if($correctCharacters) 
            $this->titolo = $value;
        else 
            throw new Exception(CheckValues::createMsgError("Title"), 1);
    }

    function getDescrizione() {
        return $this->descrizione;
    }

    function setDescrizione($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 350);
        if($correctCharacters) 
            $this->descrizione = $value;
        else
            throw new Exception(CheckValues::createMsgError("Description"), 1);
    }

    public function getTesto()
    {
        return $this->testo;
    }

    public function setTesto($value)
    {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 10000);
        if($correctCharacters) 
            $this->testo = $value;
        else 
           throw new Exception(CheckValues::createMsgError("Text"), 1);
    }

    public function getAutore()
    {
        return $this->autore;
    }

    public function setAutore($value)
    {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "digit", 6);
        if($correctCharacters) 
            $this->autore = $value;
        else 
            throw new Exception(CheckValues::createMsgError("Author"), 1);
    }

    public function getDataPub()
    {
        return $this->dataPub;
    }

    public function setDataPub($value)
    {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "data", 19);
        if($correctCharacters) 
            $this->dataPub = $value;
        else
            throw new Exception(CheckValues::createMsgError("Data Publishment"), 1);
    }

    public function getUpVotes()
    {
        return $this->upVotes;
    }

    public function setUpVotes($value)
    {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "digit", 7);
        if($correctCharacters) 
            $this->upVotes = $value;
        else 
            throw new Exception(CheckValues::createMsgError("Up Votes"), 1);
    }

    public function getDownVotes()
    {
        return $this->downVotes;
    }

    public function setDownVotes($value)
    {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "digit", 7);
        if($correctCharacters) 
            $this->downVotes = $value;
        else 
            throw new Exception(CheckValues::createMsgError("Down Votes"), 1);
    }

    public function setAltImg($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "alpha", 255);
        if($correctCharacters) 
            $this->altImg = $value;
        else 
            throw new Exception(CheckValues::createMsgError("Alt Image"), 1);
    }

    public function getAltImg() {
        return $this->altImg;
    }

    //

    public static function getArticoli($category, $connection)
    {
        if ($category != null)
            $querySelect = "SELECT * FROM articolo, cat_art
                            WHERE  cat_art.nome_cat = '$category' AND articolo.ID = cat_art.ID_art
                            ORDER BY ID ASC";
        else
            $querySelect = "SELECT * FROM articolo ORDER BY ID ASC";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        }
        else { // ritorno la lista degli articoli all'interno del db
            $listaArticoli = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $singoloArticolo = new Articolo($riga['ID'], $riga['titolo'], $riga['descrizione'],$riga['testo'], $riga['autore'], $riga['data_pub'], $riga['upvotes'], $riga['downvotes'], $riga['img_path'], $riga['alt_img']);
                array_push($listaArticoli, $singoloArticolo);
            }
        }
        return $listaArticoli;
    }

    public static function getArticolo($id_articolo, $connection) {
        $querySelect = "SELECT * FROM articolo WHERE articolo.ID=$id_articolo";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else { 
            $riga = mysqli_fetch_assoc($queryResult);
            $singoloArticolo = new Articolo($riga['ID'], $riga['titolo'], $riga['descrizione'],$riga['testo'], $riga['autore'], $riga['data_pub'], $riga['upvotes'], $riga['downvotes'], $riga['img_path'], $riga['alt_img']);
            return $singoloArticolo;
        }
    }
}

class Categoria
{
    private $nome;
    private $descrizione;
    private $img;
    function __construct($nome, $descrizione)
    {
        try {$this->setNome($nome);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
        try {$this->setDescrizione($descrizione);} catch (Exception $e) { echo 'Caught exception: ',  $e->getMessage(), "\n";}
    }

    public function setDescrizione($value)
    {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 255);
        if($correctCharacters) 
            $this->descrizione = $value;
        else 
            throw new Exception(CheckValues::createMsgError("Descrizione"), 1);
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($value)
    {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "alnum", 20);
        if($correctCharacters) 
            $this->nome = $value;
        else 
            throw new Exception(CheckValues::createMsgError("Name"), 1);
    }

    public function getDescrizione()
    {
        return $this->descrizione;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 255);
        if($correctCharacters) 
            $this->img = $value;
        else 
            throw new Exception(CheckValues::createMsgError("Img Of Category"), 1);
    }
    public static function getCategorie($connection)
    {
        $querySelect = "SELECT * FROM categoria";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else { // ritorno la lista delle categorie all'interno del db
            $listaCategorie = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $singolaCategoria = new Categoria($riga['nome'], $riga['descrizione'], $riga['img']);
                array_push($listaCategorie, $singolaCategoria);
            }
        }
        return $listaCategorie;
    }

    public static function getCategorieArticolo($id_articolo, $connection) {
        $querySelect = "SELECT categoria.nome, categoria.descrizione, categoria.img FROM cat_art INNER JOIN categoria ON cat_art.nome_cat = categoria.nome WHERE cat_art.ID_art = $id_articolo";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else { // ritorno la lista delle categorie all'interno del db
            $listaCategorie = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $singolaCategoria = new Categoria($riga['nome'], $riga['descrizione'], $riga['img']);
                array_push($listaCategorie, $singolaCategoria);
            }
        }
        return $listaCategorie;
    }
}

?>