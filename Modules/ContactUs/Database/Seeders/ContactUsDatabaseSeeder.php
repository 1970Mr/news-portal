<?php

namespace Modules\ContactUs\Database\Seeders;

use Illuminate\Database\Seeder;

class ContactUsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ContactInfoSeeder::class,
        ]);
    }
}
