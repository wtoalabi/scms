<template>
    <div>
        <template>
            <v-card>
                <v-card-title>
                    Contacts List
                    <v-spacer></v-spacer>
                    <v-text-field
                        @click:clear="clearQueries"
                        @input="search"
                        v-model="searchText"
                        :append-icon="searchText ? '': 'mdi-magnify'"
                        label="Search fullname, email or phone number"
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
                                        <group-selector @selected="reloadGroupChips" :incomingGroup="0" action="loadContacts"/>
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
                @toggle-select-all="selectAll"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc" :search="searchText"
                v-model="selectedContacts"
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
                @input="select"
            >
                <template v-slot:top>
                    <contact-list-top-buttons :selected-contacts="selectedContacts" :all-is-selected="allSelected" :display-top="displayTop"/>
                </template>
                <template v-slot:item.birthday="{ item }">
                    <p>{{item.birthday | birthdayString}}</p>
                </template>
                <template v-slot:item.name="{ item }">
                    <router-link class="link" style="text-decoration: none"
                                 :to="`/contacts/${item.id}?tab=profile`" exact>
                        {{item.name}}
                    </router-link>
                </template>
                <template v-slot:item.email="{ item }">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                            <p v-on="on">{{item.email | shorten(30)}}</p>
                        </template>
                        <span>{{item.email}}</span>
                    </v-tooltip>
                </template>
                <template v-slot:item.defaultGroup="{ item }">
                    <groups-chip :key="groupChipsReloadCount" :prop-groups="item.groups" :prop-group="item.defaultGroup"/>
                </template>
                <template v-slot:item.defaultPhone="{ item }">
                    <v-chip small class="ma-2" v-if="item.defaultPhone">
                        {{item.defaultPhone.number}}
                    </v-chip>
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
    import ContactListTopButtons from "./partials/ContactListTopButtons";

    export default {
        components: {ContactListTopButtons, GroupsChip, GroupSelector, BirthDaySelector, DateSelector},
        data() {
            return {
                allSelected: false,
                options: {},
                form: {},
                sortBy: ['first_name'],
                sortDesc: false,
                searchText: '',
                selectedContacts: [],
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
                        align: 'center',
                        sortable: true,
                        value: 'birthday',
                    }, {
                        text: 'Group',
                        align: 'center',
                        sortable: false,
                        value: 'defaultGroup',
                    }, {
                        text: 'Phone Number',
                        align: 'center',
                        sortable: false,
                        value: 'defaultPhone',
                    }, {
                        text: 'Date Added',
                        align: 'start',
                        sortable: true,
                        value: 'dateAdded',
                    },
                ],
                groupChipsReloadCount:0
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
            select(items){
                console.log(items,"SELECT");
                this.selectedContacts = items;
                this.allSelected = this.allSelected && _.isNotEmpty(this.selectedContacts);
                this.allSelected = items.length === this.itemsPerPage;
            },
            search(searchText) {
                _.debounce(async () => {
                    this.$store.commit("setQuerySearchArray", {'searchMultipleColumns': [['first_name', 'last_name', 'email'], searchText]});
                    this.loadContacts();
                })
            },
            reloadGroupChips(){
                this.groupChipsReloadCount++;
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
            },
            clearQueries() {
                this.$store.commit("resetSearchQueries");
            },
            selectAll(selected){
                this.allSelected = selected.value;
            }
        },
        computed: {
            contacts() {
                return this.$store.state.contacts.list
            },
            loading() {
                return this.$store.state.loading;
            },
            rowsNumber() {
                return this.$store.state.contacts.rowsNumber
            },
            itemsPerPage(){
                return this.$store.state.queries.pagination.queryPagination.itemsPerPage;
            },
            displayTop(){
                return _.isNotEmpty(this.selectedContacts);
            }
        }
    }

</script>
