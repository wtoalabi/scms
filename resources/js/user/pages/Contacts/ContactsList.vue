<template>
  <div>
      <template>
          <v-data-table
              :headers="headers"
              :items="contacts"
              :items-per-page="5"
              class="elevation-1"
          ></v-data-table>
      </template>
  </div>
</template>

<script>
  export default {
      mounted() {
          this.$store.dispatch("loadContacts");
      },
      data() {
      return {
          headers:[
              {
                  text: 'First Name',
                  align: 'start',
                  sortable: true,
                  value: 'first_name',
              },{
                  text: 'Last Name',
                  align: 'start',
                  sortable: true,
                  value: 'last_name',
              },{
                  text: 'Email',
                  align: 'start',
                  sortable: true,
                  value: 'email',
              },{
                  text: 'Birth Date',
                  align: 'start',
                  sortable: true,
                  value: 'birthday',
              },{
                  text: 'Date Added',
                  align: 'start',
                  sortable: true,
                  value: 'dateAdded',
              },
          ]
      }
    },
    methods: {},
    computed: {
          contacts(){
              return this.$store.state.contacts.data

          }
    }
  }

</script>
