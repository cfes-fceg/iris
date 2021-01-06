<?php

namespace App\Models;

use App\Support\Zoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SessionStream extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = [
        'title',
        'description',
    ];

    protected $fillable = [
        'title',
        'description',
        'zoom_host'
    ];

    public function host_key(): string {
        return Zoom::getUser($this->zoom_host)->host_key;
    }
}
