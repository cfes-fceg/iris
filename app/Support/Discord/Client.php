<?php

namespace App\Support\Discord;

use App;
use Discord\InteractionResponseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PhpParser\Error;
use Discord\Interaction;
use RestCord\DiscordClient;

class Client
{
    private const TEST_GUILD_ID = 795410298797817876;
    private const CFES_GUILD_ID = 754097509290344615;

    const API_BASE_URI = 'https://discord.com/api/v8/';

    private const CREATE_COMMAND_API_PATH = self::API_BASE_URI . "applications/:application_id/guilds/:guild_id/commands";
    private const COMMAND_API_PATH = self::API_BASE_URI . "applications/:application_id/guilds/:guild_id/commands/:command_id";

//    private const LIST_GUILD_ROLES = self::API_BASE_URI . "guilds/:guild_id/roles";

    private const CONFERENCE_COMMAND = [
        "name" => "iris",
        "options" => [
            [
                "name" => "register",
                "description" => "Link your account ",
                "type" => 1, // 1 is type SUB_COMMAND
                "options" => [
                    [
                        "name" => "user-code",
                        "description" => "Unique access code provided in your IRIS account",
                        "type" => 3,
                        "required" => true
                    ]
                ]
            ],
            [
                "name" => "leave",
                "description" => "Leave conference Discord channels",
                "type" => 1
            ],
            [
                "name" => "join",
                "description" => "Join conference Discord channels",
                "type" => 1
            ]
        ]
    ];

    private string $token;
    public array $application;

    private DiscordClient $client;
    private int $guild_id;

    /**
     * HTTP client constructor.
     *
     */
    public function __construct()
    {
        if (App::environment() == "local")
            $this->guild_id = self::TEST_GUILD_ID;
        else
            $this->guild_id = self::CFES_GUILD_ID;

        $this->token = config("app.discord.token");
        $this->application = $this->getApplication();

        $this->client = new DiscordClient(['token' => $this->token]); // Token is required

    }

    public function getApplication(): array
    {
        return Http::withHeaders([
            'Authorization' => "Bot " . $this->token,
        ])->get(self::API_BASE_URI . "oauth2/applications/@me")->json();
    }

    private function replace_params($parameters, $path)
    {
        foreach ($parameters as $key => $param) {
            $path = str_replace(":" . $key, $param, $path);
        }

        return $path;
    }

    public function updateCommand($command_id): array
    {
        $response = Http::withHeaders([
            'Authorization' => "Bot " . $this->token,
        ])->asJson()->patch($this->replace_params([
            'application_id' => $this->application['id'],
            'command_id' => $command_id,
            'guild_id' => $this->guild_id
        ], self::COMMAND_API_PATH), $this->prepareCommandObj());
        if ($response->status() == 200)
            return $response->json();
        else {
            Log::debug($response);
            throw new Error("Update command failed");
        }
    }

    public function createCommand(): array
    {
        $response = Http::withHeaders([
            'Authorization' => "Bot " . $this->token,
        ])->asJson()->post($this->replace_params([
            'application_id' => $this->application['id'],
            'guild_id' => $this->guild_id
        ], self::CREATE_COMMAND_API_PATH), $this->prepareCommandObj());
        if ($response->status() == 201)
            return $response->json();
        else {
            Log::debug($response);
            throw new Error("Create command failed");
        }
    }

    public function listCommands(): array
    {
        $response = Http::withHeaders([
            'Authorization' => "Bot " . $this->token,
        ])->asJson()->get($this->replace_params([
            'application_id' => $this->application['id'],
            'guild_id' => $this->guild_id
        ], self::CREATE_COMMAND_API_PATH));
        if ($response->status() == 200)
            return $response->json();
        else {
            Log::debug($response);
            throw new Error("List command failed");
        }
    }

    public function deleteCommand($command_id)
    {
        $response = Http::withHeaders([
            'Authorization' => "Bot " . $this->token,
        ])->asJson()->delete($this->replace_params([
            'application_id' => $this->application['id'],
            'command_id' => $command_id,
            'guild_id' => $this->guild_id
        ], self::COMMAND_API_PATH));
        if ($response->status() != 204) {
            Log::debug($response);
            throw new Error("Delete command failed");
        }
    }

    /**
     * Handles an HTTP request to the server.
     *
     * @param Request $request
     */
    public function validateSignature(Request $request)
    {
        // validate request with public key
        $signature = $request->header('X-Signature-Ed25519');
        $timestamp = $request->header('X-Signature-Timestamp');

        if (empty($signature) || empty($timestamp) || !Interaction::verifyKey((string)$request->getContent(), $signature, $timestamp, config('app.discord.pubkey'))) {
            abort(401);
        }
    }

    public function createInteractionResponseMessage($message): array
    {
        return [
            "type" => InteractionResponseType::CHANNEL_MESSAGE_WITH_SOURCE,
            "data" => [
                "content" => $message
            ]
        ];
    }

    public function getRole()
    {
        foreach ($this->getGuildRoles() as $role) {
            if ($role->name == config('app.discord.conference_role'))
                return $role;
        }
        return null;
    }

    public function getGuildRoles(): array
    {
        return $this->client->guild->getGuildRoles(['guild.id' => $this->guild_id]);
    }

    public function assignGuildRole($user_id, $role_id)
    {
        $this->client->guild->addGuildMemberRole(['user.id' => $user_id, 'role.id' => $role_id, 'guild.id' => $this->guild_id]);
    }

    public function removeGuildRole($user_id, $role_id)
    {
        $this->client->guild->removeGuildMemberRole(['user.id' => $user_id, 'role.id' => $role_id, 'guild.id' => $this->guild_id]);
    }

    private function prepareCommandObj(): array
    {
        $command = self::CONFERENCE_COMMAND;
        $command['description'] = "Use these commands to register & access channels for ".config('app.name');
        return $command;
    }

}
