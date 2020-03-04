<template>
    <div class="searchBox">
        <q-space/>
    <q-input rounded standout bg-color="grey-12" dense debounce="1000" color="primary" @input="search" :label="placeholder" v-model="searchText">
        <template v-slot:append>
            <q-icon class="clear" name="clear" v-if="searchText" @click="clearSearch"/>
            <q-icon name="search" v-else/>
        </template>
    </q-input>
    </div>
</template>

<script>
  export default {
    props:['propPlaceholder'],
    data() {
      return {
        searchText:''
      }
    },
    methods: {
      search(){
        this.$emit("search", this.searchText)
      },
      clearSearch(){
        this.searchText = '';
        this.$emit("search", this.searchText)
      }
    },
    computed: {
      placeholder(){
        return this.propPlaceholder || "Search"
      }
    }
  }

</script>
<style>
    .searchBox{

    }
    .clear{
        cursor: pointer;
    }
    .relative-position.row.no-wrap.q-anchor--skip > input{
        color: black;
    }
</style>
