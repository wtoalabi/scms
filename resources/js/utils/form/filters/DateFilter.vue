<template>
    <div class="q-pl-xs" style="max-width: 300px">
        {{title}}
        <q-input filled v-model="dateAndTime">
            <template v-slot:prepend>
                <q-icon name="event" class="cursor-pointer">
                    <q-popup-proxy transition-show="scale" transition-hide="scale" ref="qDateProxy">
                        <q-date v-model="dateAndTime" mask="YYYY-MM-DD HH:mm" @input="changeDate"/>
                    </q-popup-proxy>
                </q-icon>
            </template>

            <template v-slot:append>
                <q-icon name="access_time" class="cursor-pointer">
                    <q-popup-proxy transition-show="scale" transition-hide="scale" ref="qTimeProxy">
                        <q-time v-model="dateAndTime" mask="YYYY-MM-DD HH:mm"
                                @input="changeTime"/>
                    </q-popup-proxy>
                </q-icon>
            </template>
        </q-input>
    </div>
</template>

<script>
  import Requests from "../Requests";

  export default {
    props: ['title', 'fromDate', 'toDate','filterAction'],
    mixins: [Requests],
    mounted() {
      let date = 0;
      if(this.fromDate){
        date = this.minusOneDay
      }else{
        date = this.getTodaysDate(Date.now());
      }
      let time = this.getCurrentTime();
      this.dateAndTime = this.compileFullDate(date, time);
    },
    data() {
      return {
        date: '2019-01-01',
        time: '12:00',
        dateAndTime: '2019-01-01 12:00'
      }
    },
    methods: {
      changeDate(value) {
        let date = value.split(" ")[0];
        this.dateAndTime =  this.compileFullDate(date, this.time);
        this.fromDate ? this.setFromDate() : this.setToDate();
        return this.$refs.qDateProxy.hide();
      },
      changeTime(value) {
        let time = value.split(" ")[1];
        this.dateAndTime =  this.compileFullDate(this.date, time);
        this.fromDate ? this.setFromDate() : this.setToDate();
        return this.$refs.qTimeProxy.hide();
      },
      setFromDate() {
        if (this.fromDate) {
          this.$store.commit("setFilterByDate", {"fromDate":this.dateAndTime});
        }
        if(this.$store.state.queries.dateFilters.filterByDate.toDate){
          this.mergeAndDispatchAction();
        }
      },
      setToDate() {
        if (this.toDate) {
          this.$store.commit("setFilterByDate", {"toDate":this.dateAndTime});
          if(_.isUndefined(this.$store.state.queries.dateFilters.filterByDate.fromDate)){
            this.commitDefaultFromDate();
          }
            this.mergeAndDispatchAction()
        }
      },
      mergeAndDispatchAction(){
        this.form = this.$store.state.mergeAllQueries({});
        //this.$store.dispatch(this.filterAction, data);
        this.$emit("loading", true)
        //console.log(this.form)
        this.makeRequest("activities",{
          action: "post",
          showResponseMessage: false,
          mutator:"commitActivities",
          store: this.$store,
          onSuccessCallback: ()=>{
            this.$emit("loading", false)
          }
        });
      },
      getTodaysDate(from) {
        let date = new Date(from);
        let month = date.getMonth() + 1;
        let day = date.getDate();
        return `${date.getFullYear()}-${month < 10 ?"0" + month: month}-${day < 10 ? "0" + day : day}`
      },
      commitDefaultFromDate(){
        this.$store.commit("setFilterByDate", {"fromDate": this.compileFullDate(this.minusOneDay, "00:00")});
      },
      getCurrentTime() {
        return `${new Date().getHours() < 10 ? "0"+ new Date().getHours() : new Date().getHours()}:${new Date().getMinutes()
        < 10 ? "0" + new Date().getMinutes() : new Date().getMinutes()}`
      },
      compileFullDate(date, time) {
        this.date = date;
        this.time = time;
        return `${date} ${time}`;
      }
    },
    computed:{
      minusOneDay(){
        return this.getTodaysDate(Date.now()-86400000);
      },
    }
  }
</script>
