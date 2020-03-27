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
    //showInnerLoading ? store.commit("startLoading") : null;
    if (action !== 'get') {
        let extraData = store.state.mergeAllQueries();
        data = {...extraData, ...data}
    }
    let page = store.state.queries.pagination.queryPagination.page;
    let urlSuffix = page > 1 ? `?page=${page}` : ''

    await axios[action](`${url}${urlSuffix}`, data).then(response => {
        let data =  response.data.response
        if (mutator) {
            store.commit(mutator, data);
        }
       //showInnerLoading ? store.commit("stopLoading") : null;
        console.log(response)
        onSuccessCallback(data);
    }).catch(errorData => {
        if (errorData.response && errorData.response.status === 419) {
            location.assign(`${location.origin}/login`);
        }
        errors.record(errorData.response.data.errors);
        onErrorCallback();
        return store.commit("stopLoading", errors.errors)
    })
}
