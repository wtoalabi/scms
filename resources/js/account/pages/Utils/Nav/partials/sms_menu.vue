<template>
    <div>
        <v-list-item
            v-if="userCan('VIEW_SMS')"
            key="sms"
            link
            to="/sms"
        >
            <v-list-item-action>
                <v-icon>mdi-message-processing</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>
                    SMS
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
