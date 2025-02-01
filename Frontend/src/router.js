import DefaultLayout from "./components/DefaultLayout.vue";
import Home from "./pages/Home.vue";
import Library from "./pages/Library.vue";
import {createRouter, createWebHistory,} from 'vue-router';

const routes = [{
    path:'/',
    component: DefaultLayout,
    children:[
        {path:'/', name:'Home', component:Home},
        {path:'/library', name:'Library', component:Library},
    ]
},
{
    path: "/:pathMatch(.*)*",
    redirect: '/',
}
];

const router= createRouter({
    history:createWebHistory(),
    routes
});

export default router;