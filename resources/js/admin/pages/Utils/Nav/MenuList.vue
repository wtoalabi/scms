<template>
  <div>
      <v-navigation-drawer
          v-model="drawer"
          :clipped="$vuetify.breakpoint.lgAndUp"
          app
          width="250"
          :mini-variant.sync="miniDrawer"
      >
          <v-list dense>
              <template>
                  <admin_menu_accounts_management />
                  <admin_menu_money_management />
                  <admin_menu_settings />
                  <theme-changer />
              </template>
          </v-list>
      </v-navigation-drawer>
  </div>
</template>

<script>
    import admin_menu_settings from "./partials/admin_menu_settings";
    import admin_menu_accounts_management from "./partials/admin_menu_accounts_management";
    import admin_menu_money_management from "./partials/admin_menu_money_management";
    import ThemeChanger from "../../../../utils/SharedComponents/Nav/ThemeChanger";
  export default {
      components:{
          admin_menu_settings,
          admin_menu_accounts_management,
          admin_menu_money_management,
          ThemeChanger
      },
    data() {
      return {
          dialog: false,
          drawer: true,

      }
    },
    methods: {

    },
    computed: {
          miniDrawer: {
            set: function () {

            },
              get: function () {
                  return this.$store.state.miniDrawer
              }
          }
    }
  }

</script>
