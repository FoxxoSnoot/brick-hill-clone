<?php
/**
 * MIT License
 *
 * Copyright (c) 2021-2022 FoxxoSnoot
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $site = config('site.name');

        Schema::create('forum_topics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('home_page_priority');
            $table->boolean('is_staff_only_viewing')->default(false);
            $table->boolean('is_staff_only_posting')->default(false);
            $table->timestamps();
        });

        DB::table('forum_topics')->insert([
            // [
            //     'name' => 'Information & Announcements',
            //     'description' => 'Important news will be posted here.',
            //     'home_page_priority' => 255,
            //     'is_staff_only_viewing' => false,
            //     'is_staff_only_posting' => true,
            //     'created_at' => Carbon::now()->toDateTimeString(),
            //     'updated_at' => Carbon::now()->toDateTimeString()
            // ],
            [
                'name' => "{$site} Hub",
                'description' => "Talk about all things relating to {$site}.",
                'home_page_priority' => 100,
                'is_staff_only_viewing' => false,
                'is_staff_only_posting' => false,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'name' => 'Off Topic',
                'description' => 'This board is for posts unrelated to any other.',
                'home_page_priority' => 90,
                'is_staff_only_viewing' => false,
                'is_staff_only_posting' => false,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            // [
            //     'name' => 'Marketplace',
            //     'description' => 'Discuss trading, clothes and special items here!',
            //     'home_page_priority' => 80,
            //     'is_staff_only_viewing' => false,
            //     'is_staff_only_posting' => false,
            //     'created_at' => Carbon::now()->toDateTimeString(),
            //     'updated_at' => Carbon::now()->toDateTimeString()
            // ],
            // [
            //     'name' => 'Clan Discussion',
            //     'description' => 'Recruit, battle and talk about your clans.',
            //     'home_page_priority' => 70,
            //     'is_staff_only_viewing' => false,
            //     'is_staff_only_posting' => false,
            //     'created_at' => Carbon::now()->toDateTimeString(),
            //     'updated_at' => Carbon::now()->toDateTimeString()
            // ],
            // [
            //     'name' => 'Support',
            //     'description' => 'Looking for help? Ask here and someone might help!',
            //     'home_page_priority' => 60,
            //     'is_staff_only_viewing' => false,
            //     'is_staff_only_posting' => false,
            //     'created_at' => Carbon::now()->toDateTimeString(),
            //     'updated_at' => Carbon::now()->toDateTimeString()
            // ],
            // [
            //     'name' => 'Suggestions',
            //     'description' => 'Want to make a suggestion? Post here and gather support!',
            //     'home_page_priority' => 50,
            //     'is_staff_only_viewing' => false,
            //     'is_staff_only_posting' => false,
            //     'created_at' => Carbon::now()->toDateTimeString(),
            //     'updated_at' => Carbon::now()->toDateTimeString()
            // ],
            // [
            //     'name' => 'Admin Discussion',
            //     'description' => 'This is the place for admins to communicate with eachother.',
            //     'home_page_priority' => 40,
            //     'is_staff_only_viewing' => true,
            //     'is_staff_only_posting' => true,
            //     'created_at' => Carbon::now()->toDateTimeString(),
            //     'updated_at' => Carbon::now()->toDateTimeString()
            // ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_topics');
    }
}
