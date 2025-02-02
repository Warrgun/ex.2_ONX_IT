<template>
    <div class="container w-100 h-100  align-content-center">
        <div class="row align-items-center">
            <div class="col-6 ps-lg-5 ">
                <div class="book-form p-4 shadow-lg rounded">
                    <h2 class="text-center mb-4">Add a New Book</h2>
                    <form @submit.prevent="addBook">
                    <div class="mb-3">
                        <input v-model="book.title" id="title" name="title" type="text" class="form-control custom-input rounded-0" placeholder="Title" required>
                    </div>
                    <div class="mb-3">
                        <input v-model="book.author" id="author" name="author" type="text" class="form-control custom-input rounded-0" placeholder="Author" required>
                    </div>
                    <div class="mb-3">
                        <input v-model="book.book_created" id="created" name="created" type="date" class="form-control custom-input rounded-0" required>
                    </div>
                    <div class="mb-3">
                        <textarea v-model="book.description" id="desc" name="desc" class="form-control custom-input rounded-0" placeholder="Description (optional)" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Book</button>
                    </form>
                </div>
            </div>
            <div class="col-6 text-center text-light">
                <div class="wrap-text none ">
                    <h1>Add books to our library. Share what parts you liked the most and try not to spoil anything!</h1>
                </div>
            </div>
        </div>
    </div>
</template>
  
  <script setup>
  import { ref } from 'vue';
  import axiosClient from '../axios';
  
  const book = ref({
    title: '',
    author: '',
    book_created: '',
    description: '',
  });

  
  const addBook = () => {
    console.log(book.value)
    axiosClient.post('/api/book_data', book.value)
        .then(response => {
                book.value='';
                console.log('Book added successfully:', response);
            })
        .catch(error => {
            console.error('Error books:', error);
        });
  };
  </script>
  
  <style scoped>
  .book-form {
    background: rgba(255, 255, 255, 1);
    border-radius: 10px;
    max-width: 35em;
  }
  .none{
    max-width: 35em;
    text-shadow: 2px 2px 3px black;
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
  
  @media (max-width: 768px) {
    .col-6 {
      width: 100%;
      text-align: center;
      margin-bottom: 20px;
    }
    .none{
        display: none;
    }
  }
  </style>
  