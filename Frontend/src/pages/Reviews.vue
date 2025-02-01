<template>
    <div class="container-fluid w-100 p-0">
        <div class="w-100 rounded-2 text-bg-light p-5  mt-5">
          <div class="row w-100 d-none d-md-flex fw-bold border-bottom pb-2">
                <div class="col-12 pb-3 pb-md-0 col-md-2">Title</div>
                <div class="col-12 pb-3 pb-md-0 col-md-2">Name</div>
                <div class="col-12 pb-3 pb-md-0 col-md-2">Rating</div>
                <div class="col-12 pb-3 pb-md-0 col-md-6">Review</div>
            </div>
            <div v-for="item in reviews" :class="[item.id === 1 ? 'row w-100' : 'row w-100 border-top']" :key="item.id">
                <div class="col-12 pb-3 pb-md-0 col-md-2">{{ books.find(book => book.id === item.book_id)?.title }}</div>
                <div class="col-12 pb-3 pb-md-0 col-md-2">{{ item.name }}</div>
                <div class="col-12 pb-3 pb-md-0 col-md-2">{{ item.rating }}</div>
                <div class="col-12 pb-3 pb-md-0 col-md-6">{{ item.review }}</div>
            </div>
        </div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import axiosClient from '../axios';
  
  const books = ref([]);
  const reviews = ref([]);
  const loading = ref(true);
  
  onMounted(() => {
    axiosClient
      .get('/api/reviews')
      .then((response) => {
        reviews.value = response.data;
      })
      .catch((error) => {
        console.error('Error fetching reviews:', error);
      })
      .finally(() => {
        loading.value = false;
      });
  });

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
  .fw-bold {
    font-weight: bold;
  }
  .border-bottom {
    border-bottom: 2px solid #ddd;
  }
  </style>
  