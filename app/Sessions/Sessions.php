<?php

namespace App\Sessions;


class Sessions
{
    public static function SessionAluno($session)
    {
        if (!$session) {
            $url = URL_BASE;
            header("Location: $url/");
            die();
        }

        return $session;
    }

    public static function SessionCoordenador($session)
    {
        if (!$session) {
            $url = URL_BASE;
            header("Location: $url/");
            die();
        }
        return $session;
    }

    public static function SessionAdmin($session)
    {
        if (!$session) {
            $url = URL_BASE;
            header("Location: $url/");
            die();
        }
        return $session;
    }
    
}
