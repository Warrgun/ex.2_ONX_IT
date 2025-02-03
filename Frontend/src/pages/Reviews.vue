<template>
    <div class="container w-100 p-0">
        <div class="w-100 rounded-2 text-bg-light p-5  mt-5">
          <div class="row w-100 d-none d-md-flex fw-bold mb-2 ">
                <div class="col-12 pb-3 pb-md-0 col-md-2">Title</div>
                <div class="col-12 pb-3 pb-md-0 col-md-2">Name</div>
                <div class="col-12 pb-3 pb-md-0 col-md-2">Rating</div>
                <div class="col-12 pb-3 pb-md-0 col-md-6">Review</div>
            </div>
            <div v-for="(item,i) in books" :class="{'book-container review-border':true, 'd-none':item.user_reviewes.length ===0,}" :key="item.id">
                <div class="book-title border-right"><span class="show fw-bold">Title:</span>{{ item.title }}</div>
                <div v-for="e in item.user_reviewes" class=" span-auto" :key="e.id">
                  <div class="border-right"><span class="show fw-bold">Name:</span>&nbsp;{{ e.name }}</div>
                  <div class="border-right"><span class="show fw-bold">Rating:</span>&nbsp;{{ e.rating }}/5</div>
                  <div class="d-flex justify-content-between">
                    <div class=""><span class="show fw-bold">Review:</span>&nbsp;{{ e.review }}</div>
                    <div class="">
                      <ModalComponent  :prop="e" :func="fetchData"/>
                    </div>
                    
                  </div>
                 
                </div>
                
            </div>
        </div>
      </div>
    
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import axiosClient from '../axios';
  import ModalComponent from '../components/ModalComponent.vue';


  const reviews = ref([]);
  const loading = ref(true);
  const books = ref([]);
  
  onMounted(() => {
    axiosClient
      .get('/api/reviews')
      .then((response) => {
        console.log(response.data)
        reviews.value = response.data;
      })
      .catch((error) => {
        console.error('Error fetching reviews:', error);
      })
      .finally(() => {
        loading.value = false;
      });
  });

  const fetchData=() =>{
    axiosClient.get(`/api/books`)
      .then(response => {
        books.value = response.data;
        console.log(response.data)
      })
      .catch(error => {
        console.error('Error fetching books:', error);
      });
  }


  onMounted(fetchData);
  </script>
  
  <style scoped>
  .book-container {
    display: grid;
    grid-template-rows: auto;
    grid-template-columns: 2fr 10fr;
    
  }

  .book-title {
    grid-row: span 2;
    border-right: 1px solid rgb(145, 145, 145);
  }

  .border-right{
    border-right: 1px solid rgb(145, 145, 145);
  }

  .span-auto {
    display: grid;
    grid-template-rows: 1fr;
    grid-template-columns: 2fr 2fr 6fr;
  }
  .review-border{
    border-bottom: 1px solid rgb(145, 145, 145);
  }

  .none{
    max-width: 35em;
    text-shadow: 2px 2px 3px black;
  }
  .show{
    display: none;
  }
  
  @media (max-width: 767px) {

    .none{
        display: none;
    }
    .show{
      display: inline;
    }
  }
  </style>
  