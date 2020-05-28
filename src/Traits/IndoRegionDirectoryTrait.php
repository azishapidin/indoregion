<?php
/**
 * Created by sublime.
 * User: Ibnul Mutaki
 * Date: 28/06/2020
 * Time: 11:50
 */

namespace AzisHapidin\IndoRegion\Traits;


trait IndoRegionDirectoryTrait
{
    /**
     * get directory for default seed.
     *
     * @var string
     */
    public function getDirSeedDefault($dir)
    {
    	return $dir.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR .'seeds'.DIRECTORY_SEPARATOR;;
    }

    /**
     * get directory for default migrations.
     *
     * @var string
     */
    public function getDirMigrationDefault($dir)
    {
    	return $dir.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR .'migrations'.DIRECTORY_SEPARATOR;
    }

    /**
     * get directory for default migrations.
     *
     * @var string
     */
    public function getDirModelDefault($dir)
    {
    	return $dir.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR .'models'.DIRECTORY_SEPARATOR;
    }

    /**
     * get target model on app.
     *
     * @return string
     */
    protected function getDirModelTarget()
    {
        return app()->path().DIRECTORY_SEPARATOR."Models".DIRECTORY_SEPARATOR;
    }

    /**
     * get target model on app.
     *
     * @return string
     */
    protected function getDirSeedTarget()
    {
        return app()->databasePath().DIRECTORY_SEPARATOR."seeds".DIRECTORY_SEPARATOR;
    }

    /**
     * get target model on app.
     *
     * @return string
     */
    protected function getDirMigrationTarget()
    {
        return app()->databasePath().DIRECTORY_SEPARATOR."migrations".DIRECTORY_SEPARATOR;
    }
}