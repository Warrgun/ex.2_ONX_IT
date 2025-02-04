<template >
    <GuestLayout>
        <form @submit.prevent="submit" class=" bg-light rounded-1 px-4 py-5">
            <h1 class="">Sign In</h1>
            <p class=" text-secondary">Please fill in this form to sign in!</p>
            <hr>
            <div v-if="errorMessage" class="p-2 mb-3 rounded-2 text-bg-danger">
                {{ errorMessage }}
            </div>
            <div class="form-group mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark-subtle">
                        <font-awesome-icon :icon="['fas', 'paper-plane']" />
                    </span>
                    <input v-model="data.email" type="email" class="form-control outline focus-ring focus-ring-success" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
            </div>
            <div class="form-group mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark-subtle">
                        <font-awesome-icon class="" :icon="['fas', 'lock']" />
                    </span>
                    <input v-model="data.password" type="password" class="form-control focus-ring focus-ring-success" required id="exampleInputPassword1" placeholder="Password">
                </div>
            </div>
            <button type="submit" class="btn btn-success rounded-1 w-100 fw-bold">Login</button>
        </form>
        <div class="text-center fw-semibold text-light mt-1">
            Don't have an account?
            <RouterLink  :to="{name:'SignUp'}" class="text-white underline">Create it here</RouterLink>
        </div>
    </GuestLayout>
</template>
<script setup>

import GuestLayout from '../components/GuestLayout.vue';
import { ref } from 'vue';
import axiosClient from '../axios';
import router from '../router';

const data = ref({
  email:'',
  password:'',
})

const errorMessage = ref('');

const submit = () =>{
  axiosClient.get('/sanctum/csrf-cookie').then(response => {
    axiosClient.post('/login', data.value)
        .then( response => {
            router.push({name:'Home'})
        })
        .catch(error => {
            console.error('Error :', error);
            errorMessage.value = error.response.data.message;
        })
  });
}

</script>
<style scoped>
    h1{
        font-family: sans-serif;
        font-weight: bold;
    }

    .btn-success{
        background-color: #19AA8D;
        border-color: #19AA8D;
    }
    .btn-success:hover{
        background-color: #1a9e84;
        border-color: #1a9e84;
    }
    .form-control:focus{
        border-color: #19AA8D;
    }
    .underline:hover{
        text-decoration: none;
    }
</style>