<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Platform\Contacts\Contact;
use App\Platform\Contacts\Requests\CreateContactFormRequest;
use App\Platform\Contacts\Requests\UpdateContactFormRequest;
use App\Platform\Contacts\Resources\ContactCollection;

class ContactsController extends Controller
{

    public function index(){
        $model = Contact::class;
         $result = $this->list($model);
         return $this->response($model, ContactCollection::class, $result);
    }

    public function create(){
        //
    }

    public function store(CreateContactFormRequest $form){
        //
    }

    public function show(){
        //
    }

    public function edit(){
        //
    }

    public function update(UpdateContactFormRequest $form){
        //
    }

    public function destroy(){
        //
    }
}
