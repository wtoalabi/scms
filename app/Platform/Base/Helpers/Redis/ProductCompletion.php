<?php
    /**
     * Created by Alabi Olawale
     * Date: 10/23/2019
     */
    declare(strict_types=1);
    
    namespace App\Platform\Base\Helpers\Redis;
    
    
    use App\Platform\Store\Products\Product;
    use Illuminate\Support\Arr;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Redis;

    class ProductCompletion{
        private static $attributesCollection = [
            'images',
            'categories',
            /*'attributes',*/
            'licenses',
            'features',
            'warranties',
            'certifications'
        ];
        private static $redisArray = [];
        private static $attribute = null;
        
        /**
         * @var Product
         */
        
        private static $product;
        
        public static function Store(Product $product, $attribute) {
            if ($product->completed){
                return true;
            }
            self::$attribute = $attribute;
            self::$product = $product;
            $redisArray = self::GetFromRedis($product);
            if($redisArray->contains($attribute)){
                return "exists";
            }
             self::Update();
        }
    
        public static function Remove(Product $product, $attribute) {
            self::$product = $product;
            self::$attribute = $attribute;
            if($product->fresh()->$attribute->isEmpty()){
                self::RemoveFromRedisArray();
                return self::MarkAsIncomplete();
            }
            return "removed";
        }
        private static function GetFromRedis(Product $product) : Collection{
            $array = Redis::HGET("ProductRelations:".$product->id,'completed');
            if($array){
                $array = collect(json_decode($array));
                self::$redisArray = $array;
                return $array;
            }
            return collect([]);
        }
    
        private static function AddToRedisArray(Product $product) :Collection{
            $redisArray = self::$redisArray;
            $newAttributes = [];
            if(count($redisArray)>0){
                $newAttributes = $redisArray->add(self::$attribute)->toArray();
            }else{
                $newAttributes = [self::$attribute];
            }
            Redis::HSET("ProductRelations:".$product->id, "completed", json_encode($newAttributes));
            return collect($newAttributes);
        }
    
        private static function RemoveFromRedisArray() {
            $product = self::$product;
            $redisArray = self::GetFromRedis($product);
            $newAttributes = $redisArray->reject(self::$attribute)->toArray();
            Redis::HSET("ProductRelations:".$product->id, "completed", json_encode($newAttributes));
            return collect($newAttributes);
        }
        private static function Update() {
            $newAttributes = self::AddToRedisArray(self::$product);
            if($newAttributes->count() === count(self::$attributesCollection)){
                return self::MarkAsCompleted();
            }
            return true;
        }
    
        private static function MarkAsCompleted() {
            $product = self::$product;
            $product->completed = true;
            return $product->save();
        }
        private static function MarkAsIncomplete() {
            self::$product->update([
                'completed'=>false,
            ]);
            return true;
        }
    }
