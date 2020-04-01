import Store from "../store";

export default [
    {
        name: 'Contacts',
        path: '/contacts',
        component: () => import('@/user/pages/Contacts/Contacts'),
        children: [
            {
                name: "Contacts List",
                path: 'list',
                component: () => import('@/user/pages/Contacts/ContactsList'),
                meta: {
                    id:'contacts_list',
                    parents:[]
                }
            },
            {
                name: "Contact",
                path: '/contacts/:id',
                component: () => import('@/user/pages/Contacts/Contact/Contact'),
                meta: {
                    id:'contact',
                    parents:['contacts_list']
                }
            }
        ]
    }
]
