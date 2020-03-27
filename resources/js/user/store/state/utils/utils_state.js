export default {
    breadcrumbs: {
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
                url: '#/'
            },
            contacts_list: {
                name: 'Contacts List',
                url: '#/contacts/list'
            },
            contact: {
                name: 'Contact',
                url: '#/contacts/list/:id'
            }
        }
    },
}
