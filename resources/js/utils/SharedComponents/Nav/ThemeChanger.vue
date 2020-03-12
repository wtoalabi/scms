<template>
  <div>
      <v-list-item
          key="theme"
          link
          @click="changeTheme"
      >
          <v-list-item-action >
              <v-icon :color="$vuetify.theme.dark ? 'yellow' : 'black'">mdi-lightbulb-multiple-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
              <v-list-item-title>
                  {{themeText}}
              </v-list-item-title>
          </v-list-item-content>
      </v-list-item>
  </div>
</template>

<script>
  export default {
    data() {
      return {}
    },
    methods: {
        changeTheme(){
            this.$vuetify.theme.dark = !this.$vuetify.theme.dark
        }
    },
    computed: {
        themeText(){
            return this.$vuetify.theme.dark ? "Light Theme" : "Dark Theme"
        }
    }
  }

</script>
