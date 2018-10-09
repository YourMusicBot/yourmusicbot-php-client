<?php

namespace YourMusicBotAPI\Facades;

use Illuminate\Support\Facades\Facade;

class YourMusicBotFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'yourmusicbot';
    }
}