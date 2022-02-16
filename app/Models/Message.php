<?php

namespace App\Models;

use App\Traits\UuidAsKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use UuidAsKey, HasFactory;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'from_id', 'to_id', 'body', 'attachment', 'seen'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
