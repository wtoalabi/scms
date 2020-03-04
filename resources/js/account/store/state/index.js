import default_state from "./utils/default_state";
export default{
    ...default_state,
    user: {
        role: {
            permissions:[
                "VIEW_CONTACTS"
            ]
        }
    }
}
