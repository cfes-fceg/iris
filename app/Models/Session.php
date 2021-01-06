<?php

namespace App\Models;

use App\Support\Zoom;
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

    public function formattedDate($timezone_str)
    {
        $date = $this->start->shiftTimezone($timezone_str)->format('D, d M Y');
        $startTime = $this->start->shiftTimezone($timezone_str)->format('h:m');
        $endTime = $this->end->shiftTimezone($timezone_str)->format('h:m');
        return $date . " [" . $startTime . " - " . $endTime . "]";
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($session) {
            if ($session->zoom_meeting_id == -1 && $session->stream != null) {
                $meeting = Zoom::createMeeting(
                    "CELC - CCLI 2021 | " . $session->title,
                    $session->start,
                    $session->end->diff($session->start),
                    $session->stream->zoom_host,
                );
                $session->zoom_meeting_id = $meeting->id;
            }
        });
    }
}
