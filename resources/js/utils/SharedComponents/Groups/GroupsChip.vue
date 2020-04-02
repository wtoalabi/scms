<template>
    <div>
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-chip v-on="on" @click="goToGroup(group)" :color="getColorGroup(group)" small
                        class="ma-2">
                    {{group.name}}
                </v-chip>
            </template>
            <span>{{formattedGroupNames}}</span>
        </v-tooltip>
    </div>
</template>

<script>
    import {getRandomInt} from "../../helpers/integers";
    import {flattenedSentenceFromArray} from "../../helpers/strings";

    export default {
        props: ['propGroup','propGroups'],
        mounted() {
            this.group = _.isNotEmpty(this.searchedGroup) ? this.searchedGroup : this.propGroup;
            this.groups = this.propGroups;
        },
        data() {
            return {
                group: {},
                groups: []
            }
        },
        methods: {
            getColorGroup(group) {
                let colorGroup = this.colorGroups.find(colorGroup => colorGroup.groupID === group.id);
                if (!colorGroup) {
                    this.$store.commit('colorGroups', group)
                }
                return colorGroup ? colorGroup.color : 'grey'
            },
            goToGroup(group) {
                console.log(group);
            }

        },
        computed: {
            colorGroups() {
                return this.$store.state.groups.colors.colorGroups;
            },
            formattedGroupNames() {
                return flattenedSentenceFromArray(this.groups, 'name');
            },
            searchedGroup(){
                return this.$store.state.groups.selectedGroup
            }
        }
    }

</script>
