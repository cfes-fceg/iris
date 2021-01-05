<?php


namespace App\Support;


use Carbon\Carbon;
use MacsiDigital\Zoom\Facades\Zoom as ZoomClient;

class Zoom
{
    private static array $DefaultMeeting = [
        'topic' => 'CELC 2021 | CCLI 2021',
        'type' => 3
    ];


    public static function getJoinUrl($meeting_id): string
    {
        $meeting = ZoomClient::meeting()->find($meeting_id);
        return $meeting->join_url;
    }

    public static function createMeeting(string $title, string $user_email)
    {
        $user = ZoomClient::user()->find($user_email);

        return $user->meetings()->create(array_merge(self::$DefaultMeeting, [
            'topic' => $title,
        ]));
    }

    public static function getMeeting(string $id)
    {
        return ZoomClient::meeting()->find($id);
    }
}
