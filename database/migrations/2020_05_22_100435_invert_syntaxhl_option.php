<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Paste;

class InvertSyntaxhlOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pastes', function (Blueprint $table) {
            $table->boolean('syntaxHl')->nullable();
        });
        Paste::where('noSyntax', 1)->update(['syntaxHl' => 0]);
        Paste::where('noSyntax', 0)->update(['syntaxHl' => 1]);
        Schema::table('pastes', function (Blueprint $table) {
            $table->dropColumn(['noSyntax']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pastes', function (Blueprint $table) {
            $table->boolean('noSyntax')->nullable();
        });
        Paste::where('syntaxHl', 1)->update(['noSyntax' => 0]);
        Paste::where('syntaxHl', 0)->update(['noSyntax' => 1]);
        Schema::table('pastes', function (Blueprint $table) {
            $table->dropColumn(['syntaxHl']);
        });
    }
}
