import {getRandomInt} from "../../../utils/helpers/integers";

export default {
    commitContacts(state, payload) {
        state.contacts.list = payload.data;
        state.contacts.rowsNumber = payload.pagination.rowsNumber;
        state.queries.pagination.queryPagination = payload.pagination;
    },
    commitContact(state,payload){
        state.contacts.current = payload;
        //state.breadcrumbs.map.contact.name = payload.name;
    }
}
