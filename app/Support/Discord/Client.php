<?php

namespace App\Support\Discord;

use App;
use Discord\InteractionResponseType;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use League\OAuth2\Client\Provider\GenericProvider;
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

    private const LIST_GUILD_ROLES = self::API_BASE_URI . "guilds/:guild_id/roles";

    private const CELC_COMMAND = [
        "name" => "celc",
        "description" => "Conference interactions for CELC 2021",
        "options" => [
            [
                "name" => "register",
                "description" => "Link your account ",
                "type" => 1, // 1 is type SUB_COMMAND
                "options" => [
                    [
                        "name" => "user-code",
                        "description" => "Unique access code provided by the conference web-app",
                        "type" => 3,
                        "required" => true
                    ]
                ]
            ],
            [
                "name" => "leave",
                "description" => "Leave CELC 2021 & related Discord channels",
                "type" => 1
            ],
            [
                "name" => "join",
                "description" => "Join CELC 2021 & related Discord channels",
                "type" => 1
            ]
        ]
    ];

    public static array $SNLGroupMap = [
        1 => 796211119303688203,
        2 => 796211139590881280,
        3 => 796211157182447618,
        4 => 796211176019197973,
        5 => 796211196336275486,
        6 => 796211215063711745,
        7 => 796479496060272700,
        8 => 796211237876137995,
        9 => 796211232314621972,
        10 => 796211284982759455,
        11 => 796211313344249916,
        12 => 796211335246774322,
        13 => 796211352041422894,
        14 => 796211389219864637,
        15 => 796211442696847381,
        16 => 796211460292345916,
        17 => 796211496656961536,
        18 => 796211520383746068,
        19 => 796211572891975700,
        20 => 796211592181317632,
        21 => 796478226016239626,
        22 => 796478443499159572,
        23 => 796478483600769054,
        24 => 796478535257948191,
        25 => 796478599884046416
    ];

    private $token;
    public $application;

    private $client;
    private $guild_id;

    /**
     * HTTP client constructor.
     *
     * @param string $token
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

    public function updateCelcCommand($command_id): array
    {
        $response = Http::withHeaders([
            'Authorization' => "Bot " . $this->token,
        ])->asJson()->patch($this->replace_params([
            'application_id' => $this->application['id'],
            'command_id' => $command_id,
            'guild_id' => $this->guild_id
        ], self::COMMAND_API_PATH), self::CELC_COMMAND);
        if ($response->status() == 200)
            return $response->json();
        else {
            Log::debug($response);
            throw new Error("Update command failed");
        }
    }

    public function createCelcCommand(): array
    {
        $response = Http::withHeaders([
            'Authorization' => "Bot " . $this->token,
        ])->asJson()->post($this->replace_params([
            'application_id' => $this->application['id'],
            'guild_id' => $this->guild_id
        ], self::CREATE_COMMAND_API_PATH), self::CELC_COMMAND);
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
        ])->asJson()->patch($this->replace_params([
            'application_id' => $this->application['id'],
            'guild_id' => $this->guild_id
        ], self::COMMAND_API_PATH), self::CELC_COMMAND);
        if ($response->status() == 200)
            return $response->json();
        else {
            Log::debug($response);
            throw new Error("Update command failed");
        }
    }

    public function deleteCelcCommand($command_id)
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

    private function request()
    {
        return Http::withHeaders([
            'Authorization' => "Bot " . $this->token,
        ])->asJson();
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
            "type" => InteractionResponseType::CHANNEL_MESSAGE,
            "data" => [
                "content" => $message
            ]
        ];
    }

    public function getCelcRole()
    {
        foreach ($this->getGuildRoles() as $role) {
            if ($role->name == "CELC 2021")
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
}
