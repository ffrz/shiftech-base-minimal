<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    public function __construct()
    {
        ensure_user_can_access(AclResource::USER_ACTIVITY);
    }

    public function index(Request $request)
    {
        $filter = [
            'search' => $request->get('search', ''),
            'user_id' => $request->get('user_id', ''),
            'type' => $request->get('type', ''),
        ];
        $q = UserActivity::query();
        if (!empty($filter['search'])) {
            $q->where('description', 'like', '%' . $filter['search'] . '%');
            $q->orWhere('name', 'like', '%' . $filter['search'] . '%');
        }
        if (!empty($filter['user_id'])) {
            $q->where('user_id', '=', $filter['user_id']);
        }
        if (!empty($filter['type'])) {
            $q->where('type', '=', $filter['type']);
        }
        $q->orderBy('id', 'desc');
        $items = $q->paginate(10);

        $users = User::orderBy('username', 'asc')->get();
        $types = UserActivity::types();
        return view('admin.user-activity.index', compact('items', 'filter', 'users', 'types'));
    }

    public function show(Request $request, $id = 0)
    {
        $item = UserActivity::findOrFail($id);
        return view('admin.user-activity.show', compact('item'));
    }

    public function delete(Request $request)
    {
        $item = UserActivity::findOrFail($request->post('id', 0));
        $item->delete();
        return redirect('admin/user-activity')->with('info', 'Rekaman log aktivitas <b>#' . $item->id . '</b> telah dihapus.');
    }
}
