<?php
    /**
     * Created by Alabi Olawale
     * Date: 6/13/2019
     */
    declare(strict_types=1);
    
    namespace App\Platform\Accounts;
    
    use App\Platform\Base\Activities\Activity;
    use App\Platform\Base\Helpers\Authenticated;
    use Illuminate\Support\Str;
    
    trait Recordable
    {
        public function activities() {
            return $this->hasMany(Activity::class,'actor_id');
        }
        
        /*$subjectModel comes in as the model of the actionable model. For instance, Address::class
        $subjectName comes in as the exact name of the subject...for instance: Nissam Micra 202
        or 2, Adewale Street, Garki, Abuja. We need this to be appended to the message string.
        */
        public function generateCreatedActivity($subjectModel, $subjectName, $customModelName = null, $customMessage = '', $customDetail = []) {
            if ($customMessage) {
                return Activity::Record($subjectModel, $customMessage, "CREATED", $customDetail);
            } else {
                $user = Authenticated::User();
                $name = $subjectName ? " ($subjectName)" : null;
                $modelName = $customModelName ?? Str::lower(class_basename($subjectModel));
                $message = $user->name . " created a new " . $modelName . $name;
                Activity::Record($subjectModel, $message, "CREATED", $customDetail);
            }
        }
        
        /**
         * @param $subject . The subject with the updated values.
         * @param $oldSubject . The subject with the old values.
         * @param string $customMessage
         * @param array $customDetail
         */
        public function generateUpdatedActivity($subject, $oldSubject, $customMessage = '', $customDetail = []) {
            $details = array_merge($customDetail, $this->detailsOfChangedValues($subject, $oldSubject));
            if ($customMessage) {
                Activity::Record($subject, trim($customMessage, '"'), "UPDATED", $details);
            } else {
                $user = Authenticated::User();
                $objectName = '';
                if ($subject->name) {
                    $objectName = " ($subject->name)";
                }
                $subjectName = Str::lower(class_basename($subject)) ?? '';
                $message = $user->name . " updated " . $subjectName . $objectName;
                Activity::Record($subject, $message, "UPDATED", $details);
            }
        }
        
        public function generateDeletedActivity($subject, $actionName, $actionType = "", $customMessage = "", $details = []) {
            if ($customMessage) {
                return Activity::Record($subject, $customMessage, "DELETED", $details);
            } else {
                $user = Authenticated::User();
                $message = $user->name . " deleted " . $actionType . " ($actionName)";
                return Activity::Record($subject, $message, "DELETED", $details);
            }
        }
        
        /**
         *
         */
        public function generateLoginActivity() {
            $user = Authenticated::User();
            $activity = new Activity();
            $activity->actor_id = $user->id;
            $activity->actor_role = $user->role()->title;
            $activity->actor_path =get_class($user);
            $activity->subject_id = $user->id;
            $activity->subject_type = class_basename($user)."Login";
            $activity->subject_path = get_class($user);
            $activity->action = "LOGIN";
            $activity->message = $user->name . " logs in.";
            $activity->modifications = null;
            $activity->save();
        }
        
        /**
         *
         */
        public function generateRegistrationActivity() {
            $user = Authenticated::User();
            $message = $user->name . " registers.";
            $activity = new Activity();
            $activity->actor_id = $user->id;
            $activity->actor_role = $user->role()->title;
            $activity->actor_path =get_class($user);
            $activity->subject_id = $user->id;
            $activity->subject_type = class_basename($user)."Registration";
            $activity->subject_path = get_class($user);
            $activity->action = "REGISTER";
            $activity->message = $message;
            $activity->modifications = null;
            $activity->save();
        }
        
        /**
         *
         */
        public function generatePasswordRequestActivity($user) {
            $message = $user->name . " successfully requested a new password";
            $activity = new Activity();
            $activity->actor_id = $user->id;
            $activity->actor_role = $user->role()->title;
            $activity->actor_path =get_class($user);
            $activity->subject_id = $user->id;
            $activity->subject_type = class_basename($user)."PasswordRequest";
            $activity->subject_path = get_class($user);
            $activity->action = "NEW PASSWORD";
            $activity->message = $message;
            $activity->modifications = null;
            $activity->save();
        }
        
        /**
         *
         */
        public function generateTooManyLoginAttemptsActivity($user) {
            $lastSubjectType = '';
          if($user->activities->last()){
              $lastSubjectType = $user->activities->last()->subject_type;
          }
          if($lastSubjectType !== class_basename($user)."FailedLogin") {
              $message = $user->name . " is having trouble login in...";
              $activity = new Activity();
              $activity->actor_id = $user->id;
              $activity->actor_role = $user->role()->title;
              $activity->actor_path =get_class($user);
              $activity->subject_id = $user->id;
              $activity->subject_type = class_basename($user)."FailedLogin";
              $activity->subject_path = get_class($user);
              $activity->action = "FAILED_LOGIN";
              $activity->message = $message;
              $activity->modifications = null;
              $activity->save();
          }
        }
        
        /**
         * @param $new : a modelObject.
         * @param $old : model
         * @return array The generated array is given like:
         * [
         * "state" => "from Test state to Oyo"
         * "city" => "from Test city to Ogbomoso"
         * "is_default" => "from false to true"
         * ]
         */
        protected
        function detailsOfChangedValues($new, $old) {
            $changes = [];
            if ($new->getChanges()) {
                foreach ($new->getChanges() as $key => $value) {
                    if($key !== "updated_at"){
                        $stringifyValue = is_string($value) ? $value : "$value";
                        $changes[$key] = [
                            'old' => $old[$key],
                            'new' => json_encode($stringifyValue)
                        ];
                    }
                }
            }
            return $changes;
        }
    }
