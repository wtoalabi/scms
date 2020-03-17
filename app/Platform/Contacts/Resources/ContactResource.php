<?php

    namespace App\Platform\Contacts\Resources;

    use Carbon\Carbon;
    use Illuminate\Http\Resources\Json\JsonResource;

    class ContactResource extends JsonResource
    {
        public function toArray($request) {
            return [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'address' => $this->address,
                'groups' => $this->groups->map(function ($group) {
                    return [
                        'id' => $group->id,
                        'name' => $group->name
                    ];
                }),
                'dateAdded' => (new Carbon($this->dateAdded))->format("d-M-Y"),
                'birthday' => ['day' => $this->birthday['day'], 'month' => $this->birthday['month']],
            ];
        }
    }

