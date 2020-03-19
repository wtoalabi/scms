<template>
  <div class="selector">
      <!--<v-select
        v-model="selectedGroup"
        @input="searchGroup"
        append-icon="mdi-account-group-outline"
        :items="groups"
        item-text="name"
        item-value="name"
        label="Pick A Group"
    />-->
    <v-autocomplete
        v-model="selectedGroups"
        @input="searchGroup"
        chips
        multiple
        solo
        append-icon="mdi-account-group-outline"
        :items="groups"
        item-text="name"
        item-value="name"
        label="Filter By Group(s)"
    />
  </div>
</template>
<!--<v-autocomplete
            v-model="values"
            :items="items"
            dense
            chips
            small-chips
            label="Solo"
            multiple
            solo
          ></v-autocomplete>-->
<script>

  export default {
    mounted() {
      if(this.incomingGroup){
        this.selectedGroups.push(this.incomingGroup);
        this.searchGroup(this.selectedGroups);
      }

    },
    props: {
      action: {
        type: String,
        required: false
      },
      incomingGroup: {
        required: false,
        type: Number
      }
    },
    data() {
      return {
        selectedGroups: [],
      }
    },
    methods: {
      async searchGroup(groupName) {
        if (groupName.includes("None")) {
          await this.$store.commit("resetQueryState", groupName);
          this.selectedGroups = []
        } else {
         /// await this.$store.commit("setContactGroupSearch", groupID);
            let existingColumnFilters = this.$store.state.queries.queryFilterByRelationship
                .filterByRelationship;
            existingColumnFilters['filterByGroups'] = ['groups', 'name', groupName];
          await this.$store.commit("setQueryFilterByRelationship", existingColumnFilters);
        }
        /*await this.$store.commit("resetPagination");*/
        await this.$store.dispatch(this.action)
      }
    },
    computed: {
      groups() {
        let groups = _.cloneDeep(this.$store.state.groups.data);
        groups.unshift({id: 0, name: "None"});
        return groups;
      }
    }
  }

</script>
<style scoped>
  .selector {
      margin: 1rem;
      max-width: 25%;
  }
</style>
