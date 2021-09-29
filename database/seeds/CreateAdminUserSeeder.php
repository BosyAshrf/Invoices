<?php
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$user = User::create([
'name' => 'Bosy Habib',
'email' => 'admin@gmail.com',
'password' => bcrypt('123123'),
'roles_name' => ['Owner'],
'Status' => 'مفعل',
]);

$role = Role::create(['name' => 'Owner']);
$permissions = Permission::pluck('id','id')->all();
$role->syncPermissions($permissions);
$user->assignRole([$role->id]);
}
}
