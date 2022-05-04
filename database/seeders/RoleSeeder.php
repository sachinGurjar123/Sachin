<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            ['name'=>'Admin','guard_name'=>'web', 'created_at'=> Carbon::now()],
            ['name'=>'Manager','guard_name'=>'web', 'created_at'=> Carbon::now()],
            ['name'=>'Customer','guard_name'=>'web', 'created_at'=> Carbon::now()],
        ];

        foreach ($role as $value) {
	    	Role::create($value);
    	}
    }
}
