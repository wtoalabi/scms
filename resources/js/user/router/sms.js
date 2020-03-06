export default [
    {
        name: 'SMS',
        path: '/sms',
        component: () => import('@/user/pages/SMS/SMS'),
        children: [
            {
                name: "SMS List",
                path: 'list',
                component: () => import('@/user/pages/SMS/SMSList'),
                /*beforeEnter(to, from, next){
                    next()
                }*/
            },
            ]
    }
]
