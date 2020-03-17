<template>
  <div class="selector">
    <v-select
        v-model="selectedGroup"
        @input="searchGroup"
        append-icon="mdi-account-group-outline"
        :items="groups"
        item-text="name"
        item-value="name"
        label="Pick A Group"
    />
  </div>
</template>

<script>

  export default {
    mounted() {
      if(this.incomingGroup){
        this.selectedGroup = this.incomingGroup;
        this.searchGroup(this.selectedGroup);
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
        selectedGroup: null,
      }
    },
    methods: {
      async searchGroup(groupName) {
        if (groupName === 0) {
          await this.$store.commit("resetQueryState", groupName);
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
    width: 100%;
  }
</style>
