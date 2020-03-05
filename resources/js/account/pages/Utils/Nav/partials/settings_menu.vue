<template>
    <div>
        <v-list-item
            v-if="userCan('VIEW_SETTINGS')"
            key="settings"
            link
            to="/settings"
        >
            <v-list-item-action>
                <v-icon>mdi-account-cog</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>
                    Settings
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
