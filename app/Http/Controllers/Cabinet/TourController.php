<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\CategoryTour;
use Modules\Admin\Models\Tour;
use Modules\Admin\Models\TourLeader;
use Modules\Admin\Models\TourRating;
use Modules\Admin\Models\ToursTags;
use Modules\Admin\Models\ToursTagsTours;
use Modules\Admin\Models\TourVariant;
use Response;
use Symfony\Component\Console\Input\Input;
use Validator;


/**
 * Class TourController
 * @package App\Http\Controllers\Cabinet
 * Мероприятия в личном кабинете
 */
class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with('variants')->where('user_id', auth()->id())->orderByDesc('id')->get();

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

    /*
     * основная галерея мероприятия
     * добавить ссылку на файл
     */
    public function ajax_general_gallery_insert(Request $request)
    {
        if ($request->has('file') and $request->hasHeader('id')){

            $validation = Validator::make($request->all(), [
                'file' => 'image|max:4000'
            ]);

            if ($validation->fails())
            {
                return Response::make($validation->errors()->first(), 400);
            }

            $url_to_files = get_url_to_uploaded_files(auth()->user(), $request->file('file'));
            $bd_gallery = Tour::where('id', $request->header('id'))->firstOrFail(['id', 'gallery']);
            $new_gallery = array_merge((array)json_decode($bd_gallery->gallery ?: ''), $url_to_files);

            $bd_gallery->update(['gallery' => json_encode($new_gallery)]);

            return [
                'answer' => 'ok',
            ];
        }
        return ['answer' => 'файл не пришел.'];
    }

    /*
     * Проживание и удобства
     * добавить ссылку на файл
     */
    public function ajax_accommodation_gallery_insert(Request $request)
    {
        if ($request->has('file') and $request->hasHeader('id')){
            $url_to_files = get_url_to_uploaded_files(auth()->user(), $request->file('file'));
            $bd_gallery = Tour::where('id', $request->header('id'))->firstOrFail(['id', 'accommodation_photo']);
            $new_gallery = array_merge((array)json_decode($bd_gallery->accommodation_photo ?: ''), $url_to_files);

            $bd_gallery->update(['accommodation_photo' => json_encode($new_gallery)]);

            return [
                'answer' => 'ok',
            ];
        }
        return ['answer' => 'файл не пришел.'];
    }

    /*
     * Проживание и удобства
     * добавить ссылку на файл
     */
    public function ajax_meals_gallery_insert(Request $request)
    {
        if ($request->has('file') and $request->hasHeader('id')){
            $url_to_files = get_url_to_uploaded_files(auth()->user(), $request->file('file'));
            $bd_gallery = Tour::where('id', $request->header('id'))->firstOrFail(['id', 'gallery_meals']);
            $new_gallery = array_merge((array)json_decode($bd_gallery->gallery_meals ?: ''), $url_to_files);

            $bd_gallery->update(['gallery_meals' => json_encode($new_gallery)]);

            return [
                'answer' => 'ok',
            ];
        }
        return ['answer' => 'файл не пришел.'];
    }

    /*
     * для любого поля
     * удалить ссылку на файл
     */
    public function ajax_gallery_remove(Request $request)
    {
        if ($request->has('field-src') and $request->has('field-name')){
            $field = $request->input('field-name');
            $sp = explode('_', $field);
            $field_name = str_replace('-', '_', $sp[0]);
            $bd_gallery = Tour::where('id', (int)$sp[1])->firstOrFail(['id', $field_name]);
            $gall_ar = (array)json_decode($bd_gallery->$field_name ?: '');

            $new_arr = [];
            foreach ($gall_ar as $key => $value){
                if ($value != json_decode(json_encode($request->input('field-src')))){
                    $new_arr[] = $value;
                }
            }

            $bd_gallery->update([$field_name => json_encode($new_arr)]);

            return [
                'answer' => 'ok',
            ];
        }
        return ['answer' => 'error'];
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_tour_id' => 'required|numeric',
            'title' => 'regex:/[\w\s\d\_\-\.]*/i',

            'photo_variant' => 'sometimes|nullable|array',
            'photo_variant.*' => 'sometimes|nullable|mimes:jpeg,jpg,png',

            'date_variant' => 'sometimes|nullable|array',
            'date_variant.*' => 'sometimes|nullable|date',

            'text_variant' => 'sometimes|nullable|array',
            'text_variant.*' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.]*/i',

            'price_variant' => 'sometimes|nullable|array',
            'price_variant.*' => 'sometimes|nullable|regex:/^[\d]*$/i',

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
            'video_url' => 'sometimes|nullable',
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

        // валидируем добавление существующих авторов
        if ($request->has('leader_ids') and is_array($request->input('leader_ids'))){
            $ids = [];
            foreach ($request->input('leader_ids') as $leader_id){
                $ids[] = (int)$leader_id;
            }
            $user = User::with('leaders')->where('id', auth()->id())->first();
            $lead_ids = array_keys($user->leaders->keyBy('id')->toArray());

            $lead_false = false;
            foreach ($ids as $idd){
                if (!in_array($idd, $lead_ids)){
                    $lead_false = true;
                    break;
                }
            }
            unset($idd);

            if ($lead_false){
                return redirect()->back()
                    ->withErrors('Для создания автора/ведущего есть специальный <a href="'.route('site.cabinet.leaders.create').'">раздел</a>');
            }
        }

        // валидируем добавление существующих тегов
        if ($request->has('tags') and is_array($request->input('tags'))){
            $ids = [];
            foreach ($request->input('tags') as $tag_id){
                $ids[] = (int)$tag_id;
            }

            $tags = ToursTags::all();
            $tags_ids = array_keys($tags->keyBy('id')->toArray());
            $tags_ids_true = true;
            foreach ($ids as $i){
                if (!in_array($i, $tags_ids)){
                    $tags_ids_true = false;
                    break;
                }
            }

            if (!$tags_ids_true){
                return redirect()->back()
                    ->withErrors('Вы не можете создавать новые теги, для этого есть администратор.');
            }
        }

//        global $tour;
//        \DB::transaction(function() use ($request) {
            $data = [
                'category_tour_id' => $request->input('category_tour_id'),
                'title' => $request->input('title'),
                'user_id' => \Auth::id(),

                'address' => $request->input('address'),
                'street' => $request->input('street'),
                'house' => $request->input('house'),
                'region' => $request->input('region'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),

                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'adress_desk' => $request->input('adress_desk'),
                'video_url' => get_id_youtube_from_url($request->input('video_url')),
                'info_excerpt' => $request->input('info_excerpt'),
                'info_description' => $request->input('info_description'),
                'count_person' => $request->input('count_person'),
                'timetable' => $request->input('timetable'),
                'included' => $request->input('included'),
                'no_included' => $request->input('no_included'),
                'first_aid' => $request->input('first_aid'),
                'drinking_water' => $request->input('drinking_water'),
                'communication' => $request->input('communication'),
                'accommodation_description' => $request->input('accommodation_description'),
                "conditioner" => $request->has('conditioner') ? '1' : '0',
                "wifi" => $request->has('wifi') ? '1' : '0',
                "pool" => $request->has('pool') ? '1' : '0',
                "towel" => $request->has('towel') ? '1' : '0',
                "private_room" => $request->has('private_room') ? '1' : '0',
                "transfer_fee" => $request->has('transfer_fee') ? '1' : '0',
                "fish" => $request->has('fish') ? '1' : '0',
                "meat" => $request->has('meat') ? '1' : '0',
                "gluten_free" => $request->has('gluten_free') ? '1' : '0',
                "milk_free" => $request->has('milk_free') ? '1' : '0',
                "kitchen" => $request->has('kitchen') ? '1' : '0',
                "dormitory_room" => $request->has('dormitory_room') ? '1' : '0',
                "separate_house" => $request->has('separate_house') ? '1' : '0',
                "transfer_free" => $request->has('transfer_free') ? '1' : '0',
                "not_transfer" => $request->has('not_transfer') ? '1' : '0',
                "vegan" => $request->has('vegan') ? '1' : '0',
                "ayurveda" => $request->has('ayurveda') ? '1' : '0',
                "vegetarianism" => $request->has('vegetarianism') ? '1' : '0',
                "organic" => $request->has('organic') ? '1' : '0',
                "nuts_free" => $request->has('nuts_free') ? '1' : '0',
                "coffee_tea" => $request->has('coffee_tea') ? '1' : '0',
                "count_meals" => $request->input('count_meals'),
                'meals_desc' => $request->input('meals_desc'),
            ];

            if ($request->has('accommodation_photo')){
                $data['accommodation_photo'] = json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('accommodation_photo')));
            }

            if ($request->has('gallery_meals')){
                $data['gallery_meals'] = json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('gallery_meals')));
            }

            if ($request->has('photogallery')){
                $data['gallery'] = json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('photogallery')));
            }

            $tour = new Tour($data);
            $tour->save();


            if ($request->has('tags') and is_array($request->input('tags')) and count($request->input('tags')) > 0) {
                $tour->tags()->attach($request->input('tags'));
            }

            // прикрепляем к мероприятию ведущих
            $leader_ids = !empty($request->input('leader_ids')) ? $request->input('leader_ids') : [];
            foreach ($leader_ids as $leader_id) {
                $leader = User::with('tours')->where('id', $leader_id)->first();
                if($leader){
                    $leader->tours()->attach($tour->id);
                }
            }

            // варианты мероприятия
            if ($request->has('price_variant') and count((array)$request->input('price_variant')) > 0) {
                $cnt = count($request->input('price_variant'));
                $variants = [];
                for ($i = 0; $i < $cnt; $i++) {
                    $variant = [
                        'tour_id' => $tour->id,
                        'photo_variant' => json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('photo_variant')[$i])),
                        'date_start_variant' => $request->input('date_start_variant')[$i],
                        'date_end_variant' => $request->input('date_end_variant')[$i],
                        'text_variant' => $request->input('text_variant')[$i],
                        'price_variant' => $request->input('price_variant')[$i],
                        'amount_variant' => $request->input('amount_variant')[$i],
                        'signed_up' => $request->input('amount_variant')[$i],
                    ];
                    $variants[] = $variant;
                }
                \DB::table('tours_variants')->insert($variants);
            }
//        }, 5);

        session()->flash('message', 'Сохранено');
        return redirect()->route('site.cabinet.tour.edit', ['tour' => $tour->id]);
    }


    public function edit($id)
    {
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
        $request->validate([
            'category_tour_id' => 'required|numeric',
            'title' => 'regex:/[\w\s\d\_\-\.]*/i',

            'photo_variant' => 'sometimes|nullable|array',
            'photo_variant.*' => 'sometimes|nullable|mimes:jpeg,jpg,png',

            'date_variant' => 'sometimes|nullable|array',
            'date_variant.*' => 'sometimes|nullable|date',

            'text_variant' => 'sometimes|nullable|array',
            'text_variant.*' => 'sometimes|nullable|regex:/[\w\s\d\_\-\.]*/i',

            'price_variant' => 'sometimes|nullable|array',
            'price_variant.*' => 'sometimes|nullable|regex:/^[\d]*$/i',

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
            'video_url' => 'sometimes|nullable',
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

        // валидируем добавление существующих авторов
        if ($request->has('leader_ids') and is_array($request->input('leader_ids'))){
            $ids = [];
            foreach ($request->input('leader_ids') as $leader_id){
                $ids[] = (int)$leader_id;
            }
            $user = User::with('leaders')->where('id', auth()->id())->firstOrFail();
            $lead_ids = array_keys($user->leaders->keyBy('id')->toArray());

            $lead_false = false;
            foreach ($ids as $idd){
                if (!in_array($idd, $lead_ids)){
                    $lead_false = true;
                    break;
                }
            }
            unset($idd);

            if ($lead_false){
                return redirect()->back()
                    ->withErrors('Для создания автора/ведущего есть специальный <a href="'.route('site.cabinet.leaders.create').'">раздел</a>');
            }
        }else{
            $lead_false = true;
        }

        // валидируем добавление существующих тегов
        if ($request->has('tags') and is_array($request->input('tags'))){
            $ids = [];
            foreach ($request->input('tags') as $tag_id){
                $ids[] = (int)$tag_id;
            }

            $tags = ToursTags::all();
            $tags_ids = array_keys($tags->keyBy('id')->toArray());
            $tags_ids_true = true;
            foreach ($ids as $i){
                if (!in_array($i, $tags_ids)){
                    $tags_ids_true = false;
                    break;
                }
            }

            if (!$tags_ids_true){
                return redirect()->back()
                    ->withErrors('Вы не можете создавать новые теги, для этого есть администратор.');
            }
        }

        \DB::transaction(function () use ($id, $request, $lead_false) {
            if (!$lead_false) {
                // синхронизация тура с ведущими
                $leaders_ids = array_map(function ($n) use ($id) {
                    return ['leader_id' => (int)$n, 'tour_id' => (int)$id];
                }, $request->input('leader_ids'));

                \DB::table('tour_leader')->where('tour_id', $id)->delete();
                \DB::table('tour_leader')->insert($leaders_ids);
            }else{
                \DB::table('tour_leader')->where('tour_id', $id)->delete();
            }

            // синхронизация с вариантами
            // если существуют варианты
            if ($request->has('date_start_variant')) {
                $cnt_elems = count($request->input('date_start_variant')) ?? 0;
                function get_photo_if_exists($request, $i)
                {
                    if ($request->has('photo_variant') and isset($request->file('photo_variant')["$i"])) {
                        $files = get_url_to_uploaded_files(auth()->user(), $request->file('photo_variant')["$i"]);
                        return json_encode($files);
                    }
                    return '';
                }

                for ($i = 0; $i < $cnt_elems; $i++) {
                    $variant = [
                        'variant_id' => $request->input('variant_id')[$i] ?? false,
                        'tour_id' => $id,
                        'price_variant' => $request->input('price_variant')[$i],
                        'date_start_variant' => $request->input('date_start_variant')[$i],
                        'date_end_variant' => $request->input('date_end_variant')[$i],
                        'text_variant' => $request->input('text_variant')[$i],
                        'amount_variant' => $request->input('amount_variant')[$i],
                        'signed_up' => $request->input('amount_variant')[$i],
                    ];

                    if ($request->has('photo_variant') and isset($request->file('photo_variant')["$i"])) {
                        $variant['photo_variant'] = get_photo_if_exists($request, $i);
                    }

                    // Обновляем вариант если существует, иначе добавляем новый
                    if ($variant['variant_id']) {
                        $id_var = $variant['variant_id'];
                        unset($variant['variant_id']);
                        \DB::table('tours_variants')->where('tour_id', $id)->where('id', $id_var)->update($variant);
                    } else {
                        unset($variant['variant_id']);
                        \DB::table('tours_variants')->insert($variant);
                    }
                }
            } // END variants

            // Tags
            $tour = Tour::with(['tags', 'leaders', 'category', 'variants'])->where('id', $id)->firstOrFail();
            $tour->tags()->sync(array_map(function ($n) {
                return $n * 1;
            }, $request->input('tags', []))); // END Tags

            // ***
            $data = [
                "title" => $request->input('title'),
                "category_tour_id" => $request->input('category_tour_id'),
                "address" => $request->input('address'),
                "street" => $request->input('street'),
                "house" => $request->input('house'),
                "region" => $request->input('region'),
                "city" => $request->input('city'),
                "country" => $request->input('country'),
                "latitude" => $request->input('latitude'),
                "longitude" => $request->input('longitude'),
                "adress_desk" => $request->input('adress_desk'),
                "video_url" => get_id_youtube_from_url($request->input('video_url')),
                "info_excerpt" => $request->input('info_excerpt'),
                "info_description" => $request->input('info_description'),
                "count_person" => $request->input('count_person'),
                "timetable" => $request->input('timetable'),
                "included" => $request->input('included'),
                "no_included" => $request->input('no_included'),
                "first_aid" => $request->input('first_aid'),
                "drinking_water" => $request->input('drinking_water'),
                "communication" => $request->input('communication'),
                "accommodation_description" => $request->input('accommodation_description'),
                "conditioner" => $request->has('conditioner') ? '1' : '0',
                "wifi" => $request->has('wifi') ? '1' : '0',
                "pool" => $request->has('pool') ? '1' : '0',
                "towel" => $request->has('towel') ? '1' : '0',
                "private_room" => $request->has('private_room') ? '1' : '0',
                "transfer_fee" => $request->has('transfer_fee') ? '1' : '0',
                "meals_desc" => $request->input('meals_desc'),
                "fish" => $request->has('fish') ? '1' : '0',
                "meat" => $request->has('meat') ? '1' : '0',
                "gluten_free" => $request->has('gluten_free') ? '1' : '0',
                "milk_free" => $request->has('milk_free') ? '1' : '0',
                "kitchen" => $request->has('kitchen') ? '1' : '0',
                "dormitory_room" => $request->has('dormitory_room') ? '1' : '0',
                "separate_house" => $request->has('separate_house') ? '1' : '0',
                "transfer_free" => $request->has('transfer_free') ? '1' : '0',
                "not_transfer" => $request->has('not_transfer') ? '1' : '0',
                "vegan" => $request->has('vegan') ? '1' : '0',
                "ayurveda" => $request->has('ayurveda') ? '1' : '0',
                "vegetarianism" => $request->has('vegetarianism') ? '1' : '0',
                "organic" => $request->has('organic') ? '1' : '0',
                "nuts_free" => $request->has('nuts_free') ? '1' : '0',
                "coffee_tea" => $request->has('coffee_tea') ? '1' : '0',
                "count_meals" => $request->input('count_meals'),
            ];

            if ($request->has('accommodation_photo')){
                $data['accommodation_photo'] = json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('accommodation_photo')));
            }

            if ($request->has('gallery_meals')){
                $data['gallery_meals'] = json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('gallery_meals')));
            }

            if ($request->has('photogallery')){
                $data['gallery'] = json_encode(get_url_to_uploaded_files(auth()->user(), $request->file('photogallery')));
            }

            $tour->update($data);
        });

        return redirect()->back();
    }


    public function destroy($id)
    {
        \DB::transaction(function () use ($id){
            $tour =Tour::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
            TourLeader::where('tour_id', $id)->delete();
            TourRating::where('tour_id', $id)->delete();
            ToursTagsTours::where('tour_id', $id)->delete();
            TourVariant::where('tour_id', $id)->delete();
            $tour->delete();
        });

        return redirect()->back();
    }
}




























