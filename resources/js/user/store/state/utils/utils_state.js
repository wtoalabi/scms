export default {
    breadcrumbs: {
        reloadCount: 0,
        list: [],
        show: true,
        dashboard: {
            text: 'Dashboard',
            disabled: false,
            href: '#/',
        },
        map: {
            dashboard: {
                name: 'Dashboard',
                url: '#/',
                id:'Dashboard'
            },
            contacts_list: {
                id: 'ContactsList',
                name: 'Contacts List',
                url: '#/contacts/list'
            },
            contact: {
                id: 'Contact',
                name: 'Contact',
                url: '#/contacts/list/:id'
            }
        }
    },
}
