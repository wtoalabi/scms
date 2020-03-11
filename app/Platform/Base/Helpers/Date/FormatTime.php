<?php
  /**
   * Created by Alabi Olawale
   * Date: 7/2/2019
   */
  declare(strict_types=1);

  namespace App\Platform\Base\Helpers\Date;
  use Faker\Factory as Faker;

  use Carbon\Carbon;

  class FormatTime{

      /**
       * @param String $time
       * @return int
       * @throws \Exception
       */
    public static function ToTimestamp(String $time) {
        $carbonTime = new Carbon($time);
      return $carbonTime->getTimestamp();
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
      public static function GetRandomDateStamp() {
          $faker = Faker::create();
          $date = $faker->dateTimeBetween('-40 months', '-2 months');
          try {
              $carbonTime = new Carbon($date);
              return $carbonTime->getTimestamp();
          } catch (\Exception $e) {
          }
      }

      public static function GeBirthdayArray($day, $month) {
          $monthWeight = [
              1 => 100,
              2 => 150,
              3 => 200,
              4 => 250,
              5 => 300,
              6 => 350,
              7 => 400,
              8 => 450,
              9 => 500,
              10 => 550,
              11 => 600,
              12 => 650
          ];
          $weight = ($monthWeight[$month] * $month) + ($day);
          return ['day'=>$day,'month'=>$month, 'weight'=>$weight];
          /*Contact::all()->sortBy(function($a){return $a->birthday['weight'];})->pluck(['birthday'])*/
      }
  }
