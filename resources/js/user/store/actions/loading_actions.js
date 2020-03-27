import Request from "../../../utils/form/StateFulRequest";

export default {
    async loadMetaData(store) {
        await Request(`loadMetaData`, {
            mutator: 'commitMetaData',
            store,

        })
    }
}
