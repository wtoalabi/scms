<template>
    <div>
        <v-list-item
            v-if="userCan('VIEW_CONTACTS')"
            key="contacts"
            to="/contacts/list"
            link
        >
            <v-list-item-action>
                <v-icon>mdi-contacts</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>
                    Contacts
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
        methods: {
            goToContacts(){
                this.$router.push('contacts');
            }
        },
        computed: {}
    }

</script>
