export default [
    {
        name: 'Emails',
        path: '/emails',
        component: () => import('@/account/pages/Emails/Emails'),
        children: [
            {
                name: "Emails List",
                path: 'list',
                component: () => import('@/account/pages/Emails/EmailsList'),
                /*beforeEnter(to, from, next){
                    next()
                }*/
            },
            ]
    }
]
