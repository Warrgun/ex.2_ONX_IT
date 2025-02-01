<template>
    <div class="container-fluid w-100 p-0">
        <div class="w-100 rounded-2 text-bg-light p-5  mt-5">
            <div v-for="item in books" :class="[item.id === 1 ? 'row w-100' : 'row w-100 border-top']" :key="item.id">
                <div class="col-12 pb-3 pb-md-0 col-md-2">{{ item.title }}</div>
                <div class="col-12 pb-3 pb-md-0 col-md-2">{{ item.author }}</div>
                <div class="col-12 pb-3 pb-md-0 col-md-2">{{ item.book_created }}</div>
                <div class="col-12 pb-3 pb-md-0 col-md-6">{{ item.description }}</div>
            </div>
        </div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import axiosClient from '../axios';
  
  const books = ref([]);
  const loading = ref(true);
  
  onMounted(() => {
    axiosClient
      .get('/api/books')
      .then((response) => {
        books.value = response.data;
      })
      .catch((error) => {
        console.error('Error fetching books:', error);
      })
      .finally(() => {
        loading.value = false;
      });
  });
  </script>
  
  <style scoped>
  </style>
  