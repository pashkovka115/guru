<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        /*
         *  статусы заказов
         *
         *  new - заказан, но не оплачен (новый)
         *  paid - оплачено
         *  return_payment - возврат платежа
         *  delete - удалён
         *  denied - отказано
         *  preauth - средства заблокированы, но не сняты с клиента
         *  confirmPayment - списаны заблокированные средства с клиента
         */


        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [
                '',
                'new',
                'paid',
                'return_payment',
                'delete',
                'denied',
                'preauth',
                'confirmPayment'
            ]);
            $table->bigInteger('customer_id');
            $table->bigInteger('tour_id');
            $table->bigInteger('variant_id');
            $table->bigInteger('organizer_id');
            $table->string('unitpayId')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->text('customer_data')->nullable()->comment('комментарий администратора');
            $table->string('tour_title');
            $table->text('payment_desc')->comment('описание платежа');
            $table->string('organizer_name');
            $table->string('category')->comment('мероприятие');
            $table->string('address')->nullable()->comment('мероприятие');
            $table->string('street')->nullable()->comment('мероприятие');
            $table->string('house')->nullable()->comment('мероприятие');
            $table->string('region')->nullable()->comment('мероприятие');
            $table->string('city')->nullable()->comment('мероприятие');
            $table->string('country')->nullable()->comment('мероприятие');
            $table->string('latitude')->nullable()->comment('мероприятие');
            $table->string('longitude')->nullable()->comment('мероприятие');
            $table->unsignedInteger('price_variant')->comment('цена мероприятия');
            $table->unsignedFloat('deposit')->comment('сумма надбавки');
            $table->unsignedInteger('rate')->comment('процент надбавки');
            $table->string('date_start_variant')->nullable();
            $table->string('date_end_variant')->nullable();
            $table->text('text_variant')->nullable();
            $table->string('latest_actions')->nullable()->comment('последнее действие с оплатой');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
