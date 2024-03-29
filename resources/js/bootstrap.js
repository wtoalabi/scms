import lodash from './utils/lodash';
window._ = lodash;
import globals from '../js/utils/GlobalStates'
window._globals = globals;
require("./utils/Filters/GlobalFilters");
Vue.config.productionTip = false;
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
