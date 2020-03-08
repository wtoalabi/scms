<?php
    /**
     * Created by Alabi Olawale
     * Date: 9/6/2019
     */
    declare(strict_types=1);

    namespace App\Platform\Base;
    use GeneaLabs\LaravelModelCaching\Traits\Cachable;
    use Illuminate\Database\Eloquent\Model as Eloquent;

    abstract class BaseModel extends Eloquent{
        use Cachable;
        protected $cachePrefix = "scms-cache-01";
    }
