import default_state from "./utils/default_state";
import queries_state from "./utils/queries_state";
import contacts_state from "./contacts_state";
import groups_state from "./groups_state";
import user_state from "./user_state";

export default {
    ...default_state,
    ...queries_state,
    ...contacts_state,
    ...groups_state,
    ...user_state,
}
