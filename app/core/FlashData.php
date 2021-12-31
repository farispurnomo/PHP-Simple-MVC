<?php

class FlashData
{
    public static function setMessage($key, $value, $type = '')
    {
        if ($type != '') {
            $_SESSION[$key] = self::renderAlert($type, $value);
        } else {
            $_SESSION[$key] = $value;
        }
    }

    public static function getMessage($key)
    {
        if (isset($_SESSION[$key])) {
            $msg =  $_SESSION[$key];
            unset($_SESSION[$key]);
            echo $msg;
        }
    }

    public static function renderAlert($type, $value)
    {
        // alert bootstrap 5
        switch ($type) {
            case 'primary':
            case 'success':
                $symbol = '<i class="fa fa-check"></i>';
                break;

            case 'warning':
                $symbol = '<i class="fa fa-exclamation-triangle"></i>';
                break;

            case 'danger':
                $symbol = '<i class="fa fa-times"></i>';
                break;

            default: // info
                $symbol = '<i class="fa fa-info-circle"></i>';
                break;
        }
        return '<div class="alert alert-' . $type . '" role="alert">' . $symbol . ' ' . $value . '</div>';
    }
}
