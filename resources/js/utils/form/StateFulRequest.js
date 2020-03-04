import Errors from "./Errors";
let errors = new Errors;
export default async function Request(
    {url, store, mutator, action = "get", requestData=null}
    ) {
    store.commit("startStatefulLoading");
    await axios[action](url,requestData).then(response=>{
        store.commit(mutator, response.data);
        setTimeout(()=>{
            store.commit("requestIsSuccessful");
            return store.commit("stopLoading");
        },1000)
    }).catch(errorData=>{
        errors.record(errorData.response.data.errors);
        return store.commit("stopStatefulLoading", errors.errors)
    })
}
