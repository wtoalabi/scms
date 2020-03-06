<?php

namespace App\Http\Controllers;

use App\Platform\Accounts\Admins\Admin;
use App\Platform\Accounts\Users\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function logoutAllPreexistingLogins() {
        request()->session()->invalidate();
    }

    public function adminIsApproved() {
        return optional(Admin::where('email', request('email'))->first())->approved;
    }
    public function userIsApproved() {
        return optional(User::where('email', request('email'))->first())->approved;
    }
    /**
     * @param $action
     * @return Authenticatable|string|null
     */
    protected function approvedUserCan($action,$model) {
        $user = Authenticated::User();
        $user->check($action, $model);
        return $user;
    }

    protected function generateFailedAttemptsReport($request, $authModel) {
        $user = $this->getUserByEmail($request, $authModel);
        if($user){
            $user->generateTooManyLoginAttemptsActivity($user);
        }
        return true;
    }
    protected function generatePasswordResetActivity(Request $request, string $authModel) {
        $user = $this->getUserByEmail($request, $authModel);
        if($user){
            $user->generatePasswordRequestActivity($user);
        }
        return true;
    }

    private function getUserByEmail($request, $authModel) {
        $email = $request['email'];
        if($email) {
            return $authModel::where('email', $email)->first();
        }
        return null;
    }

    protected function response($model, $modelCollection, $orderedObjects=null,$message="Successful") {
        if(is_null($orderedObjects)){
            $orderedObjects= $model::orderQuery();
        }
        $collection = new $modelCollection($orderedObjects);
        $data = $model::PaginatedCollection($collection);
        return response(['data' => $data, 'message' => $message], 200);

    }

    protected function listResponse($model, $collection) {
        $result = $model::orderQuery();
        return $this->response($model, new $collection($result),
            $result);
    }
}
