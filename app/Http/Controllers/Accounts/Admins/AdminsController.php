<?php
    
    namespace App\Http\Controllers\Accounts\Admins;
    
    use App\Http\Controllers\Controller;
    use App\Platform\Accounts\Admins\Admin;
    use App\Platform\Accounts\Admins\Repositories\Interfaces\AdminRepositoryInterface;
    use App\Platform\Accounts\Admins\Requests\UpdateAdminFormRequest;
    use App\Platform\Accounts\Admins\Resources\AdminCollection;
    use App\Platform\Accounts\Admins\Resources\AdminFullResource;
    use App\Platform\Accounts\Admins\Resources\AdminResource;
    use App\Platform\Base\Helpers\Authenticated;
    use Illuminate\Http\Request;

    class AdminsController extends Controller
    {
        
        private $adminRepo;
        
        public function __construct(AdminRepositoryInterface $repo) {
            $this->adminRepo = $repo;
        }
        
        public function dashboard() {
            return view('admin.dashboard.index');
        }
    
        public function all_admins() {
            $admins = $this->adminRepo->list();
            return $this->response(Admin::class,AdminCollection::class, $admins);
        }
    
        public function getAdmin($id) {
                $admin =  new AdminResource(Admin::find($id));
                return response(['data'=> $admin, 'message'=> "Success"], 200);
        }
        public function admin() {
            return new AdminFullResource(auth('admin')->user());
        }

        public function update(UpdateAdminFormRequest $form) {
            return $this->adminRepo->update($form->validated());
        }
    
        public function updateOtherAdmin(Request $request) {
            $admin = Admin::find(request('id'));
            $form = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => $admin->email === request('email') ? ['required', 'string', 'email'] : ['required',
                    'string', 'email', 'unique:merchants'],
                'profile_image' => 'nullable|max:500|mimes:png,jpeg,jpg',
                'approved' => 'nullable',
                'roleID' => 'nullable',
                'removeProfileImage' => 'nullable'
            ]);
            return $this->adminRepo->updateOtherAdmin($form,$admin);
        }
        
        public function destroy() {
            //
        }
    }
