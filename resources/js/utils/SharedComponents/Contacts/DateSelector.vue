<template>
    <v-row class="row">
        <v-col cols="12" sm="6" md="6">
            <v-menu
                ref="fromMenu"
                v-model="fromMenu"
                :close-on-content-click="false"
                :return-value.sync="fromDate"
                transition="scale-transition"
                offset-y
                min-width="290px"
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        v-model="fromDateFormated"
                        :label="fromLabel"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-on="on"
                    />
                </template>
                <v-date-picker
                    v-model="fromDate"
                    :max="maxFromDate"
                    no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="cancel('fromMenu')">Cancel</v-btn>
                    <v-btn text color="primary" @click="search('from')">Filter</v-btn>
                </v-date-picker>
            </v-menu>
        </v-col>
        <v-col cols="12" sm="6" md="6">
            <v-menu
                ref="toMenu"
                v-model="toMenu"
                :close-on-content-click="false"
                :return-value.sync="toDate"
                transition="scale-transition"
                offset-y
                min-width="290px"
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        v-model="toDateFormated"
                        :label="toLabel"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-on="on"
                    />
                </template>
                <v-date-picker
                    v-model="toDate"
                    no-title
                    scrollable
                    :min="minToDate"
                    :max="maxToDate">
                    <v-spacer />
                    <v-btn text color="primary" @click="cancel('toMenu')">Cancel</v-btn>
                    <v-btn text color="primary" @click="search">Filter</v-btn>
                </v-date-picker>
            </v-menu>
        </v-col>
    </v-row>
</template>

<script>
    import {turnMonthIntegerToString} from "../../helpers/dates_time";

    export default {
        mounted() {
            this.fromDate = this.maxFromDate
            this.fromDateFormated = turnMonthIntegerToString(this.fromDate);
            this.toDateFormated = turnMonthIntegerToString(this.toDate);
        },
        props:{
            fromLabel:{
                default: "Filter From:"
            },
            toLabel:{
                default: "To:"
            }
        },
        data: () => ({
            fromDateFormated:"",
            toDateFormated:"",
            fromDate: " ",
            toDate:new Date().toISOString().substr(0, 10),
            toMenu: false,
            modal: false,
            fromMenu: false,
            maxFromDate:new Date().toISOString().substr(0, 10),
            minToDate:"",
            maxToDate:""
        }),
        methods:{
            search(type){
                this.fromDateFormated = turnMonthIntegerToString(this.fromDate);
                this.toDateFormated = turnMonthIntegerToString(this.toDate);
                this.setMinMax();
                if(type === "from"){
                    this.$refs.fromMenu.save(this.fromDate)
                }else{
                    this.$refs.toMenu.save(this.toDate)
                }
                this.$emit("filter", {
                    fromDate: this.fromDate,
                    toDate: this.toDate,
                })
            },
            setMinMax(){
                this.maxFromDate = this.toDate.toString();
                this.minToDate = this.fromDate.toString();
            },
            cancel(type){
                if(type === 'fromMenu'){
                    this.fromMenu = false;
                    this.fromDate = "";
                    this.$refs.fromMenu.save(this.fromDate)
                }else{
                    this.toMenu = false;
                    this.toDate = "";
                    this.$refs.toMenu.save(this.toDate)
                }
                this.search();
            }
        }
    }
</script>
<style lang="scss" scoped>
    .row{
        justify-content: space-between;
    }
</style>
