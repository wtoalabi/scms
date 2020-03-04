export default {
    commitDrawer(state,payload){
        state.drawer = payload
    },
    setTitle({title}, payload){
        title = payload;
        document.title = `${title} - User Account | SCMS`
    }
}
