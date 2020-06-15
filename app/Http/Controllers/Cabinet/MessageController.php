<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
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
        $request->validate([
            'leader'=> 'required|numeric',
            'name'=> 'required|regex:/[\w\s\-]*/i',
            'email'=> 'required|email',
            'phone'=> 'required|regex:/[\d\(\)\-\s\+]*/',
            'message'=> 'required|regex:/[\w\s\-\,\.]*/i',
        ]);

        // TODO: для будущей реализации
        /*Message::create([
            'leader_id'=> $request->input('leader'),
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'phone'=> $request->input('phone'),
            'message'=> $request->input('message'),
        ]);*/

        $template = view('email.question', ['data' => $request->all()])->render();

        $user = User::where('id', (int)$request->input('leader'))->firstOrFail();

        try {
            \Mail::raw('Задан вопрос с сайта '. env('APP_NAME'), function ($message) use ($user, $template){
                $message->from(env('MAIL_USERNAME'));
                $message->to($user->email);
                $message->setContentType('text/html');
                $message->subject($template);
            });
        }catch (\Swift_TransportException $exception){
            return redirect()->back()->withErrors('Неполадки сети. Позже попробуйте ещё раз.');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('ООПС..! Непредвиденная ошибка.');
        }


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


