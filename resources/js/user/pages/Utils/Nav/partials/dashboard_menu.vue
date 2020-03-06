<template>
    <div>
        <v-list-item
            v-if="userCan('VIEW_DASHBOARD')"
            key="dashboard"
            link
            to="/"
        >
            <v-list-item-action>
                <v-icon>mdi-view-dashboard</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>
                    Dashboard
                </v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </div>
</template>

<script>
    import groupMenuPermission from './menu_permission'

    export default {
        mixins: [groupMenuPermission],
        data() {
            return {

            }
        },
        methods: {},
        computed: {}
    }

</script>
