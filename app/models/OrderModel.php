<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Order Model
|--------------------------------------------------------------------------
| Bertugas menangani seluruh operasi database yang berkaitan
| dengan tabel orders.
|--------------------------------------------------------------------------
*/

class OrderModel extends Model
{
    /**
     * Menyimpan data order.
     *
     * @param array $data
     * @return int
     */
    public function create(array $data): int
    {
        $sql = "
            INSERT INTO orders
            (
                user_id,
                order_number,
                recipient_name,
                recipient_phone,
                shipping_address,
                note,
                subtotal,
                shipping_cost,
                total_price,
                shipping_method,
                status
            )
            VALUES
            (
                :user_id,
                :order_number,
                :recipient_name,
                :recipient_phone,
                :shipping_address,
                :note,
                :subtotal,
                :shipping_cost,
                :total_price,
                :shipping_method,
                :status
            )
        ";

        $this->db->query($sql);

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':order_number', $data['order_number']);
        $this->db->bind(':recipient_name', $data['recipient_name']);
        $this->db->bind(':recipient_phone', $data['recipient_phone']);
        $this->db->bind(':shipping_address', $data['shipping_address']);
        $this->db->bind(':note', $data['note']);
        $this->db->bind(':subtotal', $data['subtotal']);
        $this->db->bind(':shipping_cost', $data['shipping_cost']);
        $this->db->bind(':total_price', $data['total_price']);
        $this->db->bind(':shipping_method', $data['shipping_method']);
        $this->db->bind(':status', $data['status']);

        $this->db->execute();

        return (int) $this->db->lastInsertId();
    }

    /**
     * Mengambil order berdasarkan ID.
     */
    public function find(int $id): array|false
    {
        $this->db->query("
            SELECT *
            FROM orders
            WHERE id = :id
            LIMIT 1
        ");

        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    /**
     * Mengambil order berdasarkan nomor order.
     */
    public function findByNumber(string $orderNumber): array|false
    {
        $this->db->query("
            SELECT *
            FROM orders
            WHERE order_number = :order_number
            LIMIT 1
        ");

        $this->db->bind(':order_number', $orderNumber);

        return $this->db->single();
    }

    /**
     * Mengambil seluruh order milik user.
     */
    public function getByUser(int $userId): array
    {
        $this->db->query("
            SELECT *
            FROM orders
            WHERE user_id = :user_id
            ORDER BY created_at DESC
        ");

        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    /**
     * Mengubah status order.
     */
    public function updateStatus(
        int $id,
        string $status
    ): bool {

        $this->db->query("
            UPDATE orders
            SET status = :status
            WHERE id = :id
        ");

        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }
}