import {getRandomInt} from "../../../utils/helpers/integers";
import Store from '../../store'
export default {
    commitContacts(state, payload) {
        state.contacts.list = payload.data;
        state.contacts.rowsNumber = payload.pagination.rowsNumber;
        state.queries.pagination.queryPagination = payload.pagination;
        //Store.commit("updateBreadcrumb", {crumb: "contacts_list", replacement: "Contacts List"})
    },
    commitContact(state,payload){
        state.contacts.current = payload;
        Store.commit('setTitle', payload.name);
        Store.commit("updateBreadcrumb", {crumb: "Contact", replacement: payload.name})
    }
}
