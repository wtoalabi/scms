<?php

namespace App\Http\Controllers\Accounts\Users;

use App\Http\Controllers\Controller;
use App\Platform\Accounts\Users\Repositories\Interfaces\UserRepositoryInterface
      ;
use App\Platform\Accounts\Users\Requests\UpdateUserFormRequest;
use App\Platform\Accounts\Users\Resources\UserCollection;
use App\Platform\Accounts\Users\Resources\UserFullResource;
use App\Platform\Accounts\Users\User;

class UsersController extends Controller
{

  private $userRepo;

  public function __construct(UserRepositoryInterface $repo){
        $this->userRepo = $repo;
  }
    public function index() {
      $users = $this->userRepo->list();
        return $this->response(User::class,UserCollection::class, $users);
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show() {
      $user = $this->userRepo->find(auth('user')->id());
      return view('user.dashboard')->with(['user'=> $user]);
    }
    
    public function getUser($id) {
      $user =  new UserFullResource(User::find($id));
        return response(['data'=> $user, 'message'=> "Success"], 200);
    }
    public function edit()
    {
        //
    }

    public function update(UpdateUserFormRequest $form) {
        $user =  $this->userRepo->update($form->validated());
        return response(['data'=> $user, 'message'=> "User updated successfully"], 200);
    }

    public function destroy()
    {
        //
    }
}
