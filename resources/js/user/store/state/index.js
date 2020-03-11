import default_state from "./utils/default_state";
export default{
    ...default_state,
    contacts:[],
    user: {
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
