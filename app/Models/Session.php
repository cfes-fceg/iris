<?php

namespace App\Models;

use App\Support\Zoom;
use Carbon\Carbon;
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
        $startTime = $this->start->format('H:i');
        $endTime = $this->end->format('H:i');
        //TODO USER TIMEZONE
        return $date . " [" . $startTime . " - " . $endTime . "] EST";
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($session) {
            if ($session->zoom_meeting_id == -1 && $session->stream != null && $session->stream->zoom_host != null) {
                $meeting = Zoom::createMeeting(
                    "CSE - CDDI 2021 | " . $session->title,
                    $session->start,
                    $session->start->diff($session->end),
                    $session->stream->zoom_host,
                );
                $session->zoom_meeting_id = $meeting->id;
            }
        });
    }

    public function showJoinButton(): bool
    {
        if($this->start->sub(15, "minutes")->isBefore(Carbon::now()) && $this->end->add(15, "minutes")->isAfter(Carbon::now()))
            return true;
        else
            return false;
    }
}
