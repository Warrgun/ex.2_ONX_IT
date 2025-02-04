<template >
    <GuestLayout>
        <form @submit.prevent="submit" class=" bg-light rounded-1 px-4 py-5">
            <h1 class="">Sign Up</h1>
            <p class=" text-secondary">Please fill in this form to create an account!</p>
            <hr>
            <div class="form-group mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark-subtle">
                        <font-awesome-icon :icon="['fas', 'user']" />
                    </span>
                    <input v-model="data.name" type="text" class="form-control focus-ring focus-ring-success" id="exampleInputName1"  aria-describedby="nameHelp" placeholder="Username">
                </div>
                <small :class="{'text-danger':true,'ms-5':errors.name[0]}">{{errors.name ? errors.name[0]:'' }}</small>
            </div>
            <div class="form-group mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark-subtle">
                        <font-awesome-icon :icon="['fas', 'paper-plane']" />
                    </span>
                    <input v-model="data.email" type="email" class="form-control focus-ring focus-ring-success" id="exampleInputEmail1"  aria-describedby="emailHelp" placeholder="Email Address">
                </div>
                <small :class="{'text-danger':true,'ms-5':errors.email[0]}">{{errors.email ? errors.email[0]:'' }}</small>
            </div>
            <div class="form-group mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark-subtle">
                        <font-awesome-icon class="" :icon="['fas', 'key']" />
                    </span>
                    <input v-model="data.password" type="password" class="form-control focus-ring focus-ring-success" id="exampleInputPassword1" placeholder="Password">
                </div>
                <small :class="{'text-danger':true,'ms-5':errors.password[0]}">{{errors.password ? errors.password[0]:'' }}</small>
            </div>
            <div class="form-group mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark-subtle">
                        <font-awesome-icon :icon="['fas', 'lock']" />
                    </span>
                    <input v-model="data.password_confirmation" type="password" class="form-control focus-ring focus-ring-success"  id="exampleInputConfirmPassword1" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group form-check mb-3">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">I accept the Terms of Use & Privacy Policy</label>
            </div>
            <button type="submit" class="btn btn-success rounded-1 w-100 fw-bold">Sign Up</button>
        </form>
        <div class="text-center fw-semibold text-light mt-1">
            Already have an account?
            <RouterLink  :to="{name:'Login'}" class="text-white underline">Login here</RouterLink>
        </div>
    </GuestLayout>
</template>
<script setup>

    import { RouterLink } from 'vue-router';
    import GuestLayout from '../components/GuestLayout.vue';
    import { ref } from 'vue';
    import axiosClient from '../axios';
    import router from '../router';

    const data = ref({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    })

    const errors= ref({
        name:[],
        email:[],
        password:[],
    })

    const submit = () =>{
        axiosClient.get('/sanctum/csrf-cookie').then(response => {
            axiosClient.post("/register", data.value)
            .then( response => {
                router.push({name:'Home'})
             })
            .catch(error => {
                console.error('Error :', error);
                errors.value = error.response.data.errors;
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
    .form-check-input:active, .form-check-input:checked {
        background-color: #19AA8D;
    }
    .form-check-input:focus{
        box-shadow: 0 0 0 0.2rem #19aa8d6c;
    }
    .underline:hover{
        text-decoration: none;
    }
   
    
</style>