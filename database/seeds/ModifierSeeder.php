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
        $modifier->nama_tampilan  = "Topping Kacang";
        $modifier->harga_modifier = "4000";
        $modifier->save();

        // Membuat sample Modifer
        $modifier                 = new Modifier();
        $modifier->nama_modifier  = "Karamel Afrika";
        $modifier->nama_tampilan  = "Karamel Afrika";
        $modifier->harga_modifier = "4000";
        $modifier->save();

        // Membuat sample Modifer
        $modifier                 = new Modifier();
        $modifier->nama_modifier  = "Keju Arab";
        $modifier->nama_tampilan  = "Keju Arab";
        $modifier->harga_modifier = "4000";
        $modifier->save();
    }
}
