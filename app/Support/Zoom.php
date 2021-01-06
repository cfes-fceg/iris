<?php


namespace App\Support;


use Carbon\Carbon;
use Carbon\CarbonInterval;
use MacsiDigital\Zoom\Facades\Zoom as ZoomClient;
use phpDocumentor\Reflection\Types\Integer;

class Zoom
{
    private static array $DefaultMeeting = [
        'topic' => 'CELC 2021 | CCLI 2021',
        'type' => 2,
        'settings' => [
            "join_before_host" => true,
            "jbh_time" => 5,
            "mute_upon_entry" => true,
            "approval_type" => 2,
            "audio" => "both",
            "auto_recording" => "none", //TODO
            "request_permission_to_unmute_participants" => true,
            "global_dial_in_countries" => [
                0 => "US",
                1 => "CA"
            ]
        ]

    ];


    public static function getJoinUrl($meeting_id): string
    {
        $meeting = ZoomClient::meeting()->find($meeting_id);
        return $meeting->join_url;
    }

    public static function createMeeting(string $title, Carbon $start, \DateInterval $duration, string $user_email)
    {
        $user = ZoomClient::user()->find($user_email);

        $attrs = array_merge(self::$DefaultMeeting, [
            'topic' => $title,
            'start_time' => $start,
            'duration' => (int) CarbonInterval::create($duration)->totalMinutes
        ]);

        return $user->meetings()->create($attrs);
    }

    public static function updateMeeting(int $meeting_id, string $title, Carbon $start, \DateInterval $duration)
    {
        $meeting = ZoomClient::meeting()->find($meeting_id);

        return $meeting->update([
            'topic' => $title,
            'start_time' => $start,
            'duration' => (int) CarbonInterval::create($duration)->totalMinutes
        ]);
    }

    public static function getMeeting(string $id)
    {
        return ZoomClient::meeting()->find($id);
    }
}
