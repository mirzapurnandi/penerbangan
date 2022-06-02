<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $pagination = 10;
        $result = User::where('level', 'user')->paginate($pagination);

        $page = !request('page') ? 1 : request('page');

        return view('admin.user.index', [
            'result' => $result,
            'page' => ($page - 1) * $pagination
        ]);
    }

    public function destroy($id)
    {
        $result = User::findOrFail($id);
        if ($result->delete()) {
            return redirect()->back()->with('message', '<div class="alert alert-info alert-dismissible">User Terhapus...</div>');
        }
    }
}
