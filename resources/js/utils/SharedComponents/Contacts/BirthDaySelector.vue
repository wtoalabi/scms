<template>
  <div class="ma-3 ml-5">
    <v-row>
        <v-select
            @input="filterDayOfBirth"
            clearable
            style="max-width: 30%"
            class="ma-2"
            :items="days"
            label="Filter by Day of Birth"
            placeholder="Select Days"
        ></v-select>
        <v-select
            clearable
            @input="filterMonthOfBirth"
            style="max-width: 30%"
            class="ma-2"
            :items="months"
            item-text="name"
            item-value="id"
            label="Filter by Month of Birth"
            placeholder="Select Months"
        ></v-select>
    </v-row>
  </div>
</template>

<script>
    import {days,months} from '../../helpers/dates_time'
  export default {
    data() {
      return {
          days:days,
          months: months,
          selectedMonth: null,
          selectedDay:null
      }
    },
    methods: {
        filterDayOfBirth(day){
            this.selectedDay = day;
            this.sendEvent();
        },
        filterMonthOfBirth(month){
            this.selectedMonth = month
            this.sendEvent();
        },
        sendEvent(){
            this.$emit("filterByDateOfBirth", {
                day: this.selectedDay,
                month: this.selectedMonth,
            })
        }
    },
    computed: {}
  }

</script>
