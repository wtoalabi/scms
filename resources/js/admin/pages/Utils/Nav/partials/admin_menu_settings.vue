<template>
  <div>
      <v-list-group
          key="settings"
          v-model="settings.model"
          :prepend-icon="settings.model ? 'mdi-chevron-up':'mdi-chevron-down'"
          append-icon=""
      >
          <template v-slot:activator >
              <v-list-item-content>
                  <v-list-item-title>
                      <p class="menu-group-title">Settings</p>
                  </v-list-item-title>
              </v-list-item-content>
          </template>
          <v-list-item
              key="sms-api"
              link
          >
              <v-list-item-action >
                  <v-icon>mdi-api</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                  <v-list-item-title>
                      SMS API
                  </v-list-item-title>
              </v-list-item-content>
          </v-list-item>
          <v-list-item
              key="email-api"
              link
          >
              <v-list-item-action >
                  <v-icon>mdi-email-sync</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                  <v-list-item-title>
                      Email API
                  </v-list-item-title>
              </v-list-item-content>
          </v-list-item>
      </v-list-group>
  </div>
</template>

<script>
  export default {
    data() {
      return {
          settings: {
              model: false
          }
      }
    },
    methods: {},
    computed: {}
  }

</script>
