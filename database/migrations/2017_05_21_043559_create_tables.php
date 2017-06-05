<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('nickname', 50);
            $table->string('password', 255);
            $table->string('device_id',50);
            $table->string('phone', 50);
            $table->string('email', 50);
            $table->string('remember_token', 255)->nullable();
            $table->timestamps();
        });
        Schema::create('friends', function (Blueprint $table) {
            $table->increments('friend_id');
            $table->integer('friend_from')->unsigned();
            $table->foreign('friend_from')->references('user_id')->on('users');
            $table->integer('friend_to')->unsigned();
            $table->foreign('friend_to')->references('user_id')->on('users');
            $table->enum('status', ['pending', 'accepted', 'declined']);
            $table->timestamps();
        });
        Schema::create('food_catalog', function (Blueprint $table) {
            $table->increments('food_id');
            $table->string('name', 50);
            $table->integer('hungry_recovery');
            $table->enum('type', ['picante', 'salado', 'dulce', 'acido', 'frio', 'caliente', 'vencido']);
            $table->integer('percentage_effect');
            $table->integer('due_date'); // in days
            $table->timestamps();
        });
        Schema::create('food_users', function (Blueprint $table) {
            $table->increments('food_user_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->integer('food_id')->unsigned();
            $table->foreign('food_id')->references('food_id')->on('food_catalog');
            $table->enum('status', ['good', 'expired', 'bad']);
            $table->timestamps();
        });
        Schema::create('users_profiles', function (Blueprint $table) {
            $table->increments('user_profile_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->integer('level')->unsigned();
            $table->integer('experience')->unsigned();
            $table->integer('hp')->unsigned();
            $table->integer('mana')->unsigned();
            $table->integer('agi')->unsigned();
            $table->integer('str')->unsigned();
            $table->integer('int')->unsigned();
            $table->integer('phys_dmg')->unsigned();
            $table->integer('magic_dmg')->unsigned();
            $table->integer('armor')->unsigned();
            $table->enum('status', ['active', 'disabled', 'tired','good','energized','hungry','sleeping','sick','angry']);
            $table->date('last_action_date');
            $table->integer('hungry_points')->unsigned();
            $table->integer('tired_points')->unsigned();
            $table->integer('cash_points')->unsigned();
            $table->integer('longitude')->unsigned()->nullable();
            $table->integer('latitude')->unsigned()->nullable();
            $table->string('shape', 10);
            $table->string('color', 10);
            $table->string('eye', 10);
            $table->timestamps();
        });
        Schema::create('dungeons', function (Blueprint $table) {
            $table->increments('dungeon_id');
            $table->integer('level_required')->unsigned();
            $table->integer('durability')->unsigned(); // in hours
            $table->string('name', 50);
            $table->enum('status', ['easy', 'normal', 'hard','crazy','nightmare']);
            $table->string('exp_reward_range',50);
            $table->string('cash_reward_range',50);
            $table->string('tired_cost_range',50);
            $table->string('hungry_cost_range',50);
            $table->timestamps();
        });
        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->string('name', 50);
            $table->string('phys_atk_range',50);
            $table->string('magic_atk_range',50);
            $table->integer('armor')->unsigned();
            $table->string('level_required',50);
            $table->string('class_required',50);
            $table->integer('bonus_hp')->unsigned();
            $table->integer('bonus_mana')->unsigned();
            $table->integer('bonus_agi')->unsigned();
            $table->integer('bonus_str')->unsigned();
            $table->integer('bonus_int')->unsigned();
            $table->integer('bonus_level')->unsigned();
            $table->string('durability', 50);
            $table->enum('type', ['normal', 'epic', 'mythic','legendary']);
            $table->enum('slot', ['head', 'hand', 'body','back','legs']);
            $table->enum('status', ['active','inactive']);
            $table->timestamps();
        });
        Schema::create('items_dungeons_drops', function (Blueprint $table) {
            $table->increments('item_dungeon_drop_id');
            $table->integer('dungeon_id')->unsigned();
            $table->foreign('dungeon_id')->references('dungeon_id')->on('dungeons');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('item_id')->on('items');
            $table->integer('drop_chance')->unsigned(); // in %
            $table->timestamps();
        });
        Schema::create('items_users', function (Blueprint $table) {
            $table->increments('item_user_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('item_id')->on('items');
            $table->enum('status', ['active','broken']);
            $table->timestamps();
        });
        Schema::create('dungeons_users', function (Blueprint $table) {
            $table->increments('dungeon_user_id');
            $table->integer('dungeon_id')->unsigned();
            $table->foreign('dungeon_id')->references('dungeon_id')->on('dungeons');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->datetime('init_date');
            $table->datetime('end_date');
            $table->enum('status', ['active','completed','lost']);
            $table->timestamps();
        });
        Schema::create('sleeping_users', function (Blueprint $table) {
            $table->increments('sleeping_user_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->datetime('init_date');
            $table->datetime('end_date');
            $table->integer('tired_recovery')->unsigned();
            $table->integer('hungry_cost')->unsigned();
            $table->enum('status', ['sleeping','completed','lost']); // lost by hungry issue
            $table->timestamps();
        });
        Schema::create('duels_users', function (Blueprint $table) {
            $table->increments('duel_user_id');
            $table->integer('user_from_id')->unsigned();
            $table->foreign('user_from_id')->references('user_id')->on('users');
            $table->integer('user_to_id')->unsigned();
            $table->foreign('user_to_id')->references('user_id')->on('users');
            $table->enum('status', ['active','completed','pending','declined']);
            $table->datetime('init_date');
            $table->datetime('end_date');
            $table->integer('user_won')->unsigned();
            $table->foreign('user_won')->references('user_id')->on('users');
            $table->integer('durability_lost')->unsigned();
            $table->integer('cash_lost')->unsigned();
            $table->integer('hungry_cost')->unsigned();
            $table->integer('tired_cost')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('friends');
        Schema::drop('food_catalog');
        Schema::drop('food_users');
        Schema::drop('users_profiles');
        Schema::drop('dungeons');
        Schema::drop('items');
        Schema::drop('items_dungeons_drops');
        Schema::drop('items_users');
        Schema::drop('dungeons_users');
        Schema::drop('sleeping_users');
        Schema::drop('duels_users');
    }
}
