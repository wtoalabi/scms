<?php

namespace App\Platform\Base\Authorization;

use App\Platform\Base\BaseModel;
use App\Platform\Base\Helpers\Collections\CustomQuery;

class Permission extends BaseModel {
    use CustomQuery;
  public $timestamps = false;
}
