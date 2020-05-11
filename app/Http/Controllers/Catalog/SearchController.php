<?php


namespace App\Http\Controllers\Catalog;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\Tour;



class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'required|regex:/[\w\s\d\_\-]*/i'
        ]);
        $q = $request->input('q');
        $max_page = 30;
        //Полнотекстовый поиск с пагинацией
        $tours = $this->search($q, $max_page);
        $users = $this->search($q, $max_page, User::class, 'profile', ['name']);
        return view('pages.catalog.search.index', [
            'tours' => $tours,
            'users' => $users
        ]);
    }




    /**
     * Полнотекстовый поиск.
     *
     * @param string $q Строка содержащая поисковый запрос. Может быть несколько фраз разделенных пробелом.
     * @param integer $count Количество найденных результатов выводимых на одной странице (для пагинации)
     * @param array $fields Поля по которым производится поиск
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function search($q, $count, $model = Tour::class, $relationship = false,  array $fields = ['title', 'info_excerpt', 'info_description', 'country']){
        $query = mb_strtolower($q, 'UTF-8');
        $arr = explode(" ", $query); //разбивает строку на массив по разделителю
        $fields = implode(',', $fields);
        /*
         * Для каждого элемента массива (или только для одного) добавляет в конце звездочку,
         * что позволяет включить в поиск слова с любым окончанием.
         * Длинные фразы, функция mb_substr() обрезает на 1-3 символа.
         */
        $query = [];
        foreach ($arr as $word)
        {
            $len = mb_strlen($word, 'UTF-8');
            switch (true)
            {
                case ($len <= 3):
                {
                    $query[] = $word . "*";
                    break;
                }
                case ($len > 3 && $len <= 6):
                {
                    $query[] = mb_substr($word, 0, -1, 'UTF-8') . "*";
                    break;
                }
                case ($len > 6 && $len <= 9):
                {
                    $query[] = mb_substr($word, 0, -2, 'UTF-8') . "*";
                    break;
                }
                case ($len > 9):
                {
                    $query[] = mb_substr($word, 0, -3, 'UTF-8') . "*";
                    break;
                }
                default:
                {
                    break;
                }
            }
        }
        $query = array_unique($query, SORT_STRING);
        $qQeury = implode(" ", $query); //объединяет массив в строку
        // Таблица для поиска
        if ($relationship){
            $results = $model::with($relationship)->whereRaw(
                "MATCH($fields) AGAINST(? IN BOOLEAN MODE)",
                $qQeury)->paginate($count);
        }else {
            $results = $model::whereRaw(
                "MATCH($fields) AGAINST(? IN BOOLEAN MODE)",
                $qQeury)->paginate($count);
        }
        return $results;
    }
}

// Для работы пагинации нужно дополнительно передать с GET параметрами поисковую фразу (q), для этого вместо стандартного вывода кнопок со ссылками
// пишем
// {{$students->appends(['q' => \Illuminate\Support\Facades\Input::get('q')])->links()}}
