import { onMounted, ref } from 'vue';
import axiosClient from './axios';
  

  const book_data = () =>{
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

    return books;
  }

  export default book_data