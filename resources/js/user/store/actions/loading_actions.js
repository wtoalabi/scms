import Request from "../../../utils/form/StateFulRequest";

export default {
    async loadMetaData(store) {
        await Request(`${_globals.baseUrl()}/loadMetaData`, {
            mutator: 'commitMetaData',
            store,

        })
    }
}
