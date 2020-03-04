<template>
  <div>
      <v-navigation-drawer
          v-model="drawer"
          :clipped="$vuetify.breakpoint.lgAndUp"
          app
          width="250"
      >
          <v-list dense>
              <template>
                  <contacts_menu />
                  <theme-changer />
              </template>
          </v-list>
      </v-navigation-drawer>
  </div>
</template>

<script>
    import contacts_menu from './partials/contacts_menu'
    import ThemeChanger from "../../../../utils/SharedComponents/Nav/ThemeChanger";
  export default {
      components:{
          contacts_menu,
          ThemeChanger
      },
    data() {
      return {
          dialog: false,
          drawer: true,

      }
    },
      watch:{
          stateDrawer(){
              this.drawer = this.stateDrawer;
          }
      },
    methods: {

    },
    computed: {
          stateDrawer(){
            return  this.$store.state.drawer
          }
    }
  }

</script>
