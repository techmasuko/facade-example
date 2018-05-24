<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Messenger extends Facade
{
    protected static function getFacadeAccessor()
    {
        dump('Call getFacadeAccesor');
        return 'message';
    }
}
