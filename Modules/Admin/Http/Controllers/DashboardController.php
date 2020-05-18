<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Tour;

class DashboardController extends Controller
{
    public $title = 'Панель администратора';


    public function index()
    {
        $cnt_not_auth_users = Profile::where('auth', '0')->count();
        $requests_auth = Profile::where('request', '1')->count();
        $all_users = User::count();
        $all_events = Tour::count();

        return view('admin::pages.dashboard.index', [
            'title' => $this->title,
            'title_page' => 'Виджеты',
            'cnt_not_auth_users' => $cnt_not_auth_users,
            'all_users' => $all_users,
            'all_events' => $all_events,
            'requests_auth' => $requests_auth
        ]);
    }

    public function requests()
    {
        $profiles = Profile::with('user')->where('request', '1')->paginate();
        return view('admin::pages.dashboard.requests', ['profiles' => $profiles, 'title_page' => 'Заявки на авторизацию']);
    }

    /*
     * Авторизовать пользователя
     */
    public function store($id)
    {
        Profile::where('id', $id)->update([
            'auth' => '1',
            'request' => '0'
        ]);

        session()->flash('message', 'Авторизовал');
        return redirect()->back();
    }
}
