<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Session extends Model
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
        'start',
        'end',
        'zoom_meeting_id',
        'is_published',
        'session_stream_id'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    function stream(): BelongsTo
    {
        return $this->belongsTo(SessionStream::class, 'session_stream_id');
    }

    public function formattedDate($timezone_str) {
        $date = $this->start->shiftTimezone($timezone_str)->format('D, d M Y');
        $startTime = $this->start->shiftTimezone($timezone_str)->format('h:m');
        $endTime = $this->end->shiftTimezone($timezone_str)->format('h:m');
        return $date." [".$startTime." - ".$endTime."]";
    }
}
