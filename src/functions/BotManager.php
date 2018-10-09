<?php

namespace YourMusicBotAPI;

class BotManager
{
    private $core;
    
    public function __construct(YourMusicBot $core)
    {
        $this->core = $core;
    }

    public function createBot() {
        $createBot = $this->core->webCall('products/musicbot/buy');
        $createBot = get_object_vars($createBot);
        return $createBot["success"] == "false" ? "Error: ".$createBot["message"] : $createBot["botId"];
    }

    public function startBot($id) {

        $parameters = [
            'botId' => $id,
        ];

        return $this->core->webCall('products/musicbot/start', $parameters);
    }

    public function stopBot($id) {
        $parameters = [
            'botId' => $id,
        ];

        return $this->core->webCall('products/musicbot/stop', $parameters);
    }

    public function setBotSettings($id, $settings = [])
    {
        $parameters = [
            'botId' => $id,
            'settings' => $settings
        ];

        return $this->core->webCall("products/musicbot/settings/save", $parameters);

    }

    public function getBotSettings($id)
    {
        $parameters = [
            'botId' => $id,
        ];
        
        return $this->core->webCall('products/musicbot/settings', $parameters);
    }

    // type = radio, other
    public function playStream($id, $url, $type = "radio")
    {
        $parameters = [
            'type' => $type,
            'botId' => $id,
            'url' => $url,
        ];
        return $this->core->webCall('products/musicbot/play', $parameters);
    }

    public function reinstallBot($id)
    {
        $parameters = [
            'botId' => $id,
        ];
        
        return $this->core->webCall('products/musicbot/reinstall', $parameters);
    }
}