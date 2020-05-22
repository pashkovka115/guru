<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'dashboard_view', 'description' => 'Просматривать главную панель']);
//        Permission::create(['name' => 'dashboard_edit', 'description' => 'Редактировать ']);
        Permission::create(['name' => 'dashboard_add', 'description' => 'Подтверждать статус пользователя']);
//        Permission::create(['name' => 'dashboard_delete', 'description' => 'Удалять ']);

        Permission::create(['name' => 'user_view', 'description' => 'Просматривать пользователей']);
        Permission::create(['name' => 'user_edit', 'description' => 'Редактировать пользователя']);
        Permission::create(['name' => 'user_add', 'description' => 'Добавлять пользователя']);
        Permission::create(['name' => 'user_delete', 'description' => 'Удалять пользователя']);

        Permission::create(['name' => 'permission_view', 'description' => 'Просматривать разрешения']);
        Permission::create(['name' => 'permission_edit', 'description' => 'Редактировать разрешение']);
//        Permission::create(['name' => 'permission_add', 'description' => 'Добавлять разрешение']); - не имеет смысла
//        Permission::create(['name' => 'permission_delete', 'description' => 'Удалять разрешение']); - не имеет смысла

        Permission::create(['name' => 'role_view', 'description' => 'Просматривать роли']);
        Permission::create(['name' => 'role_edit', 'description' => 'Редактировать роль']);
        Permission::create(['name' => 'role_add', 'description' => 'Добавлять роль']);
        Permission::create(['name' => 'role_delete', 'description' => 'Удалять роль']);

        Permission::create(['name' => 'user-role_view', 'description' => 'Просматривать роли пользователей']);
        Permission::create(['name' => 'user-role_edit', 'description' => 'Синхронизировать пользователей и роли']);
//        Permission::create(['name' => 'user-role_add', 'description' => 'Добавлять роль']); - не имеет смысла
//        Permission::create(['name' => 'user-role_delete', 'description' => 'Удалять роль']); - не имеет смысла

        Permission::create(['name' => 'category-tour_view', 'description' => 'Просматривать категории туров']);
        Permission::create(['name' => 'category-tour_edit', 'description' => 'Редактировать категории туров']);
        Permission::create(['name' => 'category-tour_add', 'description' => 'Добавлять категорию тура']);
        Permission::create(['name' => 'category-tour_delete', 'description' => 'Удалять категорию тура']);

        Permission::create(['name' => 'tour_view', 'description' => 'Просматривать туры']);
        Permission::create(['name' => 'tour_edit', 'description' => 'Редактировать туры']);
        Permission::create(['name' => 'tour_add', 'description' => 'Добавлять тур']);
        Permission::create(['name' => 'tour_delete', 'description' => 'Удалять тур']);

        Permission::create(['name' => 'file-manager_*', 'description' => 'Использовать файловый менеджер']);

        Permission::create(['name' => 'page_view', 'description' => 'Просматривать страницы']);
        Permission::create(['name' => 'page_edit', 'description' => 'Редактировать страницы']);
        Permission::create(['name' => 'page_add', 'description' => 'Добавлять страницы']);
        Permission::create(['name' => 'page_delete', 'description' => 'Удалять страницы']);

        Permission::create(['name' => 'category-post_view', 'description' => 'Просматривать категории записей']);
        Permission::create(['name' => 'category-post_edit', 'description' => 'Редактировать категории записей']);
        Permission::create(['name' => 'category-post_add', 'description' => 'Добавлять категории записей']);
        Permission::create(['name' => 'category-post_delete', 'description' => 'Удалять категории записей']);

        Permission::create(['name' => 'post_view', 'description' => 'Просматривать записи']);
        Permission::create(['name' => 'post_edit', 'description' => 'Редактировать записи']);
        Permission::create(['name' => 'post_add', 'description' => 'Добавлять записи']);
        Permission::create(['name' => 'post_delete', 'description' => 'Удалять записи']);

        Permission::create(['name' => 'landing_view', 'description' => 'Просматривать лендинг']);
        Permission::create(['name' => 'landing_edit', 'description' => 'Редактировать лендинг']);
        Permission::create(['name' => 'landing_add', 'description' => 'Добавлять в лендинг']);
        Permission::create(['name' => 'landing_delete', 'description' => 'Удалять из лендинга']);

        Permission::create(['name' => 'about_view', 'description' => 'Просматривать страницу о нас']);
        Permission::create(['name' => 'about_edit', 'description' => 'Редактировать страницу о нас']);
        Permission::create(['name' => 'about_add', 'description' => 'Добавлять в страницу о нас']);
        Permission::create(['name' => 'about_delete', 'description' => 'Удалять из страницы о нас']);

        Permission::create(['name' => 'home_view', 'description' => 'Просматривать главную']);
        Permission::create(['name' => 'home_edit', 'description' => 'Редактировать главную']);
        Permission::create(['name' => 'home_add', 'description' => 'Добавлять на главную']);
        Permission::create(['name' => 'home_delete', 'description' => 'Удалять из главной']);

        Permission::create(['name' => 'settings_view', 'description' => 'Просматривать настройки']);
        Permission::create(['name' => 'settings_edit', 'description' => 'Редактировать настройки']);
        Permission::create(['name' => 'settings_add', 'description' => 'Добавлять настройки']);
        Permission::create(['name' => 'settings_delete', 'description' => 'Удалять настройки']);

        Permission::create(['name' => 'tags_view', 'description' => 'Просматривать теги мероприятий']);
        Permission::create(['name' => 'tags_edit', 'description' => 'Редактировать теги мероприятий']);
        Permission::create(['name' => 'tags_add', 'description' => 'Добавлять теги мероприятий']);
        Permission::create(['name' => 'tags_delete', 'description' => 'Удалять теги мероприятий']);





        // create roles and assign created permissions

        // this can be done as separate statements
//        $role = Role::create(['name' => 'super_admin']);
//        $role->givePermissionTo('edit articles');
//
//        // or may be done by chaining
//        $role = Role::create(['name' => 'moderator'])
//            ->givePermissionTo(['publish articles', 'unpublish articles']);


        $role = Role::create(['name' => 'super_admin', 'description' => 'Можно всё']);
        $role->givePermissionTo(Permission::all());

        Role::create(['name' => 'moderator', 'description' => 'Просматривает главную'])->givePermissionTo(['dashboard_view']);

        $users = \App\Models\User::all();
        if ($users){
            $admin = $users[0];
            $admin->assignRole('super_admin');
            if (isset($users[1])){
                $moderator = $users[1];
                $moderator->assignRole('moderator');
            }
        }
    }
}






















