<?php

namespace App\Imports;

use App\Models\Session;
use App\Models\SessionStream;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SessionsImport implements ToModel, WithHeadingRow, WithEvents
{

    use RegistersEventListeners;

    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        $session = new Session();
        $session->title = [
            "en" => $row["title_en"],
            "fr" => $row["title_fr"],
        ];
        $session->description = [
            "en" => $row["description_en"],
            "fr" => $row["description_fr"],
        ];

        if (!empty($row["stream"])) {
            $session->stream()->associate(SessionStream::find($row['stream']));
            $session->zoom_meeting_id = -1;
        }

        $session->start = Carbon::createFromFormat('Y-m-d H:i', $row['date'] . " " . $row['start_est']);
        $session->end = Carbon::createFromFormat('Y-m-d H:i', $row['date'] . " " . $row['end_est']);

        $session->is_published = true;

        return $session;
    }
}
