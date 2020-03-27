import Request from "../../../utils/form/StateFulRequest";

export default {
    async loadContacts(store) {
        await Request(`contacts`, {
            action: "post",
            mutator: 'commitContacts',
            store,

        })
    },
    async getContact(store, id) {
        if (id) {
            await Request(`get-contact/${id}`, {
                store,
                mutator: "commitContact",
                onSuccessCallback: (contact) => {
                    store.commit('setTitle', contact.name);
                    store.commit("updateBreadcrumb", {crumb: "Contact", replacement: contact.name})
                }
            })
        }
    }
}
