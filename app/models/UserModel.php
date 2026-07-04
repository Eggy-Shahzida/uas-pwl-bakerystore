<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| User Model
|--------------------------------------------------------------------------
| Model untuk berinteraksi dengan tabel users.
| Seluruh query yang berhubungan dengan pengguna
| akan ditempatkan pada class ini.
*/

class UserModel extends Model
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Mencari user berdasarkan email.
     *
     * Akan digunakan saat proses login.
     */
    public function findByEmail(string $email)
    {
        $this->db->query("
            SELECT *
            FROM users
            WHERE email = :email
            LIMIT 1
        ");

        $this->db->bind(':email', $email);

        return $this->db->single();
    }

    /**
     * Menyimpan data user baru.
     *
     * Akan digunakan saat proses register.
     */
    public function create(array $data)
    {
        $this->db->query("
            INSERT INTO users
            (
                name,
                email,
                password,
                role
            )
            VALUES
            (
                :name,
                :email,
                :password,
                :role
            )
        ");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);

        // Password disimpan dalam bentuk hash
        $this->db->bind(
            ':password',
            password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            )
        );

        $this->db->bind(':role', $data['role']);

        $this->db->execute();

        return $this->db->rowCount() > 0;
    }

    /**
     * Mencari user berdasarkan ID.
     *
     * Akan digunakan untuk mengambil data user
     * yang sedang login.
     */
    public function findById(int $id)
    {
        $this->db->query("
            SELECT *
            FROM users
            WHERE id = :id
            LIMIT 1
        ");

        $this->db->bind(':id', $id);

        return $this->db->single();
    }
}