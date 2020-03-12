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
              </template>
          </v-list>
          <template v-slot:append>
              <v-divider></v-divider>
              <theme-changer />
              <v-list-item
                  key="logout"
                  link
                  @click="logout"
              >
                  <v-list-item-action >
                      <v-icon>mdi-logout</v-icon>
                  </v-list-item-action>
                  <v-list-item-content>
                      <v-list-item-title>
                          Logout
                      </v-list-item-title>
                  </v-list-item-content>
              </v-list-item>
          </template>
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
      methods:{
        logout(e){
            this.$store.dispatch('logout',e)
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
