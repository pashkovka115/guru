<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\Tour;
use Modules\Admin\Models\TourRating;

class TourRatingController extends Controller
{
    /*
     * оценить тур
     */
    public function estimate(Request $request)
    {
        $request->validate([
            'rating' => 'sometimes|nullable|numeric',
            'tour_id' => 'required|numeric',
            'title' => 'required|regex:/[\w\s\d\_\-\.]*/i',
            'comment' => 'required|regex:/[\w\s\d\_\-\.]*/i',
        ]);

        $old_comment = TourRating::where('tour_id', $request->input('tour_id'))
            ->where('user_id', auth()->id())->first();

        if (! $old_comment){
            TourRating::create([
                'rating' => $request->input('rating'),
                'tour_id' => $request->input('tour_id'),
                'user_id' => auth()->id(),
                'title' => $request->input('title'),
                'comment' => $request->input('comment'),
            ]);

            // пересчитываем рейтинг тура
            $ratings = TourRating::where('tour_id', $request->input('tour_id'))->get('rating');
            if ($ratings){
                $nums_arr = array_keys($ratings->keyBy('rating')->toArray());
                $cnt = count($nums_arr);
                $tour_rating = array_sum($nums_arr) / $cnt;

                $tour = Tour::where('id', $request->input('tour_id'))->firstOrFail();
                $tour->update(['rating' => $tour_rating]);
            }

            session()->flash('message', 'Оценка добавлена, спасибо за ваш отзыв!');
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors('Вы уже оценивали это мероприятие.');
        }
    }
}


