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
        $modifier->nama_modifier  = "Topping Kacang";
        $modifier->harga_modifier = "4000";
        $modifier->save();

        // Membuat sample Modifer
        $modifier                 = new Modifier();
        $modifier->nama_modifier  = "Karamel Afrika";
        $modifier->harga_modifier = "5000";
        $modifier->save();

        // Membuat sample Modifer
        $modifier                 = new Modifier();
        $modifier->nama_modifier  = "Keju Arab";
        $modifier->harga_modifier = "6000";
        $modifier->save();
    }
}
