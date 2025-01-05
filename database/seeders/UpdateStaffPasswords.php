<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class UpdateStaffPasswords extends Seeder
{
    public function run()
    {
        $staffMembers = Staff::all();

        foreach ($staffMembers as $staff) {
            $staff->update(['passw' => Hash::make($staff->password)]);
        }
    }
}
