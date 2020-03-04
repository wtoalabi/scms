import default_state from "./utils/default_state";
export default{
...default_state,
    admin: {
        role: {
            permissions:[
                "VIEW_USERS",
                "VIEW_ADMINS",
                "VIEW_PAYMENTS",
                "VIEW_SMS_API",
                "VIEW_EMAIL_API",
            ]
        }
    }
}
