<template>
    <div>
        <v-list-group
            key="settings"
            v-model="accounts_management.model"
            :prepend-icon="accounts_management.model ? 'mdi-chevron-up':'mdi-chevron-down'"
            append-icon=""
        >
            <template v-slot:activator >
                <v-list-item-content>
                    <v-list-item-title>
                        <p class="menu-group-title">Accounts</p>
                    </v-list-item-title>
                </v-list-item-content>
            </template>
            <v-list-item
                key="users"
                link
            >
                <v-list-item-action >
                    <v-icon>mdi-account-group-outline</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>
                        Users
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item
                key="admins"
                link
            >
                <v-list-item-action >
                    <v-icon>mdi-account-cog</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>
                        Administrators
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list-group>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                accounts_management: {
                    model: false
                }
            }
        },
        methods: {},
        computed: {}
    }

</script>
