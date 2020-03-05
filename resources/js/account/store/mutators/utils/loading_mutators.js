export default {
    commitMiniDrawer(state,payload){
        state.miniDrawer = payload
    },
    setTitle({title}, payload){
        title = payload;
        document.title = `${title} - User Account | SCMS`
    }
}
