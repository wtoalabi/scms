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
                <div class="mb-3 mt-3">
                    <v-expansion-panels accordion>
                        <v-expansion-panel>
                            <v-expansion-panel-header>Advanced Filters</v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <v-row>
                                <group-selector :incomingGroup="0" action="loadContacts"/>
                                    <birth-day-selector
                                        @filterByDateOfBirth="filterByDateOfBirth"/>
                                </v-row>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </div>
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
                :items-per-page="10"
                class="elevation-1"
                :options.sync="options"
                :server-items-length="rowsNumber"
            >
                <template v-slot:item.birthday="{ item }">
                    <p>{{item.birthday | birthdayString}}</p>
                </template>
                <template v-slot:item.groups="{ item }">
                    <groups-chip :max="2"  :prop-groups="item.groups"/>
                </template>
            </v-data-table>

        </template>
    </div>
</template>

<script>
    import GroupsChip from "../../../utils/SharedComponents/Groups/GroupsChip";
    import GroupSelector from "../../../utils/SharedComponents/Contacts/GroupSelector";
    import BirthDaySelector from "../../../utils/SharedComponents/Contacts/BirthDaySelector";

    export default {
        components: {GroupsChip, GroupSelector,BirthDaySelector},
        data() {
            return {
                options: {},
                form: {},
                sortBy: ['first_name'],
                sortDesc: false,
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
                        text: 'Groups',
                        align: 'start',
                        sortable: false,
                        value: 'groups',
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
                handler() {
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
            filterByDateOfBirth(selectedDateOfBirth){
                this.$store.commit("setQueryFilterByBirthday",
                    ['birthday',selectedDateOfBirth]);
                this.loadContacts()
                console.log(selectedDateOfBirth)
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
