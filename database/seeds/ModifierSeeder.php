<?php

use App\Modifier;
use Illuminate\Database\Seeder;

class ModifierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat sample Modifer
        $modifier                 = new Modifier();
        $modifier->nama_modifier  = "Gruyere cheese";
        $modifier->harga_modifier = "400000";
        $modifier->save();

        // Membuat sample Modifer
        $modifier                 = new Modifier();
        $modifier->nama_modifier  = "Cheese recipe";
        $modifier->harga_modifier = "500000";
        $modifier->save();

        // Membuat sample Modifer
        $modifier                 = new Modifier();
        $modifier->nama_modifier  = "Red wine";
        $modifier->harga_modifier = "600000";
        $modifier->save();
    }
}
