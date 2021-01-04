<?php

namespace App\Http\Controllers;

use App\Support\Discord\Client;
use Discord\InteractionResponseFlags;
use Discord\InteractionResponseType;
use Illuminate\Http\Request;
use Log;

class DiscordInteractionController extends Controller
{
    private Client $discordClient;
    private $guild_id;

    public function __invoke(Request $request)
    {
        $this->boot();
        $this->discordClient->validateSignature($request);
        return $this->processRequest($request);
    }

    private function processRequest(Request $request)
    {
        $data = $request->json();
        Log::debug("", $data->all());

        if ($data->getInt("type") == InteractionResponseType::PONG) {
            return response()->json(["type" => InteractionResponseType::PONG]);
        }

        switch ($data->get('data')['options'][0]['name']) {
            case "register":
                return response()->json($this->discordClient->createInteractionResponseMessage("You did a register"));
            case "join":
                return response()->json($this->discordClient->createInteractionResponseMessage("You did a join"));
            case "leave":
                return response()->json($this->discordClient->createInteractionResponseMessage("You did a leave"));
        }

        return response();
    }

    private function doJoin($data) {
        $user_id = $data->get('member')['user']['id'];
        $this->discordClient->assignGuildRole(intval($user_id), $this->discordClient->getCelcRole()->id);
    }

    private function doRegister($data) {

    }

    private function doLeave($data) {

    }

    private function boot()
    {
        $this->discordClient = new Client();
    }
}
