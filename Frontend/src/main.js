import { createApp } from 'vue'
import './style.css'
import router from './router'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUser, faTrash, faEdit, faLock, faPaperPlane, faKey } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {createPinia} from 'pinia' 

library.add(faUser, faTrash, faEdit, faLock, faPaperPlane, faKey)
const pinia = createPinia()

createApp(App)
    .use(router)
    .use(pinia)
    .component('font-awesome-icon', FontAwesomeIcon)
    .use(bootstrap)
    .mount('#app')
