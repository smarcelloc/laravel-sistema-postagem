<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configGetPermission = Config('permission');
        $permissionName = Arr::pluck($configGetPermission, 'name');
        $permissionLabel = Arr::pluck($configGetPermission, 'label');
        $permissionSize = count($configGetPermission);

        for ($i = 0; $i < $permissionSize; $i++) {
            $isExistsPermissionName = Permission::where('name', 'like', $permissionName[$i])->count();

            if ($isExistsPermissionName != 0)
                continue;

            $permission = new Permission();
            $permission->name = $permissionName[$i];
            $permission->label = $permissionLabel[$i];
            $permission->save();
        }
    }
}
