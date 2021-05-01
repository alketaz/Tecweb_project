<?php


class User
{


    private $Id;

    
    private $Name;


    private $Surname;


    private $Email;


    private $Password;


    private $Permission;


    private $Img;


    /**
     * User constructor.
     * @param $Id
     * @param string $Name
     * @param $Surname
     * @param $Email
     * @param $Password
     * @param $Permission
     * @param $Img
     */
    public function __construct($Id, string $Name, $Surname, $Email, $Password, $Permission, $Img)
    {
        try {
            $this->setId($Id);
            $this->setName($Name);
            $this->setSurname($Surname);
            $this->setEmail($Email);
            $this->setPassword($Password);
            $this->setPermission($Permission);
            $this->setImg($Img);

        } catch (Exception $exception) {

        };
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }


    /**
     * @param mixed $Id
     */
    public function setId( $Id ): void
    {
        $this->Id = $Id;
    }


    /**
     * @return string
     */
    public function getName()//: string
    {
        return $this->Name;
    }


    /**
     * @param string $Name
     */
    public function setName( string $Name )
    {
        if ( !(strlen( $Name ) < 30 )){
            throw new Exception( 'Name is too long' );
        }

        $this->Name = $Name;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->Surname;
    }


    /**
     * @param mixed $Surname
     */
    public function setSurname( $Surname )
    {
        if ( !(strlen( $Surname ) < 30 )){
            throw new Exception( 'Surname is too long' );
        }

        $this->Surname = $Surname;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }


    /**
     * @param $Email
     */
    public function setEmail( $Email )
    {
        if ( !(strlen( $Email ) < 50 )or !(strstr( $Email, '@' ))){
            throw new Exception( 'User email is invalid ' );
        }

        $this->Email = $Email;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }


    /**
     * @param mixed $Password
     */
    public function setPassword( $Password )
    {
        if ( !strlen( $Password )< 128 ){
            throw new Exception( 'Password is invalid' );
        }
        $this->Password = $Password;
    }


    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->Permission;
    }


    /**
     * @param mixed $Permission
     */
    public function setPermission( $Permission )
    {
        if ( !$Permission == UserLevelType::Administrator or !$Permission == UserLevelType::Consumer ){
            throw new Exception( 'Permission is not a UserLevelType' );
        }

        $this->Permission = $Permission;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->Img;
    }


    /**
     * @param mixed $Img
     */
    public function setImg($Img)
    {
        if ( !strlen( $Img ) < 255 ){
            throw new Exception( 'image path is invalid' );
        }
        $this->img = '../../img/user_icon.png';//$Img;
        
        return $this;
    }


    /**
     * @return User|null|User[]
     */
    public static function getAllUsers(): ?User {

        $access = DBAccess::openDBConnection();

        $querySelect = 'SELECT * FROM utente';

        $queryResult = mysql_query( $access->getConnection(), $querySelect );

        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        }
        else {
            $userList = [];
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $user = new User($riga['ID'], $riga['nome'], $riga['cognome'], $riga['email'], $riga['password'], $riga['permesso'], $riga['img_path']);
                array_push($listaCategorie, $user);
            }
        }

        return $userList;
    }

    /**
     * @param $id
     * @return User|null
     */
    public static function getUserById( $id ): ?User  {$access = DBAccess::openDBConnection();}

    public static function getArticleAuthor($id_articolo, $connection) {
        $querySelect = "SELECT * FROM utente INNER JOIN articolo on (utente.ID = articolo.autore) WHERE articolo.ID = $id_articolo ";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0){
            return null;
        }
        else { 
            $riga = mysqli_fetch_assoc($queryResult);
            $autore = new User($riga['ID'], $riga['nome'], $riga['cognome'], $riga['email'],$riga['password'],$riga['permesso'], $riga['img_path']);
            return $autore;
        }
    }

  /*  public static function getUserById( $id ): User  {

        $querySelect = sprintf( 'SELECT * FROM utente WHERE ID = %s', $id );

        $result = mysql_query( $access->getConnection(), $querySelect );

        if( !mysql_num_rows( $result ) ){
          return null;
        }

        $row = mysqli_fetch_row( $result );

        return ( new User( $row['ID'], $row['nome'], $row['cognome'], $row['email'], $row['password'], $row['permesso'], $row['img_path'] ) );

    }*/

    /**
     * @param UserLevelType $levelType
     */
    public static function getUserByAccess( UserLevelType $levelType ){
        //todo
    }
}