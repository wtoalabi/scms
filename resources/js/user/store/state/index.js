import default_state from "./utils/default_state";
import queries_state from "./utils/queries_state";
export default{
    ...default_state,
    ...queries_state,
    contacts:[],
    user: {
        plan:{
            name: "Free",
            emailCredit: 3870,
            smsCredit: 290000
        },
        role: {
            permissions:[
                "VIEW_DASHBOARD",
                "VIEW_CONTACTS",
                "VIEW_GROUPS",
                "VIEW_EMAILS",
                "VIEW_SMS",
                "VIEW_SETTINGS",
            ]
        }
    }
}
