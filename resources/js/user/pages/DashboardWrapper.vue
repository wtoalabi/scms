<template>
    <v-app id="inspire">
        <menu-list/>
        <v-app-bar
            :clipped-left="$vuetify.breakpoint.lgAndUp"
            app
            color="blue darken-3"
            dark
        >
            <v-app-bar-nav-icon @click="setDrawer"/>
            <v-toolbar-title
                style="width:400px; font-weight: 800"
                class="ml-0 pl-4"
            >
                <div @click="goToHome" style="cursor:pointer;">
                    <span class="hidden-sm-and-down">Simple Contacts Management System</span>
                    <span
                        class="hidden-md-and-up subtitle-2">Simple Contacts Management System</span>
                </div>
            </v-toolbar-title>
            <div class="spacer"></div>
            <account-snapshot class="hidden-md-and-down"/>
            <v-spacer/>
            <v-btn icon class="hidden-sm-and-down">
                <v-icon>mdi-bell</v-icon>
            </v-btn>
            <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <v-btn icon @click="logout" v-on="on">
                        <v-icon>mdi-logout</v-icon>
                    </v-btn>
                </template>
                <span>Logout</span>
            </v-tooltip>
        </v-app-bar>
        <v-content>
            <v-container fluid>
                <div v-if="!loading">
                    <v-breadcrumbs v-if="showBreadcrumbs"
                                   :items="breadcrumbsList"
                                   large></v-breadcrumbs>
                </div>
                <router-view class="fill-height"/>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    import MenuList from "./Utils/Nav/MenuList";
    import Requests from "../../utils/form/Requests";
    import AccountSnapshot from "./Utils/AccountSnapshot";

    export default {
        mounted() {
            this.$store.dispatch("loadMetaData")
        },
        components: {MenuList, AccountSnapshot},
        props: {
            source: String,
        },
        data: () => ({
            items: [
                {
                    text: 'Dashboard',
                    disabled: false,
                    href: 'breadcrumbs_dashboard',
                },
                {
                    text: 'Link 1',
                    disabled: false,
                    href: 'breadcrumbs_link_1',
                },
                {
                    text: 'Link 2',
                    disabled: true,
                    href: 'breadcrumbs_link_2',
                },
            ],
        }),
        methods: {
            setDrawer() {
                this.$store.commit("commitMiniDrawer", !this.$store.state.miniDrawer)
            },
            goToHome() {
                if (this.$route.path !== '/') {
                    this.$router.push('/')
                }
            },
            logout(e) {
                this.$store.dispatch('logout', e)
            }
        },
        meta() {
            let title = this.$store.state.title;
            return {
                title: `${title} ${title ? '|' : ''} SCMS`
            }
        },
        computed: {
            loading() {
                return this.$store.state.loading;
            },
            breadcrumbsList() {
                return this.$store.state.breadcrumbs.list
            },
            showBreadcrumbs() {
                let route = this.$route;
                if (route.name === "Overview") {
                    return false;
                } else {
                    return this.$store.state.breadcrumbs.show
                }
            },
        }
    }
</script>
