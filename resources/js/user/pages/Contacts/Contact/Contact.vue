<template>
  <div>
      <template>
          <v-card class="mx-auto" outlined raised>
              hello
          </v-card>
      </template>
  </div>
</template>

<script>
  export default {
      mounted() {

          let route = this.$route;
          let tab = route.query.tab;
          let id = route.params.id;
          this.$store.dispatch(this.action, id);
          this.form['contact_id'] = id;
          /*if(_.isEmpty(this.$store.state.currentPMetas)){
              this.getProductMetas();
          }*/
          if (tab) {
              this.tab = tab;
          } else {
              this.tab = "details"
          }
      },
      data() {
      return {
          tab:'',
          form: {},
          action: 'getContact',
      }
    },
    methods: {

    },
    computed: {
          contact(){
              return this.$store.state.contacts.current
          }
    }
  }

</script>
