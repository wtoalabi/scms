<?php

    namespace App\Platform\Base\Activities;

    use App\Platform\Base\BaseModel;
    use App\Platform\Base\Helpers\Authenticated;
    use App\Platform\Base\Helpers\Collections\CustomQuery;
    use Illuminate\Support\Str;

    class Activity extends BaseModel
    {
        use CustomQuery;
        protected $connection;
        protected $casts = ['modifications' => 'array'];
        protected $fillable = ['actor_id', 'actor_role', 'actor_path','subject_id', 'subject_type', 'subject_path', 'action', 'message', 'modifications'];

        public function __construct() {
            if (config('app.env') == 'local') {
                $this->connection = "mysql-activities";
            } else {
                $this->connection = "sqlite-activities";
            }
            parent::__construct();
        }


        /**
         * @param $subject . Comes is a  model
         * @param string $message is the text that will be displayed on the front.
         * @param string $action comes in as "CREATED" or "DELETED"
         * @param array $modifications In activities that have changes, like "UPDATED", this is the array of
         * those changes.
         * The resultant model looks like this:
         * "actor_id" => 1
         * "actor_type" => "User"
         * "subject_id" => 1
         * "subject_path" => "App\Platform\Contacts\Addresses\Address"
         * "subject_type" => "address-action"
         * "action" => "CREATED"
         * "message" => "Ayebatari Chimamanda Ekwueme created a new address(Test Address)"
         * "modifications" => "null"
         * "updated_at" => "2019-06-14 20:28:27"
         * "created_at" => "2019-06-14 20:28:27"
         * "id" => 1
         */
        public static function Record($subject, string $message, string $action, array $modifications = null) {
            /*$actor = Authenticated::User();
            $subject_type = Str::lower(class_basename($subject)) . "-" . 'action';
            $activity = new Activity();
            $activity->actor_id = $actor->id;
            $activity->actor_role = $actor->role()->title;
            $activity->actor_path =get_class($actor);
            $activity->subject_id = $subject->id;
            $activity->subject_path = get_class($subject);
            $activity->subject_type = $subject_type;
            $activity->action = $action;
            $activity->message = $message;
            $activity->modifications = collect($modifications)->isEmpty() ? null : $modifications;
            $activity->save();*/
            $actor = Authenticated::User();
            $activity = new Activity();
            $activity->actor_id = $actor->id;
            $activity->actor_role = $actor->role()->title;
            $activity->actor_path =get_class($actor);
            $activity->subject_id = $subject->id;
            $activity->subject_path = get_class($subject);
            $activity->subject_type = class_basename($subject);
            $activity->action = $action;
            $activity->message = $message;
            $activity->modifications = collect($modifications)->isEmpty() ? null : $modifications;
            $activity->save();
        }

    }
