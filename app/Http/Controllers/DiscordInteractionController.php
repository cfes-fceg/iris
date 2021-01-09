<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\Discord\Client;
use Discord\InteractionResponseType;
use Illuminate\Http\Request;
use Log;

class DiscordInteractionController extends Controller
{
    private Client $discordClient;

    public function __invoke(Request $request)
    {
        $this->boot();
        $this->discordClient->validateSignature($request);
        return $this->processRequest($request);
    }

    private function processRequest(Request $request)
    {
        $data = $request->json();

        if ($data->getInt("type") == InteractionResponseType::PONG) {
            return response()->json(["type" => InteractionResponseType::PONG]);
        }

        $user_id = $data->get('member')['user']['id'];
        $command = $data->get('data')['options'][0];

        switch ($command['name']) {
            case "register":
                return $this->doRegister($user_id, $command['options'][0]['value']);
            case "join":
                return $this->doJoin($user_id);
            case "leave":
                return $this->doLeave($user_id);
        }

        return response();
    }

    private function doJoin($user_id)
    {
        $user = User::where('discord_user_id', '=', $user_id)->get()->first();
        if (!isset($user) || $user->discord_user_id != null) {
            return response()->json($this->discordClient->createInteractionResponseMessage("You aren't registered!"));
        }
        $this->discordClient->assignGuildRole(intval($user_id), $this->discordClient->getCelcRole()->id);

        if ($user->snl_id != null && array_key_exists($user->snl_id, Client::$SNLGroupMap))
            $this->discordClient->assignGuildRole(intval($user_id), Client::$SNLGroupMap[$user->snl_id]);

        return response();
    }

    private function doRegister($user_id, $registration_code)
    {
        $user = User::where('discord_registration_id', '=', $registration_code)->get()->first();
        if (!isset($user) || $user->discord_user_id != null) {
            return response()->json($this->discordClient->createInteractionResponseMessage("This code has already been used"));
        }
        $user->update(['discord_user_id' => $user_id]);
        $this->discordClient->assignGuildRole(intval($user_id), $this->discordClient->getCelcRole()->id);

        if ($user->snl_id != null && array_key_exists($user->snl_id, Client::$SNLGroupMap))
            $this->discordClient->assignGuildRole(intval($user_id), Client::$SNLGroupMap[$user->snl_id]);

        return response()->json($this->discordClient->createInteractionResponseMessage("<@{$user_id}> has registered!"));
    }

    private function doLeave($user_id)
    {
        $user = User::where('discord_user_id', '=', $user_id)->get()->first();
        if (!isset($user) || $user->discord_user_id != null) {
            return response()->json($this->discordClient->createInteractionResponseMessage("You aren't registered!"));
        }
        $this->discordClient->removeGuildRole(intval($user_id), $this->discordClient->getCelcRole()->id);
        if ($user->snl_id != null && array_key_exists($user->snl_id, Client::$SNLGroupMap))
            $this->discordClient->removeGuildRole(intval($user_id), Client::$SNLGroupMap[$user->snl_id]);

        return response();
    }

    private function boot()
    {
        $this->discordClient = new Client();
    }
}
