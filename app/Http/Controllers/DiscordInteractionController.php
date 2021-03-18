<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\Discord\Client;
use Discord\InteractionResponseType;
use Illuminate\Http\Request;

class DiscordInteractionController extends Controller
{
    private Client $discordClient;

    public function __invoke(Request $request)
    {
        try {
            $this->boot();
            $this->discordClient->validateSignature($request);
            return $this->processRequest($request);
        } catch (\Exception $e) {
            return response()->json($this->discordClient->createInteractionResponseMessage("Sorry, something went wrong there. If you continue to see this message, contact an admin."));
        }
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
        if (!isset($user) || $user->discord_user_id == null) {
            return response()->json($this->discordClient->createInteractionResponseMessage("<@{$user_id}> You aren't registered!"));
        }
        $this->discordClient->assignGuildRole(intval($user_id), $this->discordClient->getRole()->id);

        return response()->json($this->discordClient->createInteractionResponseMessage("<@{$user_id}> your roles have been updated!"));
    }

    private function doRegister($user_id, $registration_code)
    {
        $user = User::where('discord_registration_id', '=', $registration_code)->get()->first();
        if(!isset($user)) {
            return response()->json($this->discordClient->createInteractionResponseMessage("<@{$user_id}> I couldn't find that code. Did you enter it correctly?"));
        }
        if ($user->discord_user_id != null) {
            return response()->json($this->discordClient->createInteractionResponseMessage("<@{$user_id}> This code has already been used"));
        }
        $user->update(['discord_user_id' => $user_id]);
        $this->discordClient->assignGuildRole(intval($user_id), $this->discordClient->getRole()->id);

        return response()->json($this->discordClient->createInteractionResponseMessage("<@{$user_id}> has registered!"));
    }

    private function doLeave($user_id)
    {
        $user = User::where('discord_user_id', '=', $user_id)->get()->first();
        if (!isset($user) || $user->discord_user_id == null) {
            return response()->json($this->discordClient->createInteractionResponseMessage("<@{$user_id}> You aren't registered!"));
        }
        $this->discordClient->removeGuildRole(intval($user_id), $this->discordClient->getRole()->id);

        return response()->json($this->discordClient->createInteractionResponseMessage("Goodbye <@{$user_id}>! We hope you enjoyed ".config('app.name')));
    }

    private function boot()
    {
        $this->discordClient = new Client();
    }
}
