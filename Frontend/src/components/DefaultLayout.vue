<template >
    <nav class="navbar navbar-expand-lg align-content-center bg-body-secondary ">
        <div class="container d-flex justify-content-end">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-lg-auto">
                <li class="nav-item">
                <RouterLink :class="[$route.name === 'Home'?'nav-link active':'nav-link']" aria-current="page" to="/">Home</RouterLink>
                </li>
                <li class="nav-item">
                <RouterLink :class="[$route.name === 'Library'?'nav-link active':'nav-link']" to="/library">Library</RouterLink>
                </li>
            </ul>
        </div>
        </div>
    </nav>
    <RouterView/>
</template>
<script setup>

import { RouterLink, RouterView } from 'vue-router';


</script>
<style scoped>
    
</style>