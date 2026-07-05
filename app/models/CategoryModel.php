<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Category Model
|--------------------------------------------------------------------------
| Model ini bertugas menangani seluruh operasi database
| yang berkaitan dengan kategori produk.
|--------------------------------------------------------------------------
*/

class CategoryModel extends Model
{
    /**
     * Mengambil seluruh kategori.
     *
     * @return array
     */
    public function getAll(): array
    {
        $sql = "
            SELECT
                id,
                name,
                slug
            FROM categories
            ORDER BY name ASC
        ";

        $this->db->query($sql);

        return $this->db->resultSet();
    }

    /**
     * Mengambil kategori berdasarkan ID.
     *
     * @param int $id
     * @return array|false
     */
    public function findById(int $id)
    {
        $sql = "
            SELECT
                id,
                name,
                slug
            FROM categories
            WHERE id = :id
            LIMIT 1
        ";

        $this->db->query($sql);

        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    /**
     * Mengambil kategori berdasarkan slug.
     *
     * @param string $slug
     * @return array|false
     */
    public function findBySlug(string $slug)
    {
        $sql = "
            SELECT
                id,
                name,
                slug
            FROM categories
            WHERE slug = :slug
            LIMIT 1
        ";

        $this->db->query($sql);

        $this->db->bind(':slug', $slug);

        return $this->db->single();
    }
}