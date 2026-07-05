<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Order Item Model
|--------------------------------------------------------------------------
| Bertugas menangani seluruh operasi database pada tabel order_items.
|--------------------------------------------------------------------------
*/

class OrderItemModel extends Model
{
    /**
     * Menyimpan satu item pesanan.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $this->db->query("
            INSERT INTO order_items
            (
                order_id,
                product_id,
                product_name,
                product_price,
                quantity,
                subtotal
            )
            VALUES
            (
                :order_id,
                :product_id,
                :product_name,
                :product_price,
                :quantity,
                :subtotal
            )
        ");

        $this->db->bind(':order_id', $data['order_id']);
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':product_name', $data['product_name']);
        $this->db->bind(':product_price', $data['product_price']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':subtotal', $data['subtotal']);

        return $this->db->execute();
    }

    /**
     * Mengambil seluruh item berdasarkan order.
     *
     * @param int $orderId
     * @return array
     */
    public function getByOrder(int $orderId): array
    {
        $this->db->query("
            SELECT *
            FROM order_items
            WHERE order_id = :order_id
            ORDER BY id ASC
        ");

        $this->db->bind(':order_id', $orderId);

        return $this->db->resultSet();
    }
}