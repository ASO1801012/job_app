<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class JobtypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobtypes = ['正社員','契約社員','アルバイト'];
        foreach ($jobtypes as $jobtype) {
            DB::table('jobtypes')->insert(['jobtype'=>$jobtype]);
        }
    }
}
