<?php

use App\Models\InternalSetting;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


if (! function_exists('isActive')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param  string|array $route
     * @param  string       $className
     * @return string
     */
    function isActive($route, $className = 'active')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }
        if (Route::currentRouteName() == $route) {
            return $className;
        }
        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}

if (! function_exists('time_format')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param  string|array $route
     * @param  string       $className
     * @return string
     */
    function time_format($date, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($date);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'Tahun',
            'm' => 'Bulan',
            'w' => 'Minggu',
            'd' => 'Hari',
            'h' => 'Jam',
            'i' => 'Menit',
            's' => 'Detik',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' lalu' : 'Baru Saja';
    }
}

if (!function_exists('tanggal_indo')) {

    function tanggal_indo($tanggal)
    {
        if ($tanggal != null) {
            $bulan = array(
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $split = explode('-', $tanggal);

            return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0] . ' ';
        }
    }
}

if (!function_exists('timezone')) {

    function timezone()
    {
        $timezones = [
            'Africa/Abidjan' => 'Africa/Abidjan',
            'Africa/Accra' => 'Africa/Accra',
            'Africa/Addis_Ababa' => 'Africa/Addis_Ababa',
            'Africa/Algiers' => 'Africa/Algiers',
            'Africa/Asmara' => 'Africa/Asmara',
            'Africa/Bamako' => 'Africa/Bamako',
            'Africa/Bangui' => 'Africa/Bangui',
            'Africa/Banjul' => 'Africa/Banjul',
            'Africa/Bissau' => 'Africa/Bissau',
            'Africa/Blantyre' => 'Africa/Blantyre',
            'Africa/Brazzaville' => 'Africa/Brazzaville',
            'Africa/Bujumbura' => 'Africa/Bujumbura',
            'Africa/Cairo' => 'Africa/Cairo',
            'Africa/Casablanca' => 'Africa/Casablanca',
            'Africa/Ceuta' => 'Africa/Ceuta',
            'Africa/Conakry' => 'Africa/Conakry',
            'Africa/Dakar' => 'Africa/Dakar',
            'Africa/Dar_es_Salaam' => 'Africa/Dar_es_Salaam',
            'Africa/Djibouti' => 'Africa/Djibouti',
            'Africa/Douala' => 'Africa/Douala',
            'Africa/El_Aaiun' => 'Africa/El_Aaiun',
            'Africa/Freetown' => 'Africa/Freetown',
            'Africa/Gaborone' => 'Africa/Gaborone',
            'Africa/Harare' => 'Africa/Harare',
            'Africa/Johannesburg' => 'Africa/Johannesburg',
            'Africa/Kampala' => 'Africa/Kampala',
            'Africa/Khartoum' => 'Africa/Khartoum',
            'Africa/Kigali' => 'Africa/Kigali',
            'Africa/Kinshasa' => 'Africa/Kinshasa',
            'Africa/Lagos' => 'Africa/Lagos',
            'Africa/Libreville' => 'Africa/Libreville',
            'Africa/Luanda' => 'Africa/Luanda',
            'Africa/Lubumbashi' => 'Africa/Lubumbashi',
            'Africa/Lusaka' => 'Africa/Lusaka',
            'Africa/Malabo' => 'Africa/Malabo',
            'Africa/Maputo' => 'Africa/Maputo',
            'Africa/Maseru' => 'Africa/Maseru',
            'Africa/Mbabane' => 'Africa/Mbabane',
            'Africa/Mogadishu' => 'Africa/Mogadishu',
            'Africa/Monrovia' => 'Africa/Monrovia',
            'Africa/Nairobi' => 'Africa/Nairobi',
            'Africa/Ndjamena' => 'Africa/Ndjamena',
            'Africa/Niamey' => 'Africa/Niamey',
            'Africa/Nouakchott' => 'Africa/Nouakchott',
            'Africa/Ouagadougou' => 'Africa/Ouagadougou',
            'Africa/Porto-Novo' => 'Africa/Porto-Novo',
            'Africa/Sao_Tome' => 'Africa/Sao_Tome',
            'Africa/Timbuktu' => 'Africa/Timbuktu',
            'Africa/Tunis' => 'Africa/Tunis',
            'Africa/Windhoek' => 'Africa/Windhoek',
            'America/Adak' => 'America/Adak',
            'America/Anchorage' => 'America/Anchorage',
            'America/Anguilla' => 'America/Anguilla',
            'America/Antigua' => 'America/Antigua',
            'America/Araguaina' => 'America/Araguaina',
            'America/Argentina/Buenos_Aires' => 'America/Argentina/Buenos_Aires',
            'America/Argentina/Catamarca' => 'America/Argentina/Catamarca',
            'America/Argentina/ComodRivadavia' => 'America/Argentina/ComodRivadavia',
            'America/Argentina/Jujuy' => 'America/Argentina/Jujuy',
            'America/Argentina/La_Rioja' => 'America/Argentina/La_Rioja',
            'America/Argentina/Mendoza' => 'America/Argentina/Mendoza',
            'America/Argentina/Rio_Gallegos' => 'America/Argentina/Rio_Gallegos',
            'America/Argentina/Salta' => 'America/Argentina/Salta',
            'America/Argentina/San_Juan' => 'America/Argentina/San_Juan',
            'America/Argentina/San_Luis' => 'America/Argentina/San_Luis',
            'America/Argentina/Tucuman' => 'America/Argentina/Tucuman',
            'America/Argentina/Ushuaia' => 'America/Argentina/Ushuaia',
            'America/Aruba' => 'America/Aruba',
            'America/Asuncion' => 'America/Asuncion',
            'America/Atikokan' => 'America/Atikokan',
            'America/Bahia' => 'America/Bahia',
            'America/Bahia_Banderas' => 'America/Bahia_Banderas',
            'America/Barbados' => 'America/Barbados',
            'America/Belem' => 'America/Belem',
            'America/Belize' => 'America/Belize',
            'America/Benques' => 'America/Benques',
            'America/Blanc-Sablon' => 'America/Blanc-Sablon',
            'America/Boa_Vista' => 'America/Boa_Vista',
            'America/Bogota' => 'America/Bogota',
            'America/Boise' => 'America/Boise',
            'America/Cambridge_Bay' => 'America/Cambridge_Bay',
            'America/Campo_Grande' => 'America/Campo_Grande',
            'America/Cancun' => 'America/Cancun',
            'America/Caracas' => 'America/Caracas',
            'America/Cayenne' => 'America/Cayenne',
            'America/Cayman' => 'America/Cayman',
            'America/Chicago' => 'America/Chicago',
            'America/Chihuahua' => 'America/Chihuahua',
            'America/Costa_Rica' => 'America/Costa_Rica',
            'America/Cuiaba' => 'America/Cuiaba',
            'America/Curacao' => 'America/Curacao',
            'America/Danmarkshavn' => 'America/Danmarkshavn',
            'America/Dawson' => 'America/Dawson',
            'America/Dawson_Creek' => 'America/Dawson_Creek',
            'America/Denver' => 'America/Denver',
            'America/Detroit' => 'America/Detroit',
            'America/Dominica' => 'America/Dominica',
            'America/Edmonton' => 'America/Edmonton',
            'America/Eirunepe' => 'America/Eirunepe',
            'America/El_Salvador' => 'America/El_Salvador',
            'America/Fort_Nelson' => 'America/Fort_Nelson',
            'America/Fortaleza' => 'America/Fortaleza',
            'America/Glace_Bay' => 'America/Glace_Bay',
            'America/Godthab' => 'America/Godthab',
            'America/Goose_Bay' => 'America/Goose_Bay',
            'America/Grand_Turk' => 'America/Grand_Turk',
            'America/Grenada' => 'America/Grenada',
            'America/Guadeloupe' => 'America/Guadeloupe',
            'America/Guatemala' => 'America/Guatemala',
            'America/Guayaquil' => 'America/Guayaquil',
            'America/Guyana' => 'America/Guyana',
            'America/Halifax' => 'America/Halifax',
            'America/Havana' => 'America/Havana',
            'America/Hermosillo' => 'America/Hermosillo',
            'America/Indiana/Indianapolis' => 'America/Indiana/Indianapolis',
            'America/Indiana/Knox' => 'America/Indiana/Knox',
            'America/Indiana/Marengo' => 'America/Indiana/Marengo',
            'America/Indiana/Petersburg' => 'America/Indiana/Petersburg',
            'America/Indiana/Tell_City' => 'America/Indiana/Tell_City',
            'America/Indiana/Vincennes' => 'America/Indiana/Vincennes',
            'America/Indiana/Winamac' => 'America/Indiana/Winamac',
            'America/Inuvik' => 'America/Inuvik',
            'America/Iqaluit' => 'America/Iqaluit',
            'America/Jamaica' => 'America/Jamaica',
            'America/Jujuy' => 'America/Jujuy',
            'America/Juneau' => 'America/Juneau',
            'America/Kentucky/Louisville' => 'America/Kentucky/Louisville',
            'America/Kentucky/Monticello' => 'America/Kentucky/Monticello',
            'America/Kralendijk' => 'America/Kralendijk',
            'America/La_Paz' => 'America/La_Paz',
            'America/Lima' => 'America/Lima',
            'America/Los_Angeles' => 'America/Los_Angeles',
            'America/Lower_Princes' => 'America/Lower_Princes',
            'America/Maceio' => 'America/Maceio',
            'America/Managua' => 'America/Managua',
            'America/Manaus' => 'America/Manaus',
            'America/Marigot' => 'America/Marigot',
            'America/Martinique' => 'America/Martinique',
            'America/Matamoros' => 'America/Matamoros',
            'America/Mazatlan' => 'America/Mazatlan',
            'America/Mendoza' => 'America/Mendoza',
            'America/Menominee' => 'America/Menominee',
            'America/Mexico_City' => 'America/Mexico_City',
            'America/Miquelon' => 'America/Miquelon',
            'America/Moncton' => 'America/Moncton',
            'America/Monterrey' => 'America/Monterrey',
            'America/Montevideo' => 'America/Montevideo',
            'America/Montreal' => 'America/Montreal',
            'America/Montserrat' => 'America/Montserrat',
            'America/Nassau' => 'America/Nassau',
            'America/New_York' => 'America/New_York',
            'America/Nipigon' => 'America/Nipigon',
            'America/Nome' => 'America/Nome',
            'America/Noronha' => 'America/Noronha',
            'America/North_Dakota/Beulah' => 'America/North_Dakota/Beulah',
            'America/North_Dakota/Center' => 'America/North_Dakota/Center',
            'America/North_Dakota/New_Salem' => 'America/North_Dakota/New_Salem',
            'America/Ojinaga' => 'America/Ojinaga',
            'America/Panama' => 'America/Panama',
            'America/Pangnirtung' => 'America/Pangnirtung',
            'America/Paramaribo' => 'America/Paramaribo',
            'America/Phoenix' => 'America/Phoenix',
            'America/Port-au-Prince' => 'America/Port-au-Prince',
            'America/Port_of_Spain' => 'America/Port_of_Spain',
            'America/Puerto_Rico' => 'America/Puerto_Rico',
            'America/Punta_Arenas' => 'America/Punta_Arenas',
            'America/Rainy_River' => 'America/Rainy_River',
            'America/Rankin_Inlet' => 'America/Rankin_Inlet',
            'America/Recife' => 'America/Recife',
            'America/Regina' => 'America/Regina',
            'America/Resolute' => 'America/Resolute',
            'America/Rio_Branco' => 'America/Rio_Branco',
            'America/Santa_Isabel' => 'America/Santa_Isabel',
            'America/Santarem' => 'America/Santarem',
            'America/Santiago' => 'America/Santiago',
            'America/Santo_Domingo' => 'America/Santo_Domingo',
            'America/Sao_Paulo' => 'America/Sao_Paulo',
            'America/Scoresby_Sund' => 'America/Scoresby_Sund',
            'America/Sitka' => 'America/Sitka',
            'America/St_Barthelemy' => 'America/St_Barthelemy',
            'America/St_Johns' => 'America/St_Johns',
            'America/St_Kitts' => 'America/St_Kitts',
            'America/St_Lucia' => 'America/St_Lucia',
            'America/St_Thomas' => 'America/St_Thomas',
            'America/St_Vincent' => 'America/St_Vincent',
            'America/Swift_Current' => 'America/Swift_Current',
            'America/Tegucigalpa' => 'America/Tegucigalpa',
            'America/Thule' => 'America/Thule',
            'America/Thunder_Bay' => 'America/Thunder_Bay',
            'America/Tijuana' => 'America/Tijuana',
            'America/Toronto' => 'America/Toronto',
            'America/Tortola' => 'America/Tortola',
            'America/Vancouver' => 'America/Vancouver',
            'America/Whitehorse' => 'America/Whitehorse',
            'America/Winnipeg' => 'America/Winnipeg',
            'America/Yakutat' => 'America/Yakutat',
            'America/Yellowknife' => 'America/Yellowknife',
            'Antarctica/Palmer' => 'Antarctica/Palmer',
            'Antarctica/Rothera' => 'Antarctica/Rothera',
            'Antarctica/Scott' => 'Antarctica/Scott',
            'Antarctica/Syowa' => 'Antarctica/Syowa',
            'Antarctica/Vostok' => 'Antarctica/Vostok',
            'Asia/Almaty' => 'Asia/Almaty',
            'Asia/Amman' => 'Asia/Amman',
            'Asia/Anadyr' => 'Asia/Anadyr',
            'Asia/Aqtau' => 'Asia/Aqtau',
            'Asia/Aqtobe' => 'Asia/Aqtobe',
            'Asia/Ashgabat' => 'Asia/Ashgabat',
            'Asia/Baghdad' => 'Asia/Baghdad',
            'Asia/Baku' => 'Asia/Baku',
            'Asia/Bangkok' => 'Asia/Bangkok',
            'Asia/Barnaul' => 'Asia/Barnaul',
            'Asia/Beirut' => 'Asia/Beirut',
            'Asia/Bishkek' => 'Asia/Bishkek',
            'Asia/Brunei' => 'Asia/Brunei',
            'Asia/Calcutta' => 'Asia/Calcutta',
            'Asia/Choibalsan' => 'Asia/Choibalsan',
            'Asia/Chongqing' => 'Asia/Chongqing',
            'Asia/Colombo' => 'Asia/Colombo',
            'Asia/Damascus' => 'Asia/Damascus',
            'Asia/Dhaka' => 'Asia/Dhaka',
            'Asia/Dili' => 'Asia/Dili',
            'Asia/Dubai' => 'Asia/Dubai',
            'Asia/Dushanbe' => 'Asia/Dushanbe',
            'Asia/Gaza' => 'Asia/Gaza',
            'Asia/Hebron' => 'Asia/Hebron',
            'Asia/Ho_Chi_Minh' => 'Asia/Ho_Chi_Minh',
            'Asia/Hong_Kong' => 'Asia/Hong_Kong',
            'Asia/Hovd' => 'Asia/Hovd',
            'Asia/Irkutsk' => 'Asia/Irkutsk',
            'Asia/Jakarta' => 'Asia/Jakarta',
            'Asia/Jayapura' => 'Asia/Jayapura',
            'Asia/Jerusalem' => 'Asia/Jerusalem',
            'Asia/Kabul' => 'Asia/Kabul',
            'Asia/Kamchatka' => 'Asia/Kamchatka',
            'Asia/Karachi' => 'Asia/Karachi',
            'Asia/Kashgar' => 'Asia/Kashgar',
            'Asia/Kathmandu' => 'Asia/Kathmandu',
            'Asia/Kolkata' => 'Asia/Kolkata',
            'Asia/Krasnoyarsk' => 'Asia/Krasnoyarsk',
            'Asia/Kuala_Lumpur' => 'Asia/Kuala_Lumpur',
            'Asia/Kuching' => 'Asia/Kuching',
            'Asia/Kuwait' => 'Asia/Kuwait',
            'Asia/Macau' => 'Asia/Macau',
            'Asia/Magadan' => 'Asia/Magadan',
            'Asia/Makassar' => 'Asia/Makassar',
            'Asia/Manila' => 'Asia/Manila',
            'Asia/Muscat' => 'Asia/Muscat',
            'Asia/Nicosia' => 'Asia/Nicosia',
            'Asia/Novokuznetsk' => 'Asia/Novokuznetsk',
            'Asia/Novosibirsk' => 'Asia/Novosibirsk',
            'Asia/Omsk' => 'Asia/Omsk',
            'Asia/Oral' => 'Asia/Oral',
            'Asia/Phnom_Penh' => 'Asia/Phnom_Penh',
            'Asia/Pontianak' => 'Asia/Pontianak',
            'Asia/Pyongyang' => 'Asia/Pyongyang',
            'Asia/Qatar' => 'Asia/Qatar',
            'Asia/Qostanay' => 'Asia/Qostanay',
            'Asia/Qyzylorda' => 'Asia/Qyzylorda',
            'Asia/Riyadh' => 'Asia/Riyadh',
            'Asia/Sakhalin' => 'Asia/Sakhalin',
            'Asia/Samarkand' => 'Asia/Samarkand',
            'Asia/Seoul' => 'Asia/Seoul',
            'Asia/Shanghai' => 'Asia/Shanghai',
            'Asia/Singapore' => 'Asia/Singapore',
            'Asia/Srednekolymsk' => 'Asia/Srednekolymsk',
            'Asia/Taipei' => 'Asia/Taipei',
            'Asia/Tashkent' => 'Asia/Tashkent',
            'Asia/Tbilisi' => 'Asia/Tbilisi',
            'Asia/Tehran' => 'Asia/Tehran',
            'Asia/Tokyo' => 'Asia/Tokyo',
            'Asia/Tomsk' => 'Asia/Tomsk',
            'Asia/Ulaanbaatar' => 'Asia/Ulaanbaatar',
            'Asia/Urumqi' => 'Asia/Urumqi',
            'Asia/Ust-Nera' => 'Asia/Ust-Nera',
            'Asia/Vientiane' => 'Asia/Vientiane',
            'Asia/Vladivostok' => 'Asia/Vladivostok',
            'Asia/Yakutsk' => 'Asia/Yakutsk',
            'Asia/Yangon' => 'Asia/Yangon',
            'Asia/Yekaterinburg' => 'Asia/Yekaterinburg',
            'Asia/Yerevan' => 'Asia/Yerevan',
            'Atlantic/Azores' => 'Atlantic/Azores',
            'Atlantic/Bermuda' => 'Atlantic/Bermuda',
            'Atlantic/Canary' => 'Atlantic/Canary',
            'Atlantic/Cape_Verde' => 'Atlantic/Cape_Verde',
            'Atlantic/Faroe' => 'Atlantic/Faroe',
            'Atlantic/Madeira' => 'Atlantic/Madeira',
            'Atlantic/Reykjavik' => 'Atlantic/Reykjavik',
            'Atlantic/South_Georgia' => 'Atlantic/South_Georgia',
            'Atlantic/St_Helena' => 'Atlantic/St_Helena',
            'Atlantic/Stanley' => 'Atlantic/Stanley',
            'Australia/Adelaide' => 'Australia/Adelaide',
            'Australia/Brisbane' => 'Australia/Brisbane',
            'Australia/Broken_Hill' => 'Australia/Broken_Hill',
            'Australia/Currie' => 'Australia/Currie',
            'Australia/Darwin' => 'Australia/Darwin',
            'Australia/Hobart' => 'Australia/Hobart',
            'Australia/Lindeman' => 'Australia/Lindeman',
            'Australia/Lord_Howe' => 'Australia/Lord_Howe',
            'Australia/Melbourne' => 'Australia/Melbourne',
            'Australia/Perth' => 'Australia/Perth',
            'Australia/Sydney' => 'Australia/Sydney',
            'Europe/Amsterdam' => 'Europe/Amsterdam',
            'Europe/Andorra' => 'Europe/Andorra',
            'Europe/Astrakhan' => 'Europe/Astrakhan',
            'Europe/Athens' => 'Europe/Athens',
            'Europe/Belgrade' => 'Europe/Belgrade',
            'Europe/Berlin' => 'Europe/Berlin',
            'Europe/Bratislava' => 'Europe/Bratislava',
            'Europe/Brussels' => 'Europe/Brussels',
            'Europe/Bucharest' => 'Europe/Bucharest',
            'Europe/Budapest' => 'Europe/Budapest',
            'Europe/Busingen' => 'Europe/Busingen',
            'Europe/Chisinau' => 'Europe/Chisinau',
            'Europe/Copenhagen' => 'Europe/Copenhagen',
            'Europe/Dublin' => 'Europe/Dublin',
            'Europe/Gibraltar' => 'Europe/Gibraltar',
            'Europe/Guernsey' => 'Europe/Guernsey',
            'Europe/Helsinki' => 'Europe/Helsinki',
            'Europe/Isle_of_Man' => 'Europe/Isle_of_Man',
            'Europe/Istanbul' => 'Europe/Istanbul',
            'Europe/Jersey' => 'Europe/Jersey',
            'Europe/Kaliningrad' => 'Europe/Kaliningrad',
            'Europe/Kiev' => 'Europe/Kiev',
            'Europe/Kosice' => 'Europe/Kosice',
            'Europe/Lisbon' => 'Europe/Lisbon',
            'Europe/Ljubljana' => 'Europe/Ljubljana',
            'Europe/London' => 'Europe/London',
            'Europe/Luxembourg' => 'Europe/Luxembourg',
            'Europe/Madrid' => 'Europe/Madrid',
            'Europe/Malta' => 'Europe/Malta',
            'Europe/Mariehamn' => 'Europe/Mariehamn',
            'Europe/Minsk' => 'Europe/Minsk',
            'Europe/Monaco' => 'Europe/Monaco',
            'Europe/Moscow' => 'Europe/Moscow',
            'Europe/Nicosia' => 'Europe/Nicosia',
            'Europe/Oslo' => 'Europe/Oslo',
            'Europe/Paris' => 'Europe/Paris',
            'Europe/Podgorica' => 'Europe/Podgorica',
            'Europe/Prague' => 'Europe/Prague',
            'Europe/Riga' => 'Europe/Riga',
            'Europe/Rome' => 'Europe/Rome',
            'Europe/Samara' => 'Europe/Samara',
            'Europe/San_Marino' => 'Europe/San_Marino',
            'Europe/Sarajevo' => 'Europe/Sarajevo',
            'Europe/Saratov' => 'Europe/Saratov',
            'Europe/Simferopol' => 'Europe/Simferopol',
            'Europe/Skopje' => 'Europe/Skopje',
            'Europe/Sofia' => 'Europe/Sofia',
            'Europe/Stockholm' => 'Europe/Stockholm',
            'Europe/Tallinn' => 'Europe/Tallinn',
            'Europe/Tirane' => 'Europe/Tirane',
            'Europe/Uzhgorod' => 'Europe/Uzhgorod',
            'Europe/Vaduz' => 'Europe/Vaduz',
            'Europe/Vatican' => 'Europe/Vatican',
            'Europe/Vienna' => 'Europe/Vienna',
            'Europe/Vilnius' => 'Europe/Vilnius',
            'Europe/Volgograd' => 'Europe/Volgograd',
            'Europe/Warsaw' => 'Europe/Warsaw',
            'Europe/Zagreb' => 'Europe/Zagreb',
            'Europe/Zaporozhye' => 'Europe/Zaporozhye',
            'Europe/Zurich' => 'Europe/Zurich',
            'Indian/Antananarivo' => 'Indian/Antananarivo',
            'Indian/Chagos' => 'Indian/Chagos',
            'Indian/Christmas' => 'Indian/Christmas',
            'Indian/Cocos' => 'Indian/Cocos',
            'Indian/Comoro' => 'Indian/Comoro',
            'Indian/Kerguelen' => 'Indian/Kerguelen',
            'Indian/Mahe' => 'Indian/Mahe',
            'Indian/Maldives' => 'Indian/Maldives',
            'Indian/Mauritius' => 'Indian/Mauritius',
            'Indian/Reunion' => 'Indian/Reunion',
            'Pacific/Apia' => 'Pacific/Apia',
            'Pacific/Auckland' => 'Pacific/Auckland',
            'Pacific/Bougainville' => 'Pacific/Bougainville',
            'Pacific/Chatham' => 'Pacific/Chatham',
            'Pacific/Chuuk' => 'Pacific/Chuuk',
            'Pacific/Efate' => 'Pacific/Efate',
            'Pacific/Enderbury' => 'Pacific/Enderbury',
            'Pacific/Fakaofo' => 'Pacific/Fakaofo',
            'Pacific/Fiji' => 'Pacific/Fiji',
            'Pacific/Funafuti' => 'Pacific/Funafuti',
            'Pacific/Galapagos' => 'Pacific/Galapagos',
            'Pacific/Gambier' => 'Pacific/Gambier',
            'Pacific/Guadalcanal' => 'Pacific/Guadalcanal',
            'Pacific/Guam' => 'Pacific/Guam',
            'Pacific/Kiritimati' => 'Pacific/Kiritimati',
            'Pacific/Kosrae' => 'Pacific/Kosrae',
            'Pacific/Kwajalein' => 'Pacific/Kwajalein',
            'Pacific/Majuro' => 'Pacific/Majuro',
            'Pacific/Marquesas' => 'Pacific/Marquesas',
            'Pacific/Nauru' => 'Pacific/Nauru',
            'Pacific/Niue' => 'Pacific/Niue',
            'Pacific/Norfolk' => 'Pacific/Norfolk',
            'Pacific/Noumea' => 'Pacific/Noumea',
            'Pacific/Pago_Pago' => 'Pacific/Pago_Pago',
            'Pacific/Palau' => 'Pacific/Palau',
            'Pacific/Pitcairn' => 'Pacific/Pitcairn',
            'Pacific/Ponape' => 'Pacific/Ponape',
            'Pacific/Port_Moresby' => 'Pacific/Port_Moresby',
            'Pacific/Rarotonga' => 'Pacific/Rarotonga',
            'Pacific/Saipan' => 'Pacific/Saipan',
            'Pacific/Tahiti' => 'Pacific/Tahiti',
            'Pacific/Tarawa' => 'Pacific/Tarawa',
            'Pacific/Tongatapu' => 'Pacific/Tongatapu',
            'Pacific/Wake' => 'Pacific/Wake',
            'Pacific/Wallis' => 'Pacific/Wallis',
        ];

        return $timezones;
    }
}


