<?php

    namespace App\Platform\Phones\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class PhoneResource extends JsonResource
    {
        public function toArray($request) {
            return [
                'id' => $this->id,
                'number' => "$this->number",
                'default' => $this->default
            ];
        }
    }
