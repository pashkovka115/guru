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
        $new_tours = Tour::where('new', '1')->count();
        $recommended = Tour::where('recommended', '1')->count();

        return view('admin::pages.dashboard.index', [
            'title' => $this->title,
            'title_page' => 'Виджеты',
            'cnt_not_auth_users' => $cnt_not_auth_users,
            'all_users' => $all_users,
            'all_events' => $all_events,
            'requests_auth' => $requests_auth,
            'new_tours' => $new_tours,
            'recommended' => $recommended
        ]);
    }


    /*
     * Рекомендуемые мероприятия
     */
    public function recommended()
    {
        $tours = Tour::where('recommended', '1')->paginate();
        return view('admin::pages.dashboard.recommended', ['tours' => $tours, 'title_page' => 'Рекомендуемые мероприятия']);
    }

    /*
     * Новые мероприятия
     */
    public function new_items()
    {
        $tours = Tour::where('new', '1')->paginate();
        return view('admin::pages.dashboard.new_items', ['tours' => $tours, 'title_page' => 'Не просмотренные мероприятия']);
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
