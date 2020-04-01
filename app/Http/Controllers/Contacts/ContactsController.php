<?php

    namespace App\Http\Controllers\Contacts;

    use App\Http\Controllers\Controller;
    use App\Platform\Base\Helpers\Authenticated;
    use App\Platform\Contacts\Contact;
    use App\Platform\Contacts\Requests\CreateContactFormRequest;
    use App\Platform\Contacts\Requests\UpdateContactFormRequest;
    use App\Platform\Contacts\Resources\ContactCollection;
    use App\Platform\Contacts\Resources\ContactResource;
    use App\Platform\Phones\Phone;
    use Illuminate\Support\Collection;

    class ContactsController extends Controller
    {

        public function index() {
            $model = Contact::class;
            $result = $this->list($model);
            return $this->response($model, ContactCollection::class, $result);
        }

        public function create() {
            //
        }

        public function store(CreateContactFormRequest $form) {
            //
        }

        public function show($route, Contact $contact) {
            //sleep(5);
            return $this->singleResponse(new ContactResource($contact));
        }

        public function edit() {
            //
        }

        public function update(UpdateContactFormRequest $form) {
            $user = Authenticated::User();
            $user->can('update', Contact::class);
            $validated = $form->validated();
            $contact = Contact::find(request('id'));
            $contact->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'birthday' => $validated['birthday'],
                'dateAdded' => $validated['dateAdded'],
                'address' => $validated['address'],
            ]);
            $contact->groups()->sync($validated['selectedGroups']);
            $this->savePhone(collect($validated['phones']), $contact);
            return $this->singleResponse(new ContactResource($contact->fresh()));
        }

        public function destroy($route,Contact $contact) {
            $user = Authenticated::User();
            $user->can('delete', [Contact::class,$contact]);
            //$contact->delete();
            $model = Contact::class;
            $result = $this->list($model);
            return $this->response($model, ContactCollection::class, $result);

        }

        private function savePhone(Collection $phones, $contact) {
            $currentPhones = $contact->phones->pluck('number')->toArray();
            $deleteAble = collect(array_diff($currentPhones, $phones->pluck('number')->toArray()));
            if ($deleteAble->count() > 0) {
                $this->deletePhones($deleteAble);
            }
            $currentDefaultPhone = $contact->defaultPhone();
            $phones->each(function ($phone) use ($contact, $currentPhones, $currentDefaultPhone) {
                if (!array_key_exists('id', $phone)) {
                    $this->createPhone($contact, $currentPhones, $phone);
                }
                $this->makePhoneDefault($phone, $currentDefaultPhone);
            });
            return;
        }

        private function deletePhones(Collection $deleteAble) {
            $deleteAble->each(function ($phone) {
                $deletePhone = Phone::where('number', $phone)->first();
                if ($deletePhone) {
                    $deletePhone->delete();
                }
            });
        }

        /**
         * @param $contact
         * @param $currentPhones
         * @param $phone
         */
        private function createPhone($contact, $currentPhones, $phone): void {
            if (!in_array($phone['number'], $currentPhones)) {
                $contact->phones()->create([
                    'number' => $phone['number'],
                ]);
            }
        }

        private function makePhoneDefault($phone, $currentDefault) {
            if ($phone['default']) {
                if ($currentDefault['number'] !== $phone['number']) {
                    $phoneObject = Phone::where('number', $phone['number'])->first();
                    $phoneObject->update(['default' => true]);
                    $currentDefault->update(['default' => false]);
                }
            }
        }
    }
