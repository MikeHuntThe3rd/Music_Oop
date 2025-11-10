<?php

namespace Music\Models;
use Music\DB\db;
use PDO;
class model {
    private PDO $db;
    function __construct(){
        $db = db::getInstance();
    }
}