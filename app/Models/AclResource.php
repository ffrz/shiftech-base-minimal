<?php

namespace App\Models;

class AclResource
{
    // menus
    const SYSTEM_MENU = 'system-menu';
    const REPORT_MENU = 'report-menu';

    // report
    const VIEW_REPORTS = 'view-reports';

    // system
    const USER_ACTIVITY = 'user-activity';
    const USER_MANAGEMENT = 'user-management';
    const SETTINGS = 'settings';

    public static function all()
    {
        return [
            'Sistem' => [
                self::SYSTEM_MENU => 'Menu sistem',
                self::USER_ACTIVITY => 'Aktifitas Pengguna',
                self::USER_MANAGEMENT => 'Pengguna',
                self::SETTINGS => 'Pengaturan',
            ]
        ];
    }
}
