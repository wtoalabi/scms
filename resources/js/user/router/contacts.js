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
                meta: {
                    id:'contacts_list',
                    parents:[]
                },
                component: () => import('@/user/pages/Contacts/ContactsList'),
                /*beforeEnter(to, from, next){
                    next()
                }*/
            },
            {
                name: "Contact",
                path: '/contacts/:id',
                component: () => import('@/user/pages/Contacts/Contact/Contact'),
                beforeEnter(to, from, next){
                    next()
                },
                meta: {
                    id:'contact',
                    parents:['contacts_list']
                }
            }
        ]
    }
]
