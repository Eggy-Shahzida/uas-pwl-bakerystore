<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Product Model
|--------------------------------------------------------------------------
| Bertugas menangani seluruh operasi database yang berkaitan
| dengan produk.
|--------------------------------------------------------------------------
*/

class ProductModel extends Model
{
    /**
     * Mengambil seluruh produk aktif.
     *
     * @return array
     */
    public function getAll(): array
    {
        $sql = "
            SELECT
                p.*,
                c.name AS category_name,
                c.slug AS category_slug
            FROM products p
            INNER JOIN categories c
                ON c.id = p.category_id
            WHERE p.is_active = 1
            ORDER BY p.created_at DESC
        ";

        $this->db->query($sql);

        return $this->db->resultSet();
    }

    /**
     * Mengambil produk berdasarkan filter.
     */
    public function filter(
        ?int $categoryId = null,
        ?string $keyword = null
    ): array {

        $sql = "
            SELECT
                p.*,
                c.name AS category_name,
                c.slug AS category_slug
            FROM products p
            INNER JOIN categories c
                ON c.id = p.category_id
            WHERE
                p.is_active = 1
        ";

        /*
        |--------------------------------------------------------------------------
        | Filter kategori
        |--------------------------------------------------------------------------
        */

        if ($categoryId !== null) {

            $sql .= " AND p.category_id = :category_id";
        }

        /*
        |--------------------------------------------------------------------------
        | Pencarian
        |--------------------------------------------------------------------------
        */

        if (!empty($keyword)) {

            $sql .= "
                AND (
                    p.name LIKE :keyword
                    OR
                    p.description LIKE :keyword
                )
            ";
        }

        $sql .= "
            ORDER BY
                p.created_at DESC
        ";

        $this->db->query($sql);

        if ($categoryId !== null) {

            $this->db->bind(':category_id', $categoryId);
        }

        if (!empty($keyword)) {

            $this->db->bind(
                ':keyword',
                '%' . $keyword . '%'
            );
        }

        return $this->db->resultSet();
    }

    /**
     * Mengambil beberapa produk terbaru.
     *
     * @param int $limit
     * @return array
     */
    public function latest(int $limit = 8): array
    {
        $sql = "
            SELECT
                p.*,
                c.name AS category_name,
                c.slug AS category_slug
            FROM products p
            INNER JOIN categories c
                ON c.id = p.category_id
            WHERE p.is_active = 1
            ORDER BY p.created_at DESC
            LIMIT :limit
        ";

        $this->db->query($sql);

        $this->db->bind(':limit', $limit);

        return $this->db->resultSet();
    }

    /**
     * Mengambil satu produk berdasarkan ID.
     *
     * @param int $id
     * @return array|false
     */
    public function findById(int $id): array|false
    {
        $sql = "
            SELECT
                p.*,
                c.name AS category_name,
                c.slug AS category_slug
            FROM products p
            INNER JOIN categories c
                ON c.id = p.category_id
            WHERE
                p.id = :id
            AND
                p.is_active = 1
            LIMIT 1
        ";

        $this->db->query($sql);

        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    /**
     * Mengambil satu produk berdasarkan slug.
     *
     * @param string $slug
     * @return array|false
     */
    public function findBySlug(string $slug): array|false
    {
        $sql = "
            SELECT
                p.*,
                c.name AS category_name,
                c.slug AS category_slug
            FROM products p
            INNER JOIN categories c
                ON c.id = p.category_id
            WHERE
                p.slug = :slug
            AND
                p.is_active = 1
            LIMIT 1
        ";

        $this->db->query($sql);

        $this->db->bind(':slug', $slug);

        return $this->db->single();
    }

    /**
     * Mengambil produk terkait berdasarkan kategori.
     *
     * @param int $categoryId
     * @param int $excludeId
     * @param int $limit
     * @return array
     */
    public function getRelatedProducts(
        int $categoryId,
        int $excludeId,
        int $limit = 4
    ): array {

        $sql = "
            SELECT
                p.*,
                c.name AS category_name
            FROM products p
            INNER JOIN categories c
                ON c.id = p.category_id
            WHERE
                p.category_id = :category_id
            AND
                p.id != :exclude_id
            AND
                p.is_active = 1
            ORDER BY RAND()
            LIMIT {$limit}
        ";

        $this->db->query($sql);

        $this->db->bind(':category_id', $categoryId);

        $this->db->bind(':exclude_id', $excludeId);

        return $this->db->resultSet();
    }

    /**
     * Mengambil produk berdasarkan kategori.
     *
     * @param int $categoryId
     * @return array
     */
    public function getByCategory(int $categoryId): array
    {
        $sql = "
            SELECT
                p.*,
                c.name AS category_name,
                c.slug AS category_slug
            FROM products p
            INNER JOIN categories c
                ON c.id = p.category_id
            WHERE
                p.category_id = :category_id
            AND
                p.is_active = 1
            ORDER BY p.created_at DESC
        ";

        $this->db->query($sql);

        $this->db->bind(':category_id', $categoryId);

        return $this->db->resultSet();
    }
}