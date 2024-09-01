<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\Product;

class ReportController extends Controller
{
    public function __construct()
    {
        ensure_user_can_access(AclResource::VIEW_REPORTS);
    }
}
