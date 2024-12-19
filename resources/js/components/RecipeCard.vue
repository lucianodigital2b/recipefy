<template>
  <div class="mb-3 border-bottom" >
    <div class="row align-items-center py-7">
      <div class="col-md-auto col-sm-12">
        <router-link :to="{ name: 'recipes.show', params: { slug: slug } }" class="text-decoration-none">
          <img :src="thumbnail ? `../storage/${thumbnail}` : '../img/blank-image-recipe.png'" alt="Post Thumbnail" class="img-fluid rounded-3 recipe-thumbnail" >
        </router-link>
      </div>
      <div class="col">
        <div class="card-body">
          <router-link :to="{ name: 'recipes.show', params: { slug: slug } }" class="text-decoration-none">
            <h5 class="card-title">{{ title }}</h5>
          </router-link> 
          <div class="text-muted"><small>By {{ author }}</small></div>

          <div class="d-flex gap-2">
            <div class="d-inline-flex align-items-center rounded-3 mt-4" style="background-color: #F1F1F4;">
              <button @click.prevent="changeVote(1)" class="btn btn-sm btn-upvote" :class="{ 'has-upvoted': hasUpvoted }">
                <ArrowUpIcon class="hero-icon"/>
              </button>
              <span class="text-dark">{{ votes }}</span>
              <button @click.prevent="changeVote(-1)" class="btn btn-sm btn-downvote" :class="{ 'has-downvoted': hasDownvoted }">
                <ArrowDownIcon class="hero-icon"/>
              </button>
            </div>
            <div class="d-inline-flex align-items-center rounded-3 mt-4" style="background-color: #F1F1F4;">
              <button @click.prevent="favorite" class="btn btn-sm" :class="{ 'has-favorited': hasFavorited }">
                {{ favorites }}
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
import { ref, reactive } from 'vue';
import { ArrowDownIcon, ArrowUpIcon, HeartIcon } from '@heroicons/vue/24/outline'
import { HeartIcon as HeartIconSolid } from '@heroicons/vue/24/solid'
import axios from '../plugins/axios';

const props = defineProps({
  id: Number,
  title: String,
  slug: String,
  thumbnail: String,
  author: String,
  votes: Number,
  favorites: Number,
})


let votes = ref(props.votes);
let favorites = ref(props.favorites);

let hasUpvoted = ref(false);
let hasDownvoted = ref(false);
let hasFavorited = ref(false);
let loading = ref(false);

const changeVote = async (vote) => {
  if( loading.value || (hasUpvoted.value || hasDownvoted.value)) return;

  votes.value += vote;
  hasUpvoted.value = vote === 1
  hasDownvoted.value = vote !== 1;

  loading.value = true;

  try {
    await axios.post('/recipes/' + props.id + '/vote', {
      direction: vote
    });
  }finally {
    loading.value = false;
  }
}

const favorite = async () => {
  
  if( loading.value) return;

  hasFavorited.value = !hasFavorited.value;
  favorites.value = hasFavorited.value ? favorites.value + 1 : favorites.value - 1;

  loading.value = true;

  try {
    await axios.post('/recipes/' + props.id + '/favorite', {
      direction: hasFavorited.value
    });
  }finally {
    loading.value = false;
  }


}

</script>
