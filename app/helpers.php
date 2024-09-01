<?php

use Illuminate\Support\Facades\Auth;

function fill_with_default_value(&$array, $keys, $default)
{
    foreach ($keys as $key) {
        if (empty($array[$key])) {
            $array[$key] = $default;
        }
    }
}

function numberFromInput($input)
{
    return floatval(str_replace(',', '.', str_replace('.', '', $input)));
}

function ensure_user_can_access($resource, $message = 'ACCESS DENIED', $code = 403)
{
    /** @disregard P1009 */
    if (!Auth::user()->canAccess($resource))
        abort($code, $message);
}

function datetime_from_input($str)
{
    $input = explode(' ', $str);
    $date = explode('-', $input[0]);

    $out =  "$date[2]-$date[1]-$date[0]";
    if (count($input) == 2) {
        $out .=  " $input[1]";
    }

    return $out;
}

function extract_daterange($daterange)
{
    if (preg_match("/^([0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])) - ([0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]))$/", $daterange, $matches)) {
        return [$matches[1], $matches[4]];
    }
    return false;
}

function format_number($number, int $prec = 0)
{
    return number_format($number, $prec, ',', '.');
}

function str_to_double($str)
{
    return doubleVal(str_replace('.', '', $str));
}

function str_to_int($str)
{
    return intVal(str_replace('.', '', $str));
}

function format_datetime($date, $format = 'dd-MM-yyyy HH:mm:ss', $locale = null)
{
    if (!$date) {
        return '?';
    }
    if (!$date instanceof DateTime) {
        $date = new DateTime($date);
    }
    return IntlDateFormatter::formatObject($date, $format, $locale);
}

function format_date($date, $format = 'dd-MM-yyyy', $locale = null)
{
    if (!$date instanceof DateTime) {
        $date = new DateTime($date);
    }
    return IntlDateFormatter::formatObject($date, $format, $locale);
}

function wa_send_url($contact)
{
    $contact = str_replace('-', '', $contact);
    if (substr($contact, 0, 1) == '0') {
        $contact = '62' . substr($contact, 1, strlen($contact));
    }
    if (strlen($contact) > 10) {
        return "https://web.whatsapp.com/send?phone=$contact";
    }
    return '#';
}

function month_names($month)
{
    switch ((int)$month) {
        case 1:
            return "Januari";
        case 2:
            return "Februari";
        case 3:
            return "Maret";
        case 4:
            return "April";
        case 5:
            return "Mei";
        case 6:
            return "Juni";
        case 7:
            return "Juli";
        case 8:
            return "Agustus";
        case 9:
            return "September";
        case 10:
            return "Oktober";
        case 11:
            return "November";
        case 12:
            return "Desember";
    }
}
