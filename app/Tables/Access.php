<?php

namespace ApiPosts\Tables;

use Illuminate\Database\Schema\Blueprint;

class Access
{
    /**
     * Creates the table.
     *
     * @param \Illuminate\Database\Schema\Blueprint $table
     */
    public function activate(Blueprint $table)
    {
        $table->increments('id');

        $table->string('address', 100);

        $table->timestamps();
    }

    /**
     * Deactivates the table.
     *
     * @param \Illuminate\Database\Schema\Blueprint $table
     */
    public function deactivate(Blueprint $table)
    {
        //
    }

    /**
     * Deletes the table.
     *
     * @param \Illuminate\Database\Schema\Blueprint $table
     */
    public function delete(Blueprint $table)
    {
        $table->drop();
    }
}