if (!function_exists('user_setting')) {

    function user_setting()
    {
        return Setting::first(['timezone']);
    }
}


if (!function_exists('get_mime_format')) {
    /**
     * Get the format from MIME type
     *
     * @param string $mime
     * @return string|null
     */
    function get_mime_format($mime)
    {

        if ($mime == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            return 'docx';
        }

        if ($mime == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            return 'xlsx';
        }

        if (!is_string($mime)) {
            throw new InvalidArgumentException('Invalid MIME type');
        }

        // Split the MIME string using the '/' separator
        $parts = explode('/', $mime);

        // If the split does not result in two parts, it's not a valid MIME
        if (count($parts) !== 2) {
            throw new InvalidArgumentException('Invalid MIME type format');
        }

        // Return the second part which represents the format
        return $parts[1];
    }
}

if (!function_exists('detect_link_message')) {
    /**
     * Get the format from MIME type
     *
     * @param string $mime
     * @return string|null
     */
    function detect_link_message($text)
    {

        $pattern = '/(http|https|ftp|ftps):\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(\/\S*)?/';
        return preg_replace($pattern, '<a href="$0" target="_blank" rel="noopener noreferrer">$0</a>', $text);
    }
}

if (!function_exists('platform_currency')) {
    /**
     * Get the format from MIME type
     *
     * @param string $mime
     * @return string|null
     */
    function platform_currency()
    {
        $setting = InternalSetting::first(['currency', 'currency_position']);
        return $setting;
    }
}
