<?php

namespace App\Http\Controllers\Accounts\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class GuestsController extends Controller{
  /*
   At the initiation of the store page (e.g homepage), a javascript program runs that asks if the user browser
  has a localStorage value set.
  If not, a javascript fetch call is made to this store method.
  And its job is as follows:
  1. It gets a unique random ID which it now sends back to the calling JS fetch function as a
  response.
  2. To get this unique random ID, the getUniqueRandomID method firstly get two sets of random
  numbers(a randomPrefix and a random key).
  RandomPrefix is a range between 0 and 100 while the random key is a string that combines both
  the randomPrefix with a 30 length random alphanumeric string.
  3. It takes these two and ask the Redis instance if a combination of these numbers exist within it.
  If it exists, a recursion is done to ask and regenerate another set of randomPrefix and key.
  When it finds a unique combination, it sets it into redis and returns the key back to the store
  method which in turn returns it back to the calling JS fetch function.
  4. The final key looks like this: 1-MIlCwfLx8xH932XjzTWRQu9blufV9I
  And the purpose is that, in redis, we break the clusters of Hashmaps into a range of 0 to 100
  (using the prefix). So, the address of this key (1-MIlCwfLx8xH932XjzTWRQu9blufV9I) on redis will be
  Guest:1 while the key itself is 1-MIlCwfLx8xH932XjzTWRQu9blufV9I.
  This allows us to not overload a hash dictionary with too much entries. There are about 100 of them
  distributed around.
  Consequently, whenever we need to find the key, its address is in itself.
  Just break it into two, using the '-' separator. In our example, if we do this, we would have:
  an array of 1 and 1MIlCwfLx8xH932XjzTWRQu9blufV9I ([1, MIlCwfLx8xH932XjzTWRQu9blufV9I]).
  Use the 1 to locate the address (Guest:1) and the original value "1-MIlCwfLx8xH932XjzTWRQu9blufV9I"
  to get the key.
   * */
  public function store() {
    $id = $this->getUniqueRandomID();
    return response(['data'=> $id],200);
    }
  
  private function getUniqueRandomID() {
    list($randomPrefix, $key) = $this->generateRandomNumbers();
    $IDExists = Redis::HGET("Guests:$randomPrefix", $key);
    if($IDExists){
      return $this->getUniqueRandomID();
    }else{
    Redis::HSET("Guests:$randomPrefix", $key, 1);
    return $key;
    }
  }
  
  /**
   * @return array
   */
  private function generateRandomNumbers(): array {
    $randomString = Str::random(30);
    $randomPrefix = rand(0, 100);
    $key = "$randomPrefix-$randomString";
    return array($randomPrefix, $key);
  }
}
