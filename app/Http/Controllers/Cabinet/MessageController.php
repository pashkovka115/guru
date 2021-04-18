<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Mail\QuestionFromUser;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        // таблица сообщений заполняется без авторизации
        $messages = Message::where('leader_id', auth()->id())->get();

        return view('pages.cabinet.message.index', ['messages' => $messages]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'leader'=> 'required|numeric',
            'name'=> 'required|regex:/[\w\s\-]*/i',
            'email'=> 'required|email',
            'phone'=> 'required|regex:/[\d\(\)\-\s\+]*/',
            'message'=> 'required|regex:/[\w\s\-\,\.]*/i',
        ]);

        $user = User::where('id', (int)$request->input('leader'))->firstOrFail();

        \Mail::to($user->email)->send(new QuestionFromUser($data));

        session()->flash('message', 'Отправлено');
        return redirect()->back();
    }

    public function destroy($id)
    {
        Message::where('id', $id)->delete();
        session()->flash('message', 'Удалено');

        return redirect()->back();
    }
}


