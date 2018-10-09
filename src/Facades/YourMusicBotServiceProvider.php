<?php

namespace YourMusicBotAPI\Facades;

use Illuminate\Support\ServiceProvider;
use \YourMusicBotAPI\YourMusicBot;

class YourMusicBotServiceProvider extends ServiceProvider
{

    public function register()
    {
        \App::singleton('yourmusicbot', function () {
            return new YourMusicBot();
        });
    }
    
}