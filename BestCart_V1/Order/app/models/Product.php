<?php
class Product
{
    public static function all(int $limit = 50): array
    {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare('SELECT id, name, price, quantity, image FROM products ORDER BY id ASC LIMIT :lim');
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare('SELECT id, name, price, quantity, image FROM products WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function stock(int $id): int
    {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare('SELECT quantity FROM products WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? (int)$row['quantity'] : 0;
    }
}
