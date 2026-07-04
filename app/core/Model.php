<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Base Model
|--------------------------------------------------------------------------
| Seluruh model akan mewarisi class ini sehingga
| otomatis memiliki koneksi ke database.
*/

class Model
{
    /**
     * Object Database.
     */
    protected Database $db;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }
}