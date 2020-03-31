<template>
    <v-row justify="center">
        <v-dialog
            v-model="dialog" persistent max-width="800px">
            <v-card>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    label="First Name*"
                                    required
                                    v-model="form.first_name">
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Last Name" hint="Last name"
                                              v-model="form.last_name"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Email" hint="Last name"
                                              v-model="form.email"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6" md="6">
                                <strong>Date Joined</strong>
                                <v-col cols="10">
                                    <v-menu
                                        ref="menu1"
                                        v-model="showDatePicker"
                                        :close-on-content-click="false"
                                        transition="scale-transition"
                                        offset-y
                                        width="290px"
                                        min-width="290px"
                                        append-icon="mdi-account-group-outline"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-text-field
                                                v-model="formattedDate"
                                                label="Date"
                                                persistent-hint
                                                v-on="on"
                                            >
                                            </v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="date" no-title
                                            @input="datePicker">
                                        </v-date-picker>

                                    </v-menu>
                                </v-col>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <strong>Birthday</strong>
                                <v-row>
                                    <v-col>
                                        <v-autocomplete
                                            v-model="form.birthday.day"
                                            :items="days"
                                            label="Day"
                                        ></v-autocomplete>
                                    </v-col>
                                    <v-col>
                                        <v-autocomplete
                                            item-value="id"
                                            item-text="name"
                                            v-model="form.birthday.month"
                                            :items="months"
                                            label="Months"
                                        ></v-autocomplete>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <v-textarea
                                    auto-grow
                                    row-height="6"
                                    label="Address"
                                    hint="Address"
                                    v-model="form.address"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6">
                                <v-autocomplete
                                    outlined
                                    dense
                                    small-chips
                                    v-model="selectedGroups"
                                    @input="selectGroup"
                                    chips
                                    clearable
                                    multiple
                                    append-icon="mdi-account-group-outline"
                                    :items="groups"
                                    item-text="name"
                                    item-value="id"
                                    label="Group(s)"
                                />
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    outlined
                                    dense
                                    autocomplete="contact_form"
                                    type="number"
                                    @change="addPhone"
                                    label="Type and Press Enter to add Phone"
                                    required
                                    v-model="phone">
                                </v-text-field>
                                <div :key="phonesDisplay">
                                    <v-chip
                                        close
                                        @click:close="removePhone(phone)"
                                        :color="phone.default ? 'green' : null"
                                            @click="makePhoneDefault(phone)" class="ma-2"
                                            v-for="phone in form.phones" :key="phone.id">
                                        {{phone.number}}
                                    </v-chip>
                                </div>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6">
                                <!--<v-select
                                    :items="['0-17', '18-29', '30-54', '54+']"
                                    label="Age*"
                                    required
                                ></v-select>-->
                            </v-col>
                            <v-col cols="12" sm="6">
                                <!--<v-autocomplete
                                    :items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                                    label="Interests"
                                    multiple
                                ></v-autocomplete>-->
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="closeForm">Close</v-btn>
                    <v-btn color="primary" @click="save">{{buttonText}}</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    import {days, months, turnMonthIntegerToString} from '../../../../utils/helpers/dates_time';
    import Request from "@/utils/form/StateFulRequest";

    export default {
        mounted() {
            if (_.isNotEmpty(this.contact)) {
                this.formattedDate = this.contact.dateAdded;
                this.form = _.cloneDeep(this.contact);
                if (this.contact.groups.length > 0) {
                    this.selectedGroups = this.contact.groups.map(group => group.id);
                }
            }
        },
        data: () => ({
            date: new Date().toISOString().substr(0, 10),
            dialog: true,
            selectedGroups: [],
            showDatePicker: false,
            days: days,
            formattedDate: "",
            months: months,
            phone: '',
            phonesDisplay:0,
            form: {
                birthday: {
                    day: '',
                    month: ''
                },
            },
        }),
        methods: {
            closeForm() {
                this.dialog = false;
                this.$emit('close')
            },
            async save() {
                this.form['selectedGroups'] = this.selectedGroups;
                this.form['dateAdded'] = ((new Date(this.formattedDate).getTime()) / 1000) + 3600;
                await Request('contact', {
                    data: this.form,
                    mutator: "commitContact",
                    store: this.$store,
                    action: _.isEmpty(this.contact) ? "post" : "patch",
                    onSuccessCallback: () => {
                        this.$emit('close');
                    }
                })
            },
            datePicker(date) {
                let [year, month, day] = date.split('-');
                this.formattedDate = turnMonthIntegerToString(`${day}-${month}-${year}`);
                this.showDatePicker = false;
            },
            selectGroup(e) {
                console.log(e)
            },
            makePhoneDefault(phone) {
                this.form.phones.map((p) => {
                    p.default = p.number === phone.number;
                })
                this.phonesDisplay++;
            },
            addPhone(phone) {
                let newPhone = phone;
                this.phone = '';
                this.form.phones.push({number: newPhone,default:false});
                this.form.phones = _.uniqBy(this.form.phones, 'number');
            },
            removePhone(phone){
                this.form.phones = this.form.phones.filter(p => phone.number !== p.number);
            }
        },
        computed: {
            contact() {
                return this.$store.state.contacts.current
            },
            groups() {
                let groups = _.cloneDeep(this.$store.state.groups.data);
                groups.unshift({id: 0, name: "None"});
                return groups;
            },
            buttonText() {
                return _.isEmpty(this.contact) ? "Save" : "Edit"
            }
        }
    }
</script>
