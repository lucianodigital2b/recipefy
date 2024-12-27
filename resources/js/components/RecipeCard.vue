<template>
  <div class="mb-3 border-bottom" >
    <div class="row align-items-center py-7">
      <div class="col-md-auto col-sm-12">
        <router-link :to="{ name: 'recipes.show', params: { slug: slug, id: id } }" class="text-decoration-none">
          <img :src="thumbnail ? `../storage/${thumbnail}` : '../img/blank-image-recipe.png'" alt="Post Thumbnail" class="img-fluid rounded-3 recipe-thumbnail" >
        </router-link>
      </div>
      <div class="col">
        <div class="card-body">
          <router-link :to="{ name: 'recipes.show', params: { slug: slug, id: id } }" class="text-decoration-none">
            <h5 class="card-title">{{ title }}</h5>
          </router-link> 
          <div class="text-muted"><small>By {{ author }}</small></div>

          <div class="d-flex gap-2">
            <div class="d-inline-flex align-items-center rounded-3 mt-4" style="background-color: #F1F1F4;">
              <button @click.prevent="changeVote(1)" class="btn btn-sm btn-upvote" :class="{ 'has-upvoted': hasUpvoted }" :disabled="loading.value || hasUpvoted">
                <ArrowUpIcon class="hero-icon"/>
              </button>
              <span class="text-dark">{{ votes }}</span>
              <button @click.prevent="changeVote(-1)" class="btn btn-sm btn-downvote" :class="{ 'has-downvoted': hasDownvoted }" :disabled="loading.value || hasDownvoted">
                <ArrowDownIcon class="hero-icon"/>
              </button>
            </div>
            <div class="d-inline-flex align-items-center rounded-3 mt-4" style="background-color: #F1F1F4;">
              <button @click.prevent="favorite" class="btn btn-sm" :class="{ 'has-favorited': hasFavorited }" :disabled="loadingFavorite.value">
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



</style>

<script setup>
import { ref, reactive } from 'vue';
import { ArrowDownIcon, ArrowUpIcon, HeartIcon } from '@heroicons/vue/24/outline'
import { HeartIcon as HeartIconSolid } from '@heroicons/vue/24/solid'
import axios from '../plugins/axios';
import { useVote } from '../composables/recipes/useVote';
import { useFavorite } from '../composables/recipes/useFavorite';

const props = defineProps({
  id: Number,
  title: String,
  slug: String,
  thumbnail: String,
  author: String,
  votes: Number,
  favorites: Number,
  hasUpvoted: Boolean,
  hasDownvoted: Boolean,
  hasFavorited: Boolean,
})

const { votes, loading, changeVote, hasUpvoted, hasDownvoted } = useVote(props.id, () => props.votes, () => props.hasUpvoted, () => props.hasDownvoted);
const { favorites, hasFavorited, favorite, loading: loadingFavorite } = useFavorite(props.id, () => props.favorites, () => props.hasFavorited);



</script>
