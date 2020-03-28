<template>
    <div>
        <loader v-if="loading"/>
        <template v-else>
            <v-card class="mx-auto" style="color: #0288D1; padding: .5rem 1rem" color="light-blue lighten-5"
                    outlined raised>
                <v-card-title class="text-center justify-center"
                              style="flex-direction: column; padding: .5rem 1rem">
                    <h1 class="font-weight-bold display-3">{{contact.name}}</h1>
                    <div class="mt-2" style="font-size: 1.7rem">{{contact.email}}</div>
                    <div style="font-size: .85rem">{{contact.address}}</div>
                </v-card-title>
                <v-row>
                    <v-col class="flex-column">
                        <div>
                            <span class="title">Birthday</span><span class="text">: {{contact.birthday|birthdayString}}</span>
                        </div>
                        <div class="mt-2">
                            <span class="title">Groups:</span>
                            <v-chip
                                small
                                :color="group.default ? 'success' : ''"
                                class="ma-2"
                                v-for="group in contact.groups"
                                :key="group.id">{{group.name}}
                            </v-chip>
                        </div>
                    </v-col>
                    <v-col class="row flex-column">
                        <div>
                            <span class="title">Date Added</span><span class="text">:
                            {{contact.dateAdded}}</span>
                        </div>
                        <div class="mt-2">
                            <span class="title">Phones:</span>
                            <span class="text">
                                <v-chip
                                    small
                                    class="ma-2"
                                    :color="phone.default ? 'success' : ''"
                                    v-for="phone in contact.phones"
                                    :key="phone.id">{{phone.number}}
                                </v-chip>
                            </span>
                        </div>
                    </v-col>
                </v-row>
                <v-card-actions class="justify-end">
                    <v-btn text class="primary">Edit</v-btn>
                    <v-btn class="error">Delete</v-btn>
                </v-card-actions>
            </v-card>
        </template>
    </div>
</template>

<script>
    import loader from '@/utils/loader'

    export default {
        components: {loader},
        mounted() {
            let route = this.$route;
            let tab = route.query.tab;
            let id = route.params.id;
            this.$store.dispatch(this.action, id);
            this.form['contact_id'] = id;
            /*if(_.isEmpty(this.$store.state.currentPMetas)){
                this.getProductMetas();
            }*/
            if (tab) {
                this.tab = tab;
            } else {
                this.tab = "details"
            }
        },
        data() {
            return {
                tab: '',
                form: {},
                action: 'getContact',
            }
        },
        methods: {},
        computed: {
            contact() {
                return this.$store.state.contacts.current
            },
            loading() {
                return this.$store.state.loading;
            },
        }
    }

</script>

<style scoped>
    .title {
        font-size: 1.3rem !important;
        font-weight: 600 !important;
    }

    .text {
        font-size: 1.2rem;
    }
</style>
