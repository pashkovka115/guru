<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    public $tableName = 'tours';

    /**
     * Мероприятия
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('Организатор');
            $table->unsignedBigInteger('category_tour_id');
            $table->enum('active', ["1", "0"])->comment('опубликовано');
            $table->enum('good', ["0", "1"])->comment('одобрен администратором');
            $table->enum('recommended', ["0", "1"])->comment('рекомендуемый');
            $table->decimal('rating', 2, 1)->default(0)->nullable();
            $table->unsignedBigInteger('views')->default(0)->nullable();
            $table->string('title')->comment('название');
//            $table->unsignedInteger('price_base')->comment('основная цена в копейках');

            $table->text('gallery')->nullable()->comment('галерея');
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('adress_desk')->nullable();
            $table->string('video_url')->nullable();
            $table->text('info_excerpt')->nullable()->comment('информация о мероприятии');
            $table->longText('info_description')->nullable()->comment('подробно о мероприятии');
            $table->string('count_person')->nullable()->comment('человек в группе');
            $table->longText('timetable')->nullable()->comment('Расписание мероприятия');
            $table->longText('included')->nullable()->comment('включено в мероприятие');
            $table->longText('no_included')->nullable()->comment('не включено в мероприятие');
            $table->string('first_aid')->nullable()->comment('первая помощь');
            $table->string('drinking_water')->nullable()->comment('питьевая вода');
            $table->string('communication')->nullable()->comment('средства связи');
            $table->text('accommodation_photo')->nullable()->comment('галерея жилья');
            $table->text('accommodation_description')->nullable()->comment('галерея жилья');
            $table->enum('conditioner', ['0', '1'])->comment('наличие кондиционера');
            $table->enum('wifi', ['0', '1'])->comment('наличие wifi');
            $table->enum('pool', ['0', '1'])->comment('наличие басейна');
            $table->enum('towel', ['0', '1'])->comment('наличие полотенец');
            $table->enum('kitchen', ['0', '1'])->comment('наличие кухни');
            $table->enum('coffee_tea', ['0', '1']);
            $table->enum('private_room', ['0', '1'])->comment('отдельный номер');
            $table->enum('dormitory_room', ['0', '1'])->comment('общий номер');
            $table->enum('separate_house', ['0', '1'])->comment('Отдельный домик');
            $table->enum('transfer_free', ['0', '1'])->comment('трансфер бесплатно');
            $table->enum('transfer_fee', ['0', '1'])->comment('трансфер платно');
            $table->enum('not_transfer', ['0', '1'])->comment('добираетесь сами');
            $table->text('gallery_meals')->nullable()->comment('фото еды');
            $table->text('meals_desc')->nullable()->comment('описание еды');
            $table->enum('vegan', ['0', '1']);
            $table->enum('vegetarianism', ['0', '1']);
            $table->enum('fish', ['0', '1']);
            $table->enum('ayurveda', ['0', '1']);
            $table->enum('meat', ['0', '1']);
            $table->enum('organic', ['0', '1']);
            $table->enum('gluten_free', ['0', '1']);
            $table->enum('milk_free', ['0', '1']);
            $table->enum('nuts_free', ['0', '1']);
            $table->string('count_meals')->nullable()->comment('количество приемов пищи');

//            $table->date('date_start')->nullable();
//            $table->date('date_end')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["category_tour_id"], 'fk_tours_category_tour_idx');
            $table->index(["user_id"], 'fk_users_user_idx');

            $table->foreign('category_tour_id', 'fk_tours_category_tour_idx')
                ->references('id')->on('category_tours')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_users_user_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            \Illuminate\Support\Facades\DB::statement('ALTER TABLE '. $this->tableName .' ADD FULLTEXT search(title, info_excerpt, info_description, country)');
        });
    }


    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists($this->tableName);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
