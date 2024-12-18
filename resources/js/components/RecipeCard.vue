<template>
  <div class="mb-3 border-bottom" >
    <div class="row align-items-center py-7">
      <div class="col-md-auto col-sm-12">
        <router-link to="{{ name: '/recipes/' + id }}" class="text-decoration-none">
          <img :src="thumbnail ? `../storage/${thumbnail}` : '../img/blank-image-recipe.png'" alt="Post Thumbnail" class="img-fluid rounded-3 recipe-thumbnail" >
        </router-link>
      </div>
      <div class="col">
        <div class="card-body">
          <router-link to="{{ name: '/recipes/' + id }}" class="text-decoration-none"><h5 class="card-title">{{ title }}</h5></router-link> 
          <div class="text-muted"><small>By {{ author }}</small></div>

          <div class="d-flex gap-2">
            <div class="d-inline-flex align-items-center rounded-3 mt-4" style="background-color: #F1F1F4;">
              <button @click.prevent="upvote" class="btn btn-sm btn-upvote" :class="{ 'has-upvoted': hasUpvoted }">
                <ArrowUpIcon class="hero-icon"/>
              </button>
              <span class="text-dark">{{ votes }}</span>
              <button @click.prevent="downvote" class="btn btn-sm btn-downvote" :class="{ 'has-downvoted': hasDownvoted }">
                <ArrowDownIcon class="hero-icon"/>
              </button>
            </div>
            <div class="d-inline-flex align-items-center rounded-3 mt-4" style="background-color: #F1F1F4;">
              <button @click.prevent="favorite" class="btn btn-sm" :class="{ 'has-favorited': hasFavorited }">
                <HeartIcon v-if="!hasFavorited" class="hero-icon btn-favorited"/>
                <HeartIconSolid v-if="hasFavorited" class="hero-icon"/>
              </button>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>

  .recipe-thumbnail {
    width: 300px; 
    height: 300px;
    object-fit: cover;
  }

  @media (max-width: 992px) {
    .recipe-thumbnail {
      width: 100%; 
      margin-bottom: 1rem;
    }
  }



  .has-upvoted, .btn-upvote:hover {
    color: #dd5d02;
  }

  .has-downvoted, .btn-downvote:hover {
    color: #6A5CFF;
  }

  .has-favorited, .btn-favorited:hover {
    color: #F8285A;
  }
</style>

<script setup>
import { ref } from 'vue';
import { ArrowDownIcon, ArrowUpIcon, HeartIcon } from '@heroicons/vue/24/outline'
import { HeartIcon as HeartIconSolid } from '@heroicons/vue/24/solid'

const props = defineProps({
  id: Number,
  title: String,
  thumbnail: String,
  author: String,
  votes: Number
})

let votes = ref(0);
let hasUpvoted = ref(false);
let hasDownvoted = ref(false);
let hasFavorited = ref(false);

const upvote = () => {
  if(!hasUpvoted) return;
  votes.value += 1;
  hasUpvoted.value = !hasUpvoted.value;
}

const downvote = () => {
  if(!hasDownvoted) return;

  votes.value -= 1;
  hasDownvoted.value = !hasDownvoted.value;
}

const favorite = () => {
  if(!hasFavorited) return;

  hasFavorited.value = !hasFavorited.value;

  form.post('/recipes/' + props.id + '/favorite');

}

</script>
