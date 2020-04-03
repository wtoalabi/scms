<template>
    <div>
        <div v-if="displayTop" style="display: flex;justify-content: flex-start">
            <div class="selectAll ml-10" v-if="allIsSelected">
                <v-btn @click="selectAll" :color="selectAllColor" elevation="2" small>
                    {{selectAllText}}
                </v-btn>
            </div>
            <div class="display buttons">
                <v-btn class="ml-20" color="primary" small>Send Email
                    <v-icon dark right>mdi-email</v-icon>
                </v-btn>
                <v-btn class="ml-20" color="info" small>Send SMS
                    <v-icon dark right>mdi-message-processing</v-icon>
                </v-btn>
                <v-btn class="ml-20" color="error" small>Delete
                    <v-icon dark right>mdi-delete</v-icon>
                </v-btn>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['displayTop', 'allIsSelected','selectedContacts'],
        mounted() {
            console.log(this.selectedContacts)
        },
        data() {
            return {
                selectedAll: false
            }
        },
        methods: {
            selectAll() {
                this.selectedAll = !this.selectedAll;
            }
        },
        computed: {
            selectAllText() {
                return this.selectedAll ? `${this.rowsNumber} contacts selected` : `Select All ${this.rowsNumber} Contacts At Once?`
            },
            rowsNumber() {
                return this.$store.state.contacts.rowsNumber
            },
            selectAllColor() {
                return this.selectedAll ? 'success' : null
            }
        }
    }


</script>
<style scoped lang="scss">
    .display {
        flex:1;
        display: flex;
        //justify-content: space-between;
        button{
            margin-left: 10px;
        }
    }
</style>
