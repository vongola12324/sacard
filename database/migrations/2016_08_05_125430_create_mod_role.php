<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Migrations\Migration;

class CreateModRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $moderator = Role::create([
            'name'         => 'Moderator',
            'display_name' => '版主',
            'description'  => '僅擁有商店資訊的管理者',
        ]);

        // Give permission to him
        /* @var Permission $permMenuView */
        $permMenuView = Permission::where('name', 'menu.view')->first();
        /* @var Permission $permShopManage */
        $permShopManage = Permission::where('name', 'shop.manage')->first();
        /* @var Permission $permPositionManage */
        $permPositionManage = Permission::where('name', 'position.manage')->first();
        $moderator->attachPermission($permMenuView);
        $moderator->attachPermission($permShopManage);
        $moderator->attachPermission($permPositionManage);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::where('name', 'Moderator')->delete();
    }
}
