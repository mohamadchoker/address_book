<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->string('gender');
            $table->date('birth_date')->nullable();
            $table->string('location')->nullable();
            $table->string('company')->nullable();
            $table->string('job_title')->nullable();
            $table->foreignId('group_id')->nullable()->constrained('groups');
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('is_favorite')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['user_id','email']);
            $table->unique(['user_id','facebook_link']);
            $table->unique(['user_id','twitter_link']);
            $table->unique(['user_id','linkedin_link']);
            $table->unique(['user_id','instagram_link']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
