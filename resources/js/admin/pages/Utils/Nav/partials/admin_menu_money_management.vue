<template>
    <div>
        <v-list-group
            key="settings"
            v-model="money.model"
            :prepend-icon="money.model ? 'mdi-chevron-up':'mdi-chevron-down'"
            append-icon=""
        >
            <template v-slot:activator >
                <v-list-item-content>
                    <v-list-item-title>
                        <p class="menu-group-title">Money Management</p>
                    </v-list-item-title>
                </v-list-item-content>
            </template>
            <v-list-item
                key="users"
                link
            >
                <v-list-item-action >
                    <v-icon>mdi-bank-outline</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>
                        Payments
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
                money: {
                    model: false
                }
            }
        },
        methods: {},
        computed: {}
    }

</script>
