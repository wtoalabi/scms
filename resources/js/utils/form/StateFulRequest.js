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
    let page = store.state.queries.pagination.queryPagination.page ?? 1;
    await axios[action](`${url}?page=${page}`, data).then(response => {
        if (mutator) {
            store.commit(mutator, response.data.response);
        }
        store.commit("stopLoading")
        onSuccessCallback();
    }).catch(errorData => {
        errors.record(errorData.response.data.errors);
        onErrorCallback()
        return store.commit("stopLoading", errors.errors)
    })
}
