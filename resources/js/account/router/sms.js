export default [
    {
        name: 'SMS',
        path: '/sms',
        component: () => import('@/account/pages/SMS/SMS'),
        children: [
            {
                name: "SMS List",
                path: 'list',
                component: () => import('@/account/pages/SMS/SMSList'),
                /*beforeEnter(to, from, next){
                    next()
                }*/
            },
            ]
    }
]
