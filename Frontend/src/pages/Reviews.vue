<template>
    <div class="container w-100 p-0">
        <div class="w-100 rounded-2 text-bg-light p-1 p-sm-3 p-md-4 p-lg-5  mt-5">
          <div class="row w-100 d-none d-md-flex fw-bold mb-2 ">
                <div class="col-12 pb-3 pb-md-0 col-md-2">Title</div>
                <div class="col-12 pb-3 pb-md-0 col-md-2">Name</div>
                <div class="col-12 pb-3 pb-md-0 col-md-2">Rating</div>
                <div class="col-12 pb-3 pb-md-0 col-md-6">Review</div>
            </div>
            <div v-for="(item,i) in books" :class="{'book-container':true,'review-border': i !== books.length -1}" :key="item.id" :style="{'--row-span': item.user_reviewes.length + 1}">
                <div class="book-title border-right"><span class="show fw-bold">Title<br/></span>{{ item.title }}</div>
                <div v-for="(e, index) in item.user_reviewes" class=" span-auto" :key="e.id">
                  <div :class="{'elements wrap-text ps-1 ps-md-2':true, 'review-border': index !== item.user_reviewes.length-1}"><span class="show fw-bold">Name:</span> {{ e.name }}</div>
                  <div :class="{'elements wrap-text ps-1 ps-md-2':true,'review-border': index !== item.user_reviewes.length-1}"><span class="show fw-bold">Rating:</span> {{ e.rating }}/5</div>
                  <div :class="{'d-flex flex-column flex-md-row justify-content-between ps-1 ps-md-2':true,'review-border': index !== item.user_reviewes.length-1}">
                    <div :class="{'wrap-text':true}"><span class="show fw-bold">Review:</span> {{ e.review }}</div>
                    <div class="d-flex d-md-block justify-content-end">
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
    axiosClient.get(`/api/books-review`)
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
  .wrap-text{
    word-wrap: break-word;
    word-break: break-all;
  }

  .book-container {
    display: grid;
    grid-template-rows: auto;
    grid-template-columns: 2fr 10fr;
    
  }

  .book-title {
    grid-row: span var(--row-span, 2);
    border-right: 1px solid rgb(145, 145, 145);
  }

  .border-right, .elements{
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

    .span-auto{
      grid-template-columns: 1fr;
    }
    .elements{
      border: none;
    }
  }
  </style>
  