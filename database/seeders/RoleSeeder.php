<?php

namespace Database\Seeders;

use Hash;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(array(
            'name' => 'Administrator'
        ));
        Role::create(array(
            'name' => 'utilisateur'
        ));

        /*Permission::create(array(
            'name' => 'ajouter_profiles'
        ));
        Permission::create(array(
            'name' => 'voir_profiles'
        ));
        Permission::create(array(
            'name' => 'ajouter_CV'
        ));*/
        Permission::create(array(
            'name' => 'ajouter_competences'
        ));
        Permission::create(array(
            'name' => 'ajouter_competence'
        ));
        Permission::create(array(
            'name' => 'telecharger_cv'
        ));
        /*Permission::create(array(
            'name' => 'ajouter_utilisateur'
        ));*/

        $user = User::create(array(
            'name' => 'Administrator',
            'email' => 'admin@bitdyne.com',
            'password' => Hash::make('admin123'),
        ));

        $user->assignRole('Administrator');
        $user->givePermissionTo(['ajouter_competences', 'ajouter_competence', 'telecharger_cv']);
        //$user->givePermissionTo(['ajouter_profiles', 'voir_profiles', 'ajouter_CV', 'ajouter_competences', 'ajouter_competence', 'telecharger_cv', 'ajouter_utilisateur']);
    }
}
