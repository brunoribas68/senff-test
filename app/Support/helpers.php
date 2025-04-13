<?php

if (! function_exists('getStatusColor')) {
    function getStatusColor($status)
    {
        return match (strtolower($status)) {
            'aberto' => 'warning',
            'em andamento' => 'primary',
            'fechado' => 'success',
            'cancelado' => 'secondary',
            default => 'black',
        };
    }
}
