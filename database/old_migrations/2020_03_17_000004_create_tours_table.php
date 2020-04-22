<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tours';

    /**
     * Мероприятия
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->enum('active', ["1", "0"])->default('1')->comment('опубликовано');
            $table->enum('good', ["0", "1"])->default('0')->comment('одобрен администратором');
            $table->unsignedInteger('price')->nullable();
            $table->decimal('rating', 2, 1)->nullable();
            $table->string('title');
            $table->string('h1')->nullable();

            /*
             * поля для вывода в ленте
             */
            $table->string('included_event')->nullable()->comment('Что включено в мероприятие');
            $table->string('group_people')->comment('Размер группы');
            $table->string('food_desc')->nullable()->comment('питание');
            $table->string('accommodation_desc')->nullable()->comment('Проживание и удобства');
            $table->string('wifi_desc')->nullable()->comment('Wi-Fi,Интернет,Телефон');
            $table->string('transfer')->nullable();
            $table->string('some_text')->nullable();
            /*
             * END поля для вывода в ленте
             */

//            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('date_start')->nullable()->comment('начало мероприятия');
            $table->timestamp('date_end')->nullable()->comment('окончание мероприятия');
            $table->string('img')->nullable()->comment('главное фото');
            $table->text('gallery')->nullable()->comment('произвольная галерея');
            $table->string('location')->nullable()->comment('координаты');

            $table->nullableTimestamps();
            $table->softDeletes();

//            $table->text('location_description')->nullable()->comment('описание где находится');

//            $table->text('timetable')->nullable()->comment('Расписание мероприятия');

//            $table->text('no_included_event')->nullable()->comment('Что не включено в мероприятие');

//            $table->enum('first_help', ['0', '1'])->comment('первая помощь');
//            $table->string('first_help_desc')->nullable()->comment('первая помощь');

//            $table->enum('water', ['0', '1'])->comment('питьевая вода');
//            $table->string('water_desc')->nullable()->comment('питьевая вода');

//            $table->enum('wifi', ['0', '1'])->comment('Wi-Fi,Интернет,Телефон');


//            $table->string('accommodation_gallary')->nullable()->comment('Проживание и удобства');


//            $table->string('food_gallary')->nullable()->comment('питание');


//            $table->enum('conditioning', ['0', '1'])->comment('Кондиционер');
//            $table->enum('towels', ['0', '1'])->comment('Полотенца');
//            $table->enum('free_wifi', ['0', '1'])->comment('Беплатный Wifi');
//            $table->enum('kitchen', ['0', '1'])->comment('Кухня');
//            $table->enum('basin', ['0', '1'])->comment('Бассейн');
//            $table->enum('coffee', ['0', '1'])->comment('Кофе,Чай');
//            $table->enum('private_room', ['0', '1'])->comment('Отдельный номер');
//            $table->enum('public_room', ['0', '1'])->comment('Общий номер');
//            $table->enum('private_home', ['0', '1'])->comment('Отдельный домик');

//            $table->enum('vegan', ['0', '1'])->comment('Веган');
//            $table->enum('vegetarianism', ['0', '1'])->comment('Вегетарианство');
//            $table->enum('Ayurveda', ['0', '1'])->comment('Аюрведа');
//            $table->enum('not_gluten', ['0', '1'])->comment('Без глютена');
//            $table->enum('meat', ['0', '1'])->comment('Мясо');
//            $table->enum('without_milk', ['0', '1'])->comment('Без молока');
//            $table->enum('fish', ['0', '1'])->comment('Рыба');
//            $table->enum('organic', ['0', '1'])->comment('Органическая');
//            $table->enum('without_nuts', ['0', '1'])->comment('Без орехов');
//            $table->enum('food_options', ['0', '1', '2', '3'])->comment('Варианты питания');


//            $table->string('ceremony')->nullable()->comment('Что включено в мероприятие');
//            $table->string('number_of_people')->nullable()->comment('Размер группы');
//            $table->string('nutrition')->nullable()->comment('питание');
//            $table->string('hostel')->nullable()->comment('Проживание и удобства');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists($this->tableName);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
