<?php


namespace core\support;


class session
{

    public function start()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function notSet($Path)
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["login"]) or $_SESSION["login"] == false) {
            header("location:" . soPath . $Path);
            unset($_SESSION["login"]);
            unset($_SESSION["signup"]);
            unset($_SESSION["user"]);
        }
    }

    public function notSetS($Path, $key)
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION[$key]) or $_SESSION[$key] == false) {
            header("location:" . soPath . $Path);
            unset($_SESSION["login"]);
            unset($_SESSION["signup"]);
            unset($_SESSION["user"]);
        }
    }

    public function set($Path)
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["login"])) {
            header("location:" . soPath . $Path);
        }
    }

    public function sessionOut($Path)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION["login"]);
        unset($_SESSION["signup"]);
        unset($_SESSION["user"]);
        header("location:" . soPath . $Path);
    }
}
