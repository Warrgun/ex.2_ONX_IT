<template>
    <div class="container w-100  mt-5">
      <div class="row align-items-center">
            <div class="col-6 ps-lg-5 order-1">
                <div class="book-form p-4 shadow-lg rounded ms-lg-5 ">
                    <h2 class="text-center mb-4">Review</h2>
                    <form class="mb-3" @submit.prevent="addReview">
                      <div class="mb-3">
                        <h6>Choose a book</h6>
                        <select v-model="review.book_id" class="form-select w-100 bg-primary bg-opacity-75 text-light overflow-auto" size="2" id="books" name="books"  aria-label="Size 3 select example">
                          <option v-for="book in books" :key="book.id" :value="book.id">{{ book.title }}</option>
                        </select>
                      </div>
                      <div class="mb-3">
                          <input v-model="review.name" id="name1" name="name1" type="text" class="form-control custom-input rounded-0" placeholder="Name" required>
                      </div>
                      <div class="mb-3">
                          <input v-model="review.rating" id="rating1" name="rating1" type="number" min="0" max="5" class="form-control custom-input rounded-0" placeholder="rating 0/5" required>
                      </div>
                      <div class="mb-3">
                          <textarea v-model="review.review" id="review1" name="review1" placeholder="Your review" class="form-control custom-input rounded-0" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary w-100">Send a review</button>
                    </form>
                    <a class=" text-dark opacity-75 text-decoration-none" target="_blank" href="https://www.vecteezy.com/free-png/book">Book PNGs by Vecteezy</a>
                </div>
            </div>
            <div class="col-6 text-center text-light">
                <div class="wrap-text none ">
                    <img src="../assets/small-book.png" class=" object-fit-contain w-50" alt="pic1">
                </div>
            </div>
        </div>
      <div class="w-100 rounded-2 d-flex justify-content-between align-items-center text-bg-light p-3  mt-5">
        <h4 class="m-0">Book collection</h4>
        <select class="form-select bg-primary text-light" @change="fetchData" v-model="selectedSort" aria-label="Default select example">
          <option selected value="">filter by</option>
          <option value="title">title</option>
          <option value="author">author</option>
          <option value="book_created">date</option>
        </select>
      </div>
      <div class="w-100 rounded-2 text-bg-light p-3 p-sm-5  my-3 ">
        <div class="row w-100 d-none d-md-flex fw-bold pb-2">
              <div class="col-12 pb-3 pb-md-0 col-md-2">Title</div>
              <div class="col-12 pb-3 pb-md-0 col-md-2">Author</div>
              <div class="col-12 pb-3 pb-md-0 col-md-2">Published</div>
              <div class="col-12 pb-3 pb-md-0 col-md-6">Description</div>
          </div>
          <div v-for="(item,i) in books" :class="{'row':true, 'book-border': i!== books.length-1}" :key="item.id">
              <div class="col-12 pb-3 pb-md-0 col-md-2 border-right"><span class=" show fw-bold">Title:</span> {{ item.title }}</div>
              <div class="col-12 pb-3 pb-md-0 col-md-2 border-right"><span class=" show fw-bold">Author:</span> {{ item.author }}</div>
              <div class="col-12 pb-3 pb-md-0 col-md-2 border-right"><span class=" show fw-bold">Published:</span> {{ item.book_created }}</div>
              <div class="col-12 pb-3 pb-md-0 col-md-6"> <span class=" show fw-bold">Description:</span> {{ item.description }}</div>
          </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import axiosClient from '../axios';

  const books = ref([]);
  const selectedSort = ref('title')

  const review = ref({
    book_id:null,
    name: '',
    rating: null,
    review: '',
  });

  const fetchData=() =>{
    axiosClient.get(`/api/books?sort_by=${selectedSort.value}&order=asc`)
      .then(response => {
        books.value = response.data;
      })
      .catch(error => {
        console.error('Error fetching books:', error);
      });
  }

  onMounted(fetchData);
  
  const addReview = () => {
    console.log(review.value)
    axiosClient.post('/api/review_data', review.value)
        .then(response => {
                console.log('Review added successfully:', response);
            })
        .catch(error => {
            console.error('Error review:', error);
        });
  };
  </script>
  
  <style scoped>
   .fw-bold {
    font-weight: bold;
  }
  .book-border{
    border-bottom: 1px solid rgb(145, 145, 145);
  }

  .border-right{
    border-right: 1px solid rgb(145, 145, 145);
  }

  .form-select{
    width: 7em;
  }

  .book-form {
    background: rgba(255, 255, 255, 1);
    border-radius: 10px;
    max-width: 35em;
  }
  .none{
    max-width: 35em;
    text-shadow: 2px 2px 3px black;
  }
  .show{
    display: none;
  }
  
  .custom-input {
    background: transparent;
    border: none;
    border-bottom: 2px solid rgba(0, 0, 0, 0.5);
    outline: none;
    color: black;
    font-size: 16px;
    transition: border-bottom 0.3s ease-in-out;
  }
  
  .custom-input:focus {
    border-bottom: 2px solid rgba(0, 0, 0, 0.8);
    box-shadow: none;
  }
  
  @media (max-width: 767px) {
    .col-6 {
      width: 100%;
      text-align: center;
      margin-bottom: 20px;
    }
    .none{
        display: none;
    }
    .show{
      display: inline;
    }
  }
  </style>
  