<?php

use App\Contact;
use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::truncate();


            for($i=1; $i<=20; $i++){
                Contact::create([
                    'name' => "Pepe $i",
                    'surname' => "Perez-$i",
                    "message" => "año  creación de las hojas",
                    'email' => 'alex@gmail.com',
                    ]);
            }
        
    }
}
