<?php

    namespace App\Platform\Phones\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class PhoneResource extends JsonResource
    {
        public function toArray($request) {
            return [
                'id' => $this->id,
                'number' => "0$this->number",
                'default' => $this->default
            ];
        }
    }
