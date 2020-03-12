import Request from "../../../utils/form/StateFulRequest";
export default {
    async logout(store, e) {
        e.preventDefault();
        await Request('user_logout', {
            action: 'post',
            store,
            onSuccessCallback: () => {
                return location.assign("https://scms.loc/login");
            }
        })
    }
}
