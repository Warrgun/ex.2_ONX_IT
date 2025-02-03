<template>
  <div class="btn-group my-2 ms-md-1">
    <button class="btn btn-outline-primary" @click="editReview(prop)">Edit</button>
    <button class="btn btn-danger" @click="deleteReview(prop.id)">Remove</button>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modalRef">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit the review</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form v-if="editingReview" class="mb-3">
            <div class="mb-3">
              <label for="name1" class=" fw-semibold">Name</label>
              <input v-model="editingReview.name" id="name1" type="text" class="form-control custom-input rounded-0" placeholder="Name" required>
            </div>
            <div class="mb-3">
              <label for="rating1" class=" fw-semibold">Rating</label>
              <input v-model="editingReview.rating" id="rating1" type="number" min="0" max="5" class="form-control custom-input rounded-0" placeholder="Rating 0/5" required>
            </div>
            <div class="mb-3">
              <label for="review1" class=" fw-semibold">Review</label>
              <textarea v-model="editingReview.review" id="review1" placeholder="Your review" class="form-control custom-input rounded-0" required></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" @click="cancelEdit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" @click="updateReview" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Modal } from 'bootstrap'
import axiosClient from '../axios'

const props=defineProps({
  prop: {
    type: Object,
    required: true
  },
  func:{
    type: Function,
    required: true
  }
});

const modalRef = ref(null)
const editingReview = ref(null)

const editReview = (review) => {
  editingReview.value = { ...review }

  const modal = new Modal(modalRef.value)
  modal.show()
}

const closeModal = () => {
  const modal = Modal.getInstance(modalRef.value)
  if (modal) modal.hide()
}

const updateReview = () => {
  axiosClient
    .put(`/api/review_data/${editingReview.value.id}`, editingReview.value)
    .then(() => {
      editingReview.value = null 
      props.func()
      closeModal()
    })
    .catch((error) => {
      console.error('Error updating review:', error)
    })
}

const cancelEdit = () => {
  editingReview.value = null
}

const deleteReview = (reviewId) => {
  if (!confirm("Are you sure you want to delete this review?")) return;

  axiosClient
    .delete(`/api/review_data/${reviewId}`)
    .then(() => {
      props.func();
    })
    .catch((error) => {
      console.error("Error deleting review:", error);
    });
};
</script>

<style scoped>
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
</style>
