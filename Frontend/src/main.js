import { createApp } from 'vue'
import './style.css'
import router from './router'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUser, faTrash, faEdit, faLock, faPaperPlane, faKey } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faUser, faTrash, faEdit, faLock, faPaperPlane, faKey)


createApp(App)
    .use(router)
    .component('font-awesome-icon', FontAwesomeIcon)
    .use(bootstrap)
    .mount('#app')
