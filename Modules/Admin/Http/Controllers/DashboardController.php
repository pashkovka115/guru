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
        $cnt_not_auth_users = User::where('auth', '0')->count();
        $requests_auth = User::where('request', '1')->count();
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
        $users = User::where('request', '1')->paginate();
        return view('admin::pages.dashboard.requests', ['users' => $users, 'title_page' => 'Заявки на авторизацию']);
    }

    /*
     * Авторизовать пользователя
     */
    public function store($id)
    {
        $trans = \DB::transaction(function () use ($id){
            User::where('id', $id)->update([
                'auth' => '1',
                'request' => '0'
            ]);
            $profile = Profile::create(['user_id' => $id]);
            if ($profile){
                session()->flash('message', 'Авторизовал');
                return redirect()->back();
            }
        }, 3);

        if ($trans)
            return $trans;

        return redirect()->back()->withErrors('Ой! Что то пошло не так.');
    }
}
