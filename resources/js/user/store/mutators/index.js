import loading_mutators from "./utils/loading_mutators";
import query_mutators from "./utils/query_mutators";
import contact_mutators from "./contact_mutators";

export default {
    ...query_mutators,
    ...contact_mutators,
    ...loading_mutators,
}
