
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('excel', require('./components/Excel.vue'));

const model = new Vue({
    el: '#excelUploadVueApp',
    data: {
        error: null,
        loading: false
    }
});

$('#fileupload').fileupload({
    dataType: 'json',
    url: window.compareUploadUrl,
    type: 'POST',
    done: function(e, data) {
        if (data.result.error) {
            model.error = true;
            return true;
        }
        if (data.result) {
        	
        	// reload page 

        }
    },
    start: function(e) {
        model.loading = true;
        model.error = null;
    },
    stop: function(e) {
        model.loading = false;
    },
    error: function(e) {
        alert('На сервере произошла ошибка. Попробуйте повторить запрос позже.');
    }
});