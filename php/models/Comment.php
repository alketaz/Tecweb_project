<?php

//todo setter

class Comment
{
    /**
     * @var int $IdArticolo
     */
    private $IdArticolo;


    /**
     * @var int $IdCommento
     */
    private $IdCommento;


    /**
     * @var int $IdAutore
     */
    private $IdAutore;


    /**
     * @var string $Testo
     */
    private $Testo;


    /**
     * @var string $DataPubblicazione
     */
    private $DataPubblicazione;


    /**
     * @var int $UpVotes
     */
    private $UpVotes;


    /**
     * @var int $DownVotes
     */
    private $DownVotes;

    /**
     * Comment constructor.
     * @param int $IdArticolo
     * @param int $IdCommento
     * @param int $IdAutore
     * @param string $Testo
     * @param string $DataPubblicazione
     * @param int $UpVotes
     * @param int $DownVotes
     */
    public function __construct(int $IdArticolo, int $IdCommento, int $IdAutore, string $Testo, string $DataPubblicazione, int $UpVotes, int $DownVotes)
    {
        $this->IdArticolo = $IdArticolo;
        $this->IdCommento = $IdCommento;
        $this->IdAutore = $IdAutore;
        $this->Testo = $Testo;
        $this->DataPubblicazione = $DataPubblicazione;
        $this->UpVotes = $UpVotes;
        $this->DownVotes = $DownVotes;
    }


    /**
     * @return int
     */
    public function getIdArticolo(): int
    {
        return $this->IdArticolo;
    }

    /**
     * @param int $IdArticolo
     */
    public function setIdArticolo(int $IdArticolo): void
    {
        $this->IdArticolo = $IdArticolo;
    }

    /**
     * @return int
     */
    public function getIdCommento(): int
    {
        return $this->IdCommento;
    }

    /**
     * @param int $IdCommento
     */
    public function setIdCommento(int $IdCommento): void
    {
        $this->IdCommento = $IdCommento;
    }

    /**
     * @return int
     */
    public function getIdAutore(): int
    {
        return $this->IdAutore;
    }

    /**
     * @param int $IdAutore
     */
    public function setIdAutore(int $IdAutore): void
    {
        $this->IdAutore = $IdAutore;
    }

    /**
     * @return string
     */
    public function getTesto(): string
    {
        return $this->Testo;
    }

    /**
     * @param string $Testo
     */
    public function setTesto(string $Testo): void
    {
        $this->Testo = $Testo;
    }

    /**
     * @return string
     */
    public function getDataPubblicazione(): string
    {
        return $this->DataPubblicazione;
    }

    /**
     * @param string $DataPubblicazione
     */
    public function setDataPubblicazione(string $DataPubblicazione): void
    {
        $this->DataPubblicazione = $DataPubblicazione;
    }

    /**
     * @return int
     */
    public function getUpVotes(): int
    {
        return $this->UpVotes;
    }

    /**
     * @param int $UpVotes
     */
    public function setUpVotes(int $UpVotes): void
    {
        $this->UpVotes = $UpVotes;
    }

    /**
     * @return int
     */
    public function getDownVotes(): int
    {
        return $this->DownVotes;
    }

    /**
     * @param int $DownVotes
     */
    public function setDownVotes(int $DownVotes): void
    {
        $this->DownVotes = $DownVotes;
    }


    public static function getAllComments(): ?Comment {
        $access = DBAccess::openDBConnection();

        $query = 'SELECT * FROM commento';

        $queryResult = mysql_query( $access->getConnection(), $query );

        if ( !mysqli_num_rows( $queryResult )){
            return null;
        }

        $rows = mysqli_fetch_array( $queryResult );

        $result = [];

        foreach ( $rows as $row ) {
            $comment = new Comment( $row['ID_art'], $row['ID_com'], $row['autore'], $row['testo'], $row['data_pub'], $row['upvotes'], $row['downvotes'] );

            array_push( $result, $comment );
        }

        return $result;
    }


    public function getAuthor(): User{
        $access = DBAccess::openDBConnection();

        $query = sprintf( 'SELECT * FROM utente WHERE ID = %s', $this->getIdAutore() );

        $queryResult = mysql_query( $access->getConnection(), $query );

        $row = mysql_fetch_row( $queryResult );

        return ( new User( $row['ID'], $row['nome'], $row['cognome'], $row['email'], $row['password'], $row['permesso'], $row['img_row'] ));
    }

}