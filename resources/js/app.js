require('./bootstrap');

window.Vue = require('vue').default;

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import App from './components/Painel.vue';

const app = new Vue({
    el: '#app'
    , components: {
        App
    }
    , render: h => h(App)
});
