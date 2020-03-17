import {getRandomInt} from "../../../utils/helpers/integers";

export default {
    commitContacts(state, payload) {
        state.contacts = payload;
        state.contacts.rowsNumber = payload.pagination.rowsNumber;
        state.queries.pagination.queryPagination = payload.pagination;
    },
    setContactGroupSearch(state,payload){

    }
}
