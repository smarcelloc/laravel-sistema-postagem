<?php

use App\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RootUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::where('email', 'like','root@root.com')->count() == 0){
            $user = new User();
            $user->name = 'Root';
            $user->email = 'root@root.com';
            $user->password = Hash::make('root@123');
            $user->save();

            $role = new Role();
            $role->name = 'root';
            $role->label = 'Super Usuário';
            $role->save();

            $user->role()->save($role);
        }
    }
}
