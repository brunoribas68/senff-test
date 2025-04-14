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

if (!function_exists('excelDate')) {
    function excelDate($date) {
        if (!$date) return '';
        return \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($date);
    }
}
