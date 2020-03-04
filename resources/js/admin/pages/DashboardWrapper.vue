<template>
    <v-app id="inspire">
        <menu-list />
        <v-app-bar
            :clipped-left="$vuetify.breakpoint.lgAndUp"
            app
            color="teal darken-1"
            dark
        >
            <v-app-bar-nav-icon @click="setDrawer" />
            <v-toolbar-title
                style="width:400px"
                class="ml-0 pl-4"
            >
                <span class="">SCMS - Admin</span>
            </v-toolbar-title>
            <v-text-field
                flat
                solo-inverted
                hide-details
                prepend-inner-icon="mdi-magnify"
                label="Search"
                class="hidden-sm-and-down"
            />
            <v-spacer />
            <v-btn icon class="">
                <v-icon>mdi-apps</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon>mdi-bell</v-icon>
            </v-btn>
        </v-app-bar>
        <v-content>
            <v-container fluid>
                <router-view class="fill-height"/>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    import MenuList from "./Utils/Nav/MenuList";
    export default {
        components:{MenuList},
        props: {
            source: String,
        },
        data: () => ({

        }),
        methods:{
            setDrawer(){
                this.$store.commit("commitDrawer", !this.$store.state.drawer)
            }
        },
        meta () {
            let title = this.$store.state.title;
            return {
                title:  `${title} ${title ? '|' : ''} SCMS`
            }
        },
        computed:{
            drawer(){

            }
        }
    }
</script>
