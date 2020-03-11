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
    await axios[action](url,data).then(response=>{
        store.commit(mutator, response.data.response);
        setTimeout(()=>{
            //store.commit("requestIsSuccessful");
            return store.commit("stopLoading");
        },1000)
    }).catch(errorData=>{
        errors.record(errorData.response.data.errors);
        return store.commit("stopLoading", errors.errors)
    })
}
