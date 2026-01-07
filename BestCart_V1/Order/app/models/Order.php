<?php
class Order
{
    public static function create(array $payload): int
    {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare('
            INSERT INTO orders (customer_name, total_amount, status, order_date, shipping_address, billing_address, order_items, email)
            VALUES (:customer_name, :total_amount, :status, CURDATE(), :shipping_address, :billing_address, :order_items, :email)
        ');
        $stmt->execute([
            ':customer_name' => $payload['customer_name'],
            ':total_amount' => $payload['total_amount'],
            ':status' => $payload['status'],
            ':shipping_address' => $payload['shipping_address'],
            ':billing_address' => $payload['billing_address'],
            ':order_items' => $payload['order_items'],
            ':email' => $payload['email'],
        ]);
        return (int)$pdo->lastInsertId();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function all(int $limit = 50): array
    {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare('SELECT id, customer_name, total_amount, status, order_date, email FROM orders ORDER BY id DESC LIMIT :lim');
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
