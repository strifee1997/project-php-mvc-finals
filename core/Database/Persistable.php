<?php

declare(strict_types=1);

namespace Core\Database;

interface Persistable
{
    public function save(array $data): bool;
    public function update(int $id, array $data): bool; // NEW!
    public function delete(int $id): bool;
}