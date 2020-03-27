import Store from "../store";

export default [
    {
        name: 'Groups',
        path: '/groups',
        component: () => import('@/user/pages/Groups/Groups'),
        children: [
            {
                name: "Groups List",
                path: 'list',
                component: () => import('@/user/pages/Groups/GroupsList'),
                beforeEnter(to, from, next){
                    Store.commit('commitBreadcrumbs',{text: "Groups List", disabled: true,level: 1,href:'/groups/list'});
                    next()
                }
            },
            {
                name: "Group",
                path: '/groups/:id',
                component: () => import('@/user/pages/Groups/Group/Group'),
                /*beforeEnter(to, from, next){
                    next()
                }*/
            }
        ]
    }
]
