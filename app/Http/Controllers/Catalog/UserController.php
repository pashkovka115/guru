<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\Tour;
use Modules\Admin\Models\TourLeader;
use Modules\Admin\Models\TourRating;
use Modules\Admin\Models\UserComment;
use Modules\Admin\Models\UserTour;

class UserController extends Controller
{
    /*
     * Список ведущих
     */
    public function index(Request $request)
    {
        $leaders_ids = \DB::table('tour_leader')
            ->selectRaw('leader_id')->distinct()->get();
        $leaders = User::with(['profile', 'tours_with_category', 'comments'])
            ->whereIn('id', array_keys($leaders_ids->keyBy('leader_id')->toArray()))
            ->paginate();

        if ($request->ajax()) {
            return view('pages.catalog.users.ajax_index', ['leaders' => $leaders]);
        } else {
            return view('pages.catalog.users.index', ['leaders' => $leaders, 'title' => 'Ведущие мероприятий']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Список организаторов
     * В данном случае имя $leaders используется для совместимости
     * метода UserController::index и шаблонов
     */
    public function organizer(Request $request)
    {
        $organizers_ids = \DB::table('organizer_leader')
            ->selectRaw('organizer_id')->distinct()->get();
        $leaders = User::with(['profile', 'tours_with_category', 'comments'])
            ->whereIn('id', array_keys($organizers_ids->keyBy('organizer_id')->toArray()))
            ->paginate();

        if ($request->ajax()) {
            return view('pages.catalog.users.ajax_index', ['leaders' => $leaders]);
        } else {
            return view('pages.catalog.users.index', ['leaders' => $leaders, 'title' => 'Ведущие мероприятий']);
        }
    }


    public function show($id)
    {
        $user = User::with(['tours_with_category', 'profile'])->where('id', $id)->firstOrFail();
        $comments = UserComment::with('user')->where('author_id', $id)->get();

        $all_raiting = 0;
        foreach ($comments as $comment) {
            $all_raiting += $comment->rating;
        }
        if ($comments->count() > 0) {
            $full_raiting = $all_raiting / $comments->count();
        } else {
            $full_raiting = 0;
        }

        return view('pages.catalog.users.show', [
            'user' => $user,
            'comments' => $comments,
            'title' => 'Профиль пользователя',
            'full_raiting' => $full_raiting
        ]);
    }


    public function addCommentToAuthor(Request $request, $id)
    {
//        dd($request->all());
        $data = $request->validate([
            'title' => 'required|string',
            'comment' => 'required|string',
            'rating' => 'required|string',
            'user_id' => 'required|numeric',
        ]);

        $data['author_id'] = $id;

        UserComment::create($data);

        return back();
    }
}
