<?php


namespace App\ConfigRepository;


use Alexusmai\LaravelFileManager\Services\ConfigService\DefaultConfigRepository;


class FileManagerConfig extends DefaultConfigRepository
{
    /**
     * Get disk list
     *
     * ['public', 'local', 's3']
     *
     * @return array
     */
    public function getDiskList(): array
    {
        //TODO: МЕТКА: переопределение путей диска для файлового менеджера

        // Переопределяем пути для конкретного юзера
        \Config::set('filesystems.disks.file_manager_cabinet.url', get_image_url_to_profile(\Auth::user()));
        \Config::set('filesystems.disks.file_manager_cabinet.root', get_image_path_to_profile(\Auth::user()));

        if (!defined('IS_ADMIN')) {
            return ['file_manager_cabinet'];
        }else{
            return ['file_manager_admin', 'file_manager_cabinet'];
        }


    }
}
