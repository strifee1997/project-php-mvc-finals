<?php

declare(strict_types=1);

namespace Core\Database;

interface Findable
{
    public function find(int $id): array|false;
    public function all(): array;
}