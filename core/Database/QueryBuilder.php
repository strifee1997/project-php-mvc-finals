<?php

declare(strict_types=1);

namespace Core\Database;

use PDO;

class QueryBuilder
{
    public function __construct(private PDO $pdo) {}

    public function selectAll(string $table): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectById(string $table, int $id): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function insert(string $table, array $data): bool
    {
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})";
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function deleteById(string $table, int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    public function updateById(string $table, int $id, array $data): bool
    {
        $setClause = [];
        foreach ($data as $key => $value) {
            $setClause[] = "{$key} = :{$key}";
        }
        $set = implode(', ', $setClause);
        
        $sql = "UPDATE {$table} SET {$set} WHERE id = :id";
        
        // Add the ID to our data array so PDO can bind it to the WHERE clause
        $data['id'] = $id;
        
        return $this->pdo->prepare($sql)->execute($data);
    }
    public function search(string $table, string $column, string $keyword): array
    {
        // Use the LIKE operator for partial matching and bind the keyword safely
        $stmt = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$column} LIKE :keyword");
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        
        return $stmt->fetchAll();
    }
}