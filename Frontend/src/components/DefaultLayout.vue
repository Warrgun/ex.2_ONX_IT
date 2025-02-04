<template >
    <nav class="navbar navbar-expand-lg align-content-center navbar-bg mx-sm-3 mt-sm-2 ">
        <div class="container d-flex justify-content-end">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="empty"></div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-lg-auto">
                    <li class="nav-item">
                        <RouterLink :class="[$route.name === 'Home'?'nav-link active':'nav-link']" aria-current="page" to="/">Home</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink :class="[$route.name === 'Library'?'nav-link active':'nav-link']" to="/library">Library</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink :class="[$route.name === 'Reviews'?'nav-link active':'nav-link']" to="/reviews">Reviews</RouterLink>
                    </li>
                </ul>
                <hr>
                <button @click="logout" class="btn btn-success rounded-1 fw-bold" type="submit">Logout</button>
            </div>
        </div>
    </nav>
    <RouterView/>
</template>
<script setup>

import { RouterLink, RouterView } from 'vue-router';
import useUserStore from '../store/user';
import { computed } from 'vue';
import axiosClient from '../axios';
import router from '../router';

const userStore = useUserStore();
const user = computed(()=> userStore.user)

const logout = () =>{
    axiosClient.post('/logout').then(response => router.push({name:'Login'}))
  }


</script>
<style scoped>
    .empty{
        width: 79.16px;
        height: 100%;
    }
    .navbar-bg{
        background-color: azure;
        border-radius: 2em;
    }
    .btn-success{
        background-color: #19AA8D;
        border-color: #19AA8D;
    }
    .btn-success:hover{
        background-color: #1a9e84;
        border-color: #1a9e84;
    }
    @media(max-width:575px){
        .navbar-bg{
            border-radius: 0;
        }
    }
</style>