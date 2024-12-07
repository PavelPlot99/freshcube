require('./bootstrap');
window.Vue = require('vue');
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import router from './routes/router';
import Navbar from './components/Navbar.vue';

window.Swal = Swal;

const app = new Vue({
    el: '#app',
    router,
    components: {
        Navbar,
    },
});
