<template>
    <div>
        <v-list-item
            v-if="userCan('VIEW_EMAILS')"
            key="email"
            link
            to="/emails"
        >
            <v-list-item-action>
                <v-icon>mdi-email-open-multiple</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>
                    Emails
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
