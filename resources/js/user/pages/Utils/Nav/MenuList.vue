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
                  <dashboard_menu />
                  <contacts_menu />
                  <groups_menu />
                  <emails_menu />
                  <sms_menu />
                  <settings_menu />
                  <theme-changer />
              </template>
          </v-list>
      </v-navigation-drawer>
  </div>
</template>

<script>
    import contacts_menu from './partials/contacts_menu'
    import groups_menu from './partials/groups_menu'
    import emails_menu from './partials/emails_menu'
    import sms_menu from './partials/sms_menu'
    import settings_menu from './partials/settings_menu'
    import dashboard_menu from './partials/dashboard_menu'
    import ThemeChanger from "../../../../utils/SharedComponents/Nav/ThemeChanger";
  export default {
      components:{
          dashboard_menu,
          contacts_menu,
          groups_menu,
          emails_menu,
          sms_menu,
          settings_menu,
          ThemeChanger
      },
    data() {
      return {
          dialog: false,
          drawer: true,
      }
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
