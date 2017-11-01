<?php
/**
 * Migration to create a table for bookmarks in persistent storage.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration to create a table for bookmarks in persistent storage.
 *
 * @see \App\Bookmark Model for bookmarks, e.g., the resources stored in this table.
 */
class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_user_id');
            $table->string('uri', 1023);
            $table->string('iconuri', 1023)->nullable();
            $table->string('title')->nullable();
            $table->string('tags')->nullable();
            $table->string('keyword')->nullable();
            $table->string('description', 1023)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('owner_user_id');
            $table->foreign('owner_user_id')->references('id')->on('users');

            $table->index('uri');

            // @todo We will use full text indexing on the text fields instead of PostgreSQL indexes.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
}
