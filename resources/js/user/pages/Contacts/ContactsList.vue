<template>
    <div>
        <template>
            <v-card>
                <v-card-title>
                    Contacts List
                    <v-spacer></v-spacer>
                    <v-text-field
                        @input="search"
                        v-model="searchText"
                        :append-icon="searchText ? '': 'mdi-magnify'"
                        label="Search"
                        single-line
                        clearable
                        hide-details
                    ></v-text-field>
                </v-card-title>
            </v-card>
            <v-data-table
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc" :search="searchText"
                v-model="selected"
                show-select
                :loading="loading"
                loading-text="Loading... Please wait"
                :headers="headers"
                :items="contacts"
                must-sort
                :items-per-page="5"
                class="elevation-1"
                :options.sync="options"
                :server-items-length="rowsNumber"
            >
                <template v-slot:item.birthday="{ item }">
                    <p>{{item.birthday | birthdayString}}</p>
                </template>
            </v-data-table>

        </template>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                options: {},
                form: {},
                sortBy: ['first_name'],
                sortDesc: true,
                searchText: '',
                selected: [],
                headers: [
                    {
                        text: 'First Name',
                        align: 'start',
                        sortable: true,
                        value: 'first_name',
                    }, {
                        text: 'Last Name',
                        align: 'start',
                        sortable: true,
                        value: 'last_name',
                    }, {
                        text: 'Email',
                        align: 'start',
                        sortable: true,
                        value: 'email',
                    }, {
                        text: 'Birth Date',
                        align: 'start',
                        sortable: true,
                        value: 'birthday',
                    }, {
                        text: 'Date Added',
                        align: 'start',
                        sortable: true,
                        value: 'dateAdded',
                    },
                ]
            }
        },
        watch: {
            options: {
                handler(){
                    this.$store.commit("setQueryOptions", this.options);
                    this.loadContacts()
                }
            }
        },
        methods: {
            search(searchText) {
                _.debounce(async () => {
                    this.$store.commit("setQuerySearchArray", {'searchMultipleColumns': [['first_name', 'last_name', 'email'], searchText]});
                    this.loadContacts();
                })
            },
            loadContacts() {
                this.$store.dispatch("loadContacts");
            },
            sortingBy() {
                console.log('sorting...')
            }
        },
        computed: {
            contacts() {
                return this.$store.state.contacts.data
            },
            loading() {
                return this.$store.state.loading;
            },
            rowsNumber() {
                return this.$store.state.contacts.rowsNumber
            }
        }
    }

</script>
