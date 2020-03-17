<template>
    <div>
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <span v-for="group in groups" v-on="on">
                <v-chip @click="goToGroup(group)" :color="getColorGroup(group)" small class="ma-2">
                {{group.name}}
                </v-chip>
        </span>
            </template>
            <span>{{formattedGroupNames}}</span>
        </v-tooltip>
    </div>
</template>

<script>
    import {getRandomInt} from "../../helpers/integers";
    import {flattenedSentenceFromArray} from "../../helpers/strings";

    export default {
        props: ['propGroups', 'max'],
        mounted() {
            this.allGroups = _.cloneDeep(this.propGroups);
            this.groups = this.propGroups.splice(0, this.max)
        },
        data() {
            return {
                groups: [],
                allGroups: [],
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
            goToGroup(group){
                console.log(group);
            }

        },
        computed: {
            colorGroups() {
                return this.$store.state.groups.colors.colorGroups;
            },
            formattedGroupNames() {
                return flattenedSentenceFromArray(this.allGroups, 'name');
            }
        }
    }

</script>
