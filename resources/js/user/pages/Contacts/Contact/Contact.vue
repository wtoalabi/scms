<template>
    <div>
        <loader v-if="loading"/>
        <template v-else>
            <v-card class="mx-auto" outlined raised>
                hello
            </v-card>
        </template>
    </div>
</template>

<script>
    import loader from '@/utils/loader'
    export default {
        components:{loader},
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
                tab: '',
                form: {},
                action: 'getContact',
            }
        },
        methods: {},
        computed: {
            contact() {
                return this.$store.state.contacts.current
            },
            loading() {
                return this.$store.state.loading;
            },
        }
    }

</script>
