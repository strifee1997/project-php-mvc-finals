<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database\Model;

class Contact extends Model
{
    // Tell the engine which database table this model represents
    protected string $table = 'contacts';
}