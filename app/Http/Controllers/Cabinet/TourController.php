<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\CategoryTour;
use Modules\Admin\Models\Tour;
use Modules\Admin\Models\ToursTags;
use Modules\Admin\Models\TourVariant;


/**
 * Class TourController
 * @package App\Http\Controllers\Cabinet
 * Мероприятия в личном кабинете
 */
class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with('variants')->where('user_id', auth()->id())->get();

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
            $url_to_files = get_url_to_uploaded_files(auth()->user(), $request->file('file'));
            $bd_gallery = Tour::where('id', $request->header('id'))->firstOrFail(['id', 'gallery']);
            $new_gallery = array_merge(json_decode($bd_gallery->gallery), $url_to_files);

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
            $new_gallery = array_merge(json_decode($bd_gallery->accommodation_photo), $url_to_files);

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
            $new_gallery = array_merge(json_decode($bd_gallery->gallery_meals), $url_to_files);

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
            $gall_ar = (array)json_decode($bd_gallery->$field_name);

            foreach ($gall_ar as $key => $value){
                if ($value == json_decode(json_encode($request->input('field-src')))){
                    unset($gall_ar[$key]);
                }
            }

            $bd_gallery->update([$field_name => json_encode($gall_ar)]);

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
            'leader_ids' => 'array|required',
            'leader_ids.*' => 'integer|required',
//            'date_start' => 'sometimes|nullable|date',
//            'date_end' => 'sometimes|nullable|date',
//            'price_base' => 'required|numeric',

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
//dd($request->file('accommodation_photo'));

        \DB::transaction(function () use ($request) {
            $data = [
                'category_tour_id' => $request->input('category_tour_id'),
                'title' => $request->input('title'),
                'user_id' => \Auth::id(),
//                'date_start' => $request->input('date_start'),
//                'date_end' => $request->input('date_end'),
//                'price_base' => $request->input('price_base'),

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
                'accommodation_description' => $request->input('accommodation_description'),
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

            $tour = Tour::with('tags')->create($data);

            if ($request->has('tags') and is_array($request->input('tags')) and count($request->input('tags')) > 0) {
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
//        dd($request->all());
        $request->validate([
            'category_tour_id' => 'required|numeric',
            'title' => 'regex:/[\w\s\d\_\-\.]*/i',
            'leader_ids' => 'array|required',
            'leader_ids.*' => 'integer|required',
            'date_start' => 'sometimes|nullable|date',
            'date_end' => 'sometimes|nullable|date',
//            'price_base' => 'required|numeric',

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

//        dd($request->all());

        \DB::transaction(function () use ($id, $request) {
            // синхронизация тура с ведущими
            $leaders_ids = array_map(function ($n) use ($id) {
                return ['leader_id' => $n * 1, 'tour_id' => $id * 1];
            }, $request->input('leader_ids'));
            \DB::table('tour_leader')->where('tour_id', $id)->delete();
            \DB::table('tour_leader')->insert($leaders_ids);

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
                "video_url" => $request->input('video_url'),
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
}




























