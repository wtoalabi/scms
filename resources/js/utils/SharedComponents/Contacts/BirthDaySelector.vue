<template>
  <div>
    <v-row style="justify-content: space-evenly">
        <v-select
            filled
            class="ml-2"
            @input="filterDayOfBirth"
            clearable
            style="max-width: 50%"
            :items="days"
            label="Filter by Day of Birth"
        ></v-select>
        <v-select
            filled
            clearable
            class="ml-2"
            @input="filterMonthOfBirth"
            style="max-width: 50%"
            :items="months"
            item-text="name"
            item-value="id"
            label="Filter by Month of Birth"
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
          selectedMonth:null,
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
