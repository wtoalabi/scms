export default [
    {
        name: 'Groups',
        path: '/groups',
        component: () => import('@/account/pages/Groups/Groups'),
        children: [
            {
                name: "Groups List",
                path: 'list',
                component: () => import('@/account/pages/Groups/GroupsList'),
                /*beforeEnter(to, from, next){
                    next()
                }*/
            },
            {
                name: "Group",
                path: '/groups/:id',
                component: () => import('@/account/pages/Groups/Group/Group'),
                /*beforeEnter(to, from, next){
                    next()
                }*/
            }
        ]
    }
]
