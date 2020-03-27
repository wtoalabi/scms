import Errors from './Errors';
import ErrorMessages from './errorMessages';
import {scrollToTop} from "../helpers/document";

export default {
    mounted() {
        this.newForm = _.cloneDeep(this.form)
    },
    data() {
        return {
            mainData: [],
            newForm: {},
            form: {},
            errors: new Errors,
        }
    },
    methods: {
        makeRequest(url, {
            data = this.form,
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
            showInnerLoading ? this.startInnerLoading(): void
            this.startLoading(stopLoadingBar, load);
            return axios[action](url, data).then(response => {
                if(showInnerLoading){
                    this.stopInnerLoading();
                }
                this.handleSuccess(response.data['message'], showResponseMessage);
                this.mainData = response.data;
                if (mutator && store) {
                    store.commit(mutator, this.mainData);
                }
                return onSuccessCallback();
            }).catch((error) => {
                if(showInnerLoading){
                    this.stopInnerLoading();
                }
                return this.handleError(error, onErrorCallback, showResponseMessage);
            })
        },

        handleSuccess(response, showResponseMessage) {
            this.clearForm();
            this.errors.clearAll();
            if (showResponseMessage) {
                scrollToTop();
                this.showMessage({response: response})
            }
        },

        handleError(error, onErrorCallback, showResponseMessage) {
            onErrorCallback();
            let status = this.getStatusCode(error)
            if (status === 401 || showResponseMessage) {
                scrollToTop();
                let message = error.response.data['message'];
                let response = message.length < 1 ? "Error has occurred!" : message;
                this.showMessage({
                    response: response,
                    color: 'negative',
                    icon: 'thumb_down'
                });
                if (typeof error.response.data.errors === 'object') {
                    this.errors.record(error.response.data.errors)
                }
            }
        },

        showMessage({response = "Success!", color = 'primary', icon = "thumb_up"} = {}) {

        },
        startLoading(stopLoadingBar = false, load) {
            if (stopLoadingBar) {}
        },
        append(form) {
            this.form = new FormData();
            for (let key in form) {
                this.form.append(key, form[key])
            }
        },
        clearForm() {
            this.form = _.cloneDeep(this.newForm);
            if (typeof this.clear === "function") {
                this.clear();
            }
        },
        getStatusCode(error) {
            console.dir(error)
            return error.response.status
        },
        startInnerLoading() {},
        stopInnerLoading() {}

    },
    computed: {
        loading(){
            return this.$store.state.loading;
        },
    },
}
