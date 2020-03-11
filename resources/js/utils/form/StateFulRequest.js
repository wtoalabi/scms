import Errors from "./Errors";

let errors = new Errors;
export default async function Request(url, {
    data = {},
    action = "get",
    stopLoadingBar = false,
    showResponseMessage = true,
    showInnerLoading = false,
    onSuccessCallback = () => {
    },
    onErrorCallback = () => {
    },
    mutator = null,
    store = null,
    load = true,
} = {}) {
    store.commit("startLoading");
    if (action !== 'get') {
        let extraData = store.state.mergeAllQueries();
        data = {...extraData, ...data}
    }
    await axios[action](url, data).then(response => {
        store.commit(mutator, response.data.response);
        store.commit("stopLoading")
    }).catch(errorData => {
        errors.record(errorData.response.data.errors);
        return store.commit("stopLoading", errors.errors)
    })
}
