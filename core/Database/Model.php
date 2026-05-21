<?php

declare(strict_types=1);

namespace Core\Database;

abstract class Model implements Findable, Persistable
{
    protected string $table;

    public function __construct(protected QueryBuilder $db) {}

    public function find(int $id): array|false
    {
        return $this->db->selectById($this->table, $id);
    }

    public function all(): array
    {
        return $this->db->selectAll($this->table);
    }

    public function save(array $data): bool
    {
        return $this->db->insert($this->table, $data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->db->updateById($this->table, $id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->db->deleteById($this->table, $id);
    }
    public function searchBy(string $column, string $keyword): array
    {
        return $this->db->search($this->table, $column, $keyword);
    }
}