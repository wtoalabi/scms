<template>
    <div>
        <loader v-if="loading"/>
        <template v-else>
            <v-card class="mx-auto" style="color: #0288D1; padding: .5rem 1rem"
                    color="light-blue lighten-5"
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
                <v-card-actions style="margin-top: 2.5rem">
                    <v-btn text class="primary" @click="showEditForm=true">Edit</v-btn>
                    <v-btn @click="showDeleteDialog(contact)" class="error">Delete</v-btn>
                </v-card-actions>
            </v-card>
            <contact-form v-if="showEditForm" @close="showEditForm=false"/>
            <v-dialog
                v-model="deleteDialog"
                max-width="350"
                heigth="300"
            >
                <v-card>
                    <v-card-title class="headline">Delete Contact?</v-card-title>

                    <v-card-text>
                        Are you sure you want to delete the contact
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn small color="green darken-1" @click="deleteDialog = false">
                            Cancel
                        </v-btn>

                        <v-btn small
                               color="green darken-1" text @click="deleteContact">
                            Delete Contact
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </template>
    </div>
</template>

<script>
    import loader from '@/utils/loader'
    import ContactForm from "./ContactForm";
    import Requests from "../../../../utils/form/StateFulRequest";

    export default {
        components: {loader, ContactForm},
        mounted() {
            let route = this.$route;
            let tab = route.query.tab;
            let id = route.params.id;
            this.$store.dispatch(this.action, id);
            this.form['contact_id'] = id;
            if (tab) {
                this.tab = tab;
            } else {
                this.tab = "details"
            }
        },
        data() {
            return {
                deleteDialog: false,
                tab: '',
                form: {},
                action: 'getContact',
                showEditForm: false,
            }
        },
        methods: {
            showDeleteDialog(contact) {
                this.deleteDialog = true;
            },
            deleteContact() {
                Requests(`contact/${this.contact.id}`, {
                    store: this.$store,
                    action: "delete",
                    onSuccessCallback: (contacts) => {
                        this.deleteDialog = false;
                        console.log(contacts)
                        this.$store.commit("commitContacts", contacts);
                        this.$router.push("contacts/list")
                    }
                })
            }
        },
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
