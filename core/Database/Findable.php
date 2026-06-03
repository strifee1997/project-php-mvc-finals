<?php
//read, Interface Segregation Principle
declare(strict_types=1);

namespace Core\Database;

interface Findable
{
    public function find(int $id): mixed;
    public function all(): array;
}
