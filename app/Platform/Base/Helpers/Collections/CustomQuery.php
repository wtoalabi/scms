<?php
    /**
     * Created by Alabi Olawale
     * Date: 8/13/2019
     */
    declare(strict_types=1);
    
    namespace App\Platform\Base\Helpers\Collections;
    
    
    use App\Platform\Base\Helpers\Date\FormatTime;
    use App\Platform\Store\Categories\Category;
    use Carbon\Carbon;
    
    trait CustomQuery
    {
        protected $queryBuilder;
        
        public function scopeFilterQuery($query) {
            $this->queryBuilder = $query;
            $requests = collect(request()->all())->filter();
            $requests->each(function ($value, $query) {
                if (method_exists($this, $query)) {
                    $this->$query($value);
                }
            });
            //dd($this->queryBuilder->count());
            return $this->queryBuilder->orderQuery();
        }
        
        public function scopeOrderQuery($query) {
            $request = request('queryPagination');
            $this->limit_to_merchant($query);
            return $query->orderBy($request['sortBy'] ?? 'created_at', $request['sortDirection']
                ?? 'desc')->paginate($request['rowsPerPage'] ?? 10);
        }
        
        public function searchMultipleColumns($searchArray) {
            $searchColumns = $searchArray[0];
            $searchText = $searchArray[1];
            if ($searchText) {
                $this->queryBuilder->where($searchColumns[0], 'like', "%$searchText%");
                foreach ($searchColumns as $column) {
                    $this->queryBuilder->orWhere($column, 'like', "%$searchText%");
                }
            }
            return $this->queryBuilder;
        }
        
        public function filterBySearch($searchArray) {
            $searchColumn = $searchArray[0];
            $searchText = $searchArray[1];
            if ($searchText) {
                return $this->queryBuilder->where($searchColumn, 'like', "%$searchText%");
            }
            return $this->queryBuilder;
        }
        
        public function filterByDate($dateArray) {
            if ($dateArray) {
                $from = $dateArray['fromDate'];
                $to = $dateArray['toDate'];
                if ($from && $to) {
                    return $this->queryBuilder->whereBetween('created_at', [$from, $to]);
                } else {
                    return $this->queryBuilder;
                }
            }
            return $this->queryBuilder;
        }
        
        public function filterByColumn($queryArray) {
            if ($queryArray) {
                collect($queryArray)->each(function ($each) {
                    $column = $each[0];
                    $value = $each[1];
                    if ($value !== "None") {
                        return $this->queryBuilder->where($column, '=', $value);
                    };
                    return $this->queryBuilder;
                });
            }
            return $this->queryBuilder;
        }
        
        public function filterByRelationship($relationshipArray) {
            collect($relationshipArray)->values()->each(function ($relationship) {
                list($table, $column, $value) = $relationship;
                return $this->queryBuilder->whereHas($table, function ($query) use ($value, $column) {
                    if ($value !== "None") {
                        return $query->where($column, 'like', "%$value%");
                    }
                    return $this->queryBuilder;
                });
            });
            return $this->queryBuilder;
        }
        
        public static function PaginatedCollection($collection) {
            return [
                'data' => $collection,
                'pagination' => Pagination::Get($collection)
            ];
        }
    
        public function limit_to_merchant($query) {
            $merchant = auth('merchant')->user();
            if($merchant){
                $query->where('merchant_id',$merchant->id);
            }
            return $query;
        }
    }
