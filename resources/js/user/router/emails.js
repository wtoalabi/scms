export default [
    {
        name: 'Emails',
        path: '/emails',
        component: () => import('@/user/pages/Emails/Emails'),
        children: [
            {
                name: "Emails List",
                path: 'list',
                component: () => import('@/user/pages/Emails/EmailsList'),
                /*beforeEnter(to, from, next){
                    next()
                }*/
            },
            ]
    }
]
