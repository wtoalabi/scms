import {getRandomInt} from "../../../utils/helpers/integers";

export default {
    saveASelectedGroup(state, payload){
        state.groups.selectedGroup = payload
    },
    colorGroups(state, group) {
        let colors = state.groups.colors.colors
        state.groups.colors.colorGroups.push({
            'groupID': group.id,
            'color': randomColor(),
        });

        function randomColor() {
            return colors.splice(
                getRandomInt(colors.length), 1)[0] || '#000'
        }
    },
}
