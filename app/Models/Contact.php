<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database\Model;

class Contact extends Model
{
    protected string $table = 'contacts';

    public ?int $id = null;
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $tags = '';
    
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function save(array $data = []): bool
    {
        if ($this->id) {
            $sql = "UPDATE {$this->table} SET name=:name, email=:email, phone=:phone, tags=:tags WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'tags' => $this->tags
            ]);
        } else {
            $sql = "INSERT INTO {$this->table} (name, email, phone, tags) VALUES (:name, :email, :phone, :tags)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'tags' => $this->tags
            ]);
        }
    }
}
