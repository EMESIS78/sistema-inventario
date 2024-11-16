<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Limpiar la cache de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Definir permisos
        Permission::create(['name' => 'manage inventory']); // Gestionar inventario
        Permission::create(['name' => 'view reports']); // Ver reportes
        Permission::create(['name' => 'register entry']); // Registrar entradas
        Permission::create(['name' => 'register exit']); // Registrar salidas
        Permission::create(['name' => 'transfer stock']); // Transferir inventario

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'Administrador']);
        $admin->givePermissionTo(Permission::all());

        $encargado = Role::create(['name' => 'Encargado']);
        $encargado->givePermissionTo(['manage inventory', 'view reports', 'register entry', 'register exit', 'transfer stock']);

        $almacenista = Role::create(['name' => 'Almacenista']);
        $almacenista->givePermissionTo(['register entry', 'register exit']);
    }
}
