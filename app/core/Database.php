<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Database Class
|--------------------------------------------------------------------------
| Class ini bertugas sebagai pembungkus (wrapper) PDO.
| Seluruh model akan menggunakan class ini untuk menjalankan query
| ke database tanpa berinteraksi langsung dengan PDO.
*/

class Database
{
    /**
     * Menyimpan object PDO.
     */
    private PDO $pdo;

    /**
     * Menyimpan Prepared Statement.
     */
    private PDOStatement $stmt;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * Membuat koneksi ke database.
     */
    private function connect(): void
    {
        $dsn = sprintf(
            "mysql:host=%s;dbname=%s;charset=%s",
            DB_HOST,
            DB_NAME,
            DB_CHARSET
        );

        try {

            $this->pdo = new PDO(
                $dsn,
                DB_USER,
                DB_PASS
            );

            $this->pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            $this->pdo->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );

        } catch (PDOException $e) {

            die("Koneksi database gagal : " . $e->getMessage());

        }
    }

    /**
     * Menyiapkan query SQL.
     *
     * TODO:
     * Menyimpan prepared statement ke $this->stmt
     */
    public function query(string $sql): void
    {
        $this->stmt = $this->pdo->prepare($sql);
    }

    /**
     * Mengikat nilai parameter pada query.
     *
     * TODO:
     * Menggunakan bindValue()
     */
    public function bind(
        string $parameter,
        mixed $value,
        ?int $type = null
    ): void
    {
        if ($type === null) {

            switch (true) {

                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue(
            $parameter,
            $value,
            $type
        );
    }

    /**
     * Menjalankan query.
     *
     * TODO:
     * Menjalankan execute()
     */
    public function execute(): bool
    {
        return $this->stmt->execute();
    }

    /**
     * Mengambil satu data.
     *
     * TODO:
     * execute()
     * fetch()
     */
    public function single(): array|false
    {
        $this->execute();

        return $this->stmt->fetch();
    }

    /**
     * Mengambil banyak data.
     *
     * TODO:
     * execute()
     * fetchAll()
     */
    public function resultSet(): array
    {
        $this->execute();

        return $this->stmt->fetchAll();
    }

    /**
     * Mengembalikan jumlah baris yang terpengaruh.
     *
     * TODO:
     * rowCount()
     */
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Mengambil ID terakhir setelah INSERT.
     *
     * TODO:
     * lastInsertId()
     */
    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * Mengembalikan object PDO.
     *
     * Digunakan jika suatu saat membutuhkan akses
     * langsung ke object PDO.
     */
    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}