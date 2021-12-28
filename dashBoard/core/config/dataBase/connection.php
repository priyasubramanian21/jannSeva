<?php
namespace database;

include "database.define.php";

use mysqli;

class connection
{

    private $conn;

    public function connect()
    {

        $this->conn = new mysqli(DB_Server, DB_User, DB_Password,DB_DataBases);

        return $this->conn;

    }


}