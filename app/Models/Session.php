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

    public function formattedDate()
    {
        $date = $this->start->format('l, F d, Y');
        $startTime = $this->start->format('h:i');
        $endTime = $this->end->format('h:i');
        return $date . " [" . $startTime . " - " . $endTime . "]";
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($session) {
            if ($session->zoom_meeting_id == -1 && $session->stream != null && $session->stream->zoom_host != null) {
                $meeting = Zoom::createMeeting(
                    "CELC - CCLI 2021 | " . $session->title,
                    $session->start,
                    $session->start->diff($session->end),
                    $session->stream->zoom_host,
                );
                $session->zoom_meeting_id = $meeting->id;
            }
        });
    }
}
