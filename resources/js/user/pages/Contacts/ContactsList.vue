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
                                    <div class="col-5">
                                        <group-selector :incomingGroup="0" action="loadContacts"/>
                                    </div>
                                    <div class="col-7">
                                        <birth-day-selector
                                            @filterByDateOfBirth="filterByDateOfBirth"/>
                                    </div>
                                </v-row>
                                <v-row>
                                    <date-selector
                                        @filter="searchByDateJoined"
                                        from-label="Filter Date Joined From:"
                                        to-label="To"
                                    />
                                </v-row>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </div>
            </v-card>
            <v-data-table
                @toggle-select-all="displayTop = !displayTop"
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
                <template v-slot:top>
                    <div v-if="displayTop">
                    <button>Send Mail</button>
                    <button>Send SMS</button> to all at once?
                    </div>
                </template>
                <template v-slot:item.birthday="{ item }">
                    <p>{{item.birthday | birthdayString}}</p>
                </template>
                <template v-slot:item.defaultGroup="{ item }">
                    <groups-chip :prop-groups="item.groups" :prop-group="item.defaultGroup"/>
                </template>
            </v-data-table>
        </template>
    </div>
</template>

<script>
    import GroupsChip from "../../../utils/SharedComponents/Groups/GroupsChip";
    import GroupSelector from "../../../utils/SharedComponents/Contacts/GroupSelector";
    import BirthDaySelector from "../../../utils/SharedComponents/Contacts/BirthDaySelector";
    import DateSelector from "../../../utils/SharedComponents/Contacts/DateSelector";
    import {turnDateToTimestamp} from "../../../utils/helpers/dates_time";
    export default {
        components: {GroupsChip, GroupSelector, BirthDaySelector, DateSelector},
        data() {
            return {
                displayTop: false,
                options: {},
                form: {},
                sortBy: ['first_name'],
                sortDesc: false,
                searchText: '',
                selected: [],
                headers: [
                    {
                        text: 'Name',
                        align: 'start',
                        sortable: true,
                        value: 'name',
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
                        text: 'Group',
                        align: 'start',
                        sortable: false,
                        value: 'defaultGroup',
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
            filterByDateOfBirth(selectedDateOfBirth) {
                this.$store.commit("setQueryFilterByBirthday",
                    ['birthday', selectedDateOfBirth]);

                this.loadContacts()
            },
            loadContacts() {
                this.$store.dispatch("loadContacts");
            },
            searchByDateJoined(dates) {
                dates.column = 'dateAdded';
                dates.fromDate = turnDateToTimestamp(dates.fromDate);
                dates.toDate = turnDateToTimestamp(dates.toDate);
                this.$store.commit("setFilterByDate", dates);
                this.loadContacts();
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
