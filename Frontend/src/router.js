import DefaultLayout from "./components/DefaultLayout.vue";
import Home from "./pages/Home.vue";
import Library from "./pages/Library.vue";
import {createRouter, createWebHistory,} from 'vue-router';
import Reviews from "./pages/Reviews.vue";
import SignUp from "./pages/SignUp.vue";
import Login from "./pages/Login.vue";

const routes = [{
    path:'/',
    component: DefaultLayout,
    children:[
        {path:'/', name:'Home', component:Home},
        {path:'/library', name:'Library', component:Library},
        {path:'/reviews', name:'Reviews', component:Reviews},
    ]
},
{
    path:'/login',
    name:'Login',
    component: Login,
},
{
    path: '/signup',
    name:"SignUp",
    component: SignUp,
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