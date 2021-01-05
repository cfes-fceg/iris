<?php


namespace App\Support;


use Carbon\Carbon;
use MacsiDigital\Zoom\Facades\Zoom as ZoomClient;

class Zoom
{
    public static function getJoinUrl($meeting_id): string
    {
        $meeting = ZoomClient::meeting()->find($meeting_id);
        return $meeting->join_url;
    }

    public static function createMeeting(string $title, \DateTimeInterface $start, \DateTimeInterface $end)
    {

    }
}
