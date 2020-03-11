import Request from "../../../utils/form/StateFulRequest";
export default {
    async loadContacts(store) {
        await Request(`${_globals.userBaseUrl}/contacts`, {
            action : "post",
            mutator: 'commitContacts',
            store,

        })
    }
}
