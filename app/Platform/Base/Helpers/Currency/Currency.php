<?php
  /**
   * Created by Alabi Olawale
   * Date: 7/26/2019
   */
  declare(strict_types=1);
  
  namespace App\Platform\Base\Helpers\Currency;
  
  
  class Currency{
    public static function FormatNaira($price) {
      return number_format($price/100, 2);
    }
    
  }