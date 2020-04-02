<template>
  <div class="selector">
    <v-autocomplete
        v-model="selectedGroups"
        @input="searchGroup"
        chips
        clearable
        multiple
        append-icon="mdi-account-group-outline"
        :items="groups"
        item-text="name"
        item-value="name"
        label="Filter By Group(s)"
    />
  </div>
</template>
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
            let existingColumnFilters = this.$store.state.queries.queryFilterByRelationship
                .filterByRelationship;
            existingColumnFilters['filterByGroups'] = ['groups', 'name', groupName];
          await this.$store.commit("setQueryFilterByRelationship", existingColumnFilters);
          await this.$store.commit("saveASelectedGroup", this.groups.find(group=>group.name===(this.selectedGroups[this.selectedGroups.length-1])));
        }
        await this.$store.dispatch(this.action)
          this.$emit("selected")
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
      max-width: 100%;
  }
</style>
