<?php


namespace core\support;


class postChecker
{

    public function isTheseParametersAvailable($params)
    {
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                return false;
            }
        }
        return true;
    }

}