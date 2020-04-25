<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\CategoryTour;
use Modules\Admin\Models\Tour;
use Modules\Admin\Models\ToursTags;


/**
 * Class TourController
 * @package App\Http\Controllers\Cabinet
 * Мероприятия в личном кабинете
 */
class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::where('user_id', auth()->id())->get();

        return view('pages.cabinet.tour.index', ['tours' => $tours]);
    }


    public function create(Request $request)
    {
        $organizator = User::with('leaders')->where('id', auth()->id())->firstOrFail();
        $tour_categpries = CategoryTour::all();
        $tags = ToursTags::all();

        return view('pages.cabinet.tour.create', [
            'organizator' => $organizator,
            'tour_categpries' => $tour_categpries,
            'tags' => $tags
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_tour_id' => 'required|numeric',
            'title' => 'regex:/[\w\s\d\_\-\.]*/i',
            'leader_ids' => 'array|required',
            'leader_ids.*' => 'integer|required',
            'date_start' => 'sometimes|nullable|date',
            'date_end' => 'sometimes|nullable|date',
            'price_base' => 'required|numeric',

            'tags' => 'sometimes|nullable|array',
            'tags.*' => 'sometimes|nullable|numeric',

            'photo_variant' => 'sometimes|nullable|array',
            'photo_variant.*' => 'sometimes|nullable|mimes:jpeg,jpg,png',

            'date_variant' => 'sometimes|nullable|array',
            'date_variant.*' => 'sometimes|nullable|date',

            'text_variant' => 'sometimes|nullable|array',
            'text_variant.*' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.]*/i',

            'price_variant' => 'sometimes|nullable|array',
            'price_variant.*' => 'sometimes|nullable|regex:/[\d]*/i',

            'amount_variant' => 'sometimes|nullable|array',
            'amount_variant.*' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.]*/i',

            'photogallery' => 'sometimes|nullable|array',
            'photogallery.*' => 'sometimes|nullable|mimes:jpeg,jpg,png',

            'address' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'street' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'house' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'region' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'city' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'country' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',

            'latitude' => 'sometimes|nullable|regex:/[\d\.]*/i',
            'longitude' => 'sometimes|nullable|regex:/[\d\.]*/i',
            'adress_desk' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'video_url' => 'sometimes|nullable|url',
            'info_excerpt' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'info_description' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'count_person' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'timetable' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'included' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'no_included' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'first_aid' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'drinking_water' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'communication' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'accommodation_photo' => 'array',
            'accommodation_photo.*' => 'sometimes|nullable|mimes:jpeg,jpg,png',
            'accommodation_description' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
            'gallery_meals' => 'array',
            'gallery_meals.*' => 'sometimes|nullable|mimes:jpeg,jpg,png',
            'meals_desc' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.\,\/\"\\\']*/i',
        ]);
//dd($request->input('gallery'));

        \DB::transaction(function () use ($request) {
            $tour = Tour::with('tags')->create([
                'category_tour_id' => $request->input('category_tour_id'),
                'title' => $request->input('title'),
                'user_id' => \Auth::id(),
                'date_start' => $request->input('date_start'),
                'date_end' => $request->input('date_end'),
                'price_base' => $request->input('price_base'),

                'gallery' => json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('photogallery'))),

                'address' => $request->input('address'),
                'street' => $request->input('street'),
                'house' => $request->input('house'),
                'region' => $request->input('region'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),

                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'adress_desk' => $request->input('adress_desk'),
                'video_url' => $request->input('video_url'),
                'info_excerpt' => $request->input('info_excerpt'),
                'info_description' => $request->input('info_description'),
                'count_person' => $request->input('count_person'),
                'timetable' => $request->input('timetable'),
                'included' => $request->input('included'),
                'no_included' => $request->input('no_included'),
                'first_aid' => $request->input('first_aid'),
                'drinking_water' => $request->input('drinking_water'),
                'communication' => $request->input('communication'),
                'accommodation_photo' => (is_array($request->file('accommodation_photo'))) ? json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('accommodation_photo'))) : null,
                'accommodation_description' => $request->input('accommodation_description'),
                'gallery_meals' => (is_array($request->file('gallery_meals'))) ? json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('gallery_meals'))) : null,
                'meals_desc' => $request->input('meals_desc'),
            ]);

            if ($request->has('tags') and is_array($request->input('tags')) and count($request->input('tags')) > 0){
                $tour->tags()->attach($request->input('tags'));
            }


            // прикрепляем к мероприятию ведущих
            foreach ($request->input('leader_ids') as $leader_id) {
                $leader = User::with('tours')->where('id', $leader_id)->first();
                $leader->tours()->attach($tour->id);
            }

            // варианты мероприятия
            // todo: на фронте должны изменить разметку, иначе вариант есть всегда
            if (is_array($request->input('photo_variant')) and count($request->input('photo_variant')) > 0) {
                $cnt = count($request->input('photo_variant'));
                $variants = [];
                for ($i = 0; $i < $cnt; $i++) {
                    $variant = [
                        'tour_id' => $tour->id,
                        'photo_variant' => $request->input('photo_variant')[$i],
                        'date_start_variant' => $request->input('date_start_variant')[$i],
                        'date_end_variant' => $request->input('date_end_variant')[$i],
                        'text_variant' => $request->input('text_variant')[$i],
                        'price_variant' => $request->input('price_variant')[$i],
                        'amount_variant' => $request->input('amount_variant')[$i],
                    ];
                    $variants[] = $variant;
                }
                \DB::table('tours_variants')->insert($variants);
            }
        }, 5);

        session()->flash('message', 'Сохранено');
        return redirect()->back();
    }


    public function edit($id)
    {
//        \DB::table('tours_variants')->insert($variants);

        // организатор с его ведущими
        $organizator = User::with('leaders')->where('id', auth()->id())->firstOrFail();
        // все теги
        $tags = ToursTags::all();
        // все категории туров
        $tour_categpries = CategoryTour::all();


        $tour = Tour::with(['tags', 'leaders', 'category', 'variants'])->where('id', $id)->firstOrFail();


        return view('pages.cabinet.tour.edit', [
            'organizator' => $organizator,
            'tour' => $tour,
            'tags' => $tags,
            'tour_categpries' => $tour_categpries
        ]);
    }

    public function update(Request $request, $id)
    {

    }
}




























