export default [
    {
        name: 'Contacts',
        path: '/contacts',
        component: () => import('@/account/pages/Contacts/Contacts'),
        children: [
            {
                name: "Contacts List",
                path: 'list',
                component: () => import('@/account/pages/Contacts/ContactsList'),
                /*beforeEnter(to, from, next){
                    next()
                }*/
            },
            {
                name: "Contact",
                path: '/contacts/:id',
                component: () => import('@/account/pages/Contacts/Contact/Contact'),
                /*beforeEnter(to, from, next){
                    next()
                }*/
            }
        ]
    }
]
