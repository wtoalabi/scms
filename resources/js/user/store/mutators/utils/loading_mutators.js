export default {
    commitMiniDrawer(state,payload){
        state.miniDrawer = payload
    },
    setTitle({title}, payload){
        title = payload;
        document.title = `${title} - User Account | SCMS`
    },
    startLoading(state,_){
        state.loading = true;
    },
    stopLoading(state,_){
        state.loading = false;
    },
    commitMetaData(state,payload){
        state.groups.data = payload.groups
    }
}
