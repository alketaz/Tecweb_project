<?php

class DBAccess
{

    private const HOST_DB = "localhost";
    private const USARNAME = "root";
    private const PASSWORD = "";
    private const DATABASE_NAME = "TecWeb";
    private static $connection;

    public static function openDBConnection()
    {
        $access = new DBAccess();
        $access->setConnection(mysqli_connect(DBAccess::HOST_DB, DBAccess::USARNAME, DBAccess::PASSWORD, DBAccess::DATABASE_NAME));
        mysqli_select_db(DBAccess::$connection, "TecWeb") or die ("no database");
        if (!$access->getConnection())
            return null;
        else return $access;
    }

    public function getConnection() {
        return DBAccess::$connection;
    }

    public function setConnection($connection) {
        DBAccess::$connection = $connection;
    }
}

?>