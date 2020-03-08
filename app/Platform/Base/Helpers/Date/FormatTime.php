<?php
  /**
   * Created by Alabi Olawale
   * Date: 7/2/2019
   */
  declare(strict_types=1);
  
  namespace App\Platform\Base\Helpers\Date;
  
  
  use Carbon\Carbon;

  class FormatTime{
    
    /**
     * @param Carbon $time
     * @return int
     */
    public static function ToTimestamp(Carbon $time) {
      return $time->getTimestamp();
    }
  
    /**
     * Comes in as a timestamp and formatted by default to look like:
     * "2nd of July, 2019 11:22:22 pm"
     * @param $timestamp
     * @param string $format
     * @return string
     */
    public static function FromTimestamp($timestamp, $format='jS \o\f F, Y g:i:s a') {
      return Carbon::createFromTimestamp($timestamp)->format($format);
    }
    
      public static function FromAndTo($from, $to) {
          return [
              Carbon::createFromTimestampMS($from)->addHours(1)->toDateTimeString(),
              Carbon::createFromTimestampMS($to)->addHours(1)->toDateTimeString()
          ];
          
    }
    
  }
