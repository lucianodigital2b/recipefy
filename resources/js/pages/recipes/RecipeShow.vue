<template>
    <!-- <div class="colored-bg">

    </div> -->
    <div class="col-lg-6 mx-auto my-7">
        <div class="">
                <div class="row mb-7">
                    <div class="col-md-12">
                        <img :src="'/img/blank-image-recipe.png'" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-12 mb-5">
                        <h2>{{ recipe.title }}</h2>
                        <div class="text-muted">
                            By {{ recipe.author?.name }} · {{ recipe.created_at }}
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="mb-3 ">
                            {{ recipe.description }}
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="row border rounded py-4 px-2">
                            <div class="col-md-12 mb-5">
                                <div><strong>Prep time:</strong> <span>{{ recipe.prep_time }} {{ recipe.prep_time_type_formatted }}</span></div>
                            </div>
                            <div class="col-md-8 mb-5">
                                <div><strong>Servings:</strong> {{ recipe.servings }}</div>
                            </div>
                        </div>

                    </div>
                    
                </div>
                <div class="row">
                    <h6>Gallery</h6>
                    <div class="col-md-12">
                        <div class="recipe-gallery">
                            <div class="recipe-gallery-item" v-for="image in recipe.gallery" :key="image">
                                <button class="close-button" @click.prevent="removeImage(image)"><XMarkIcon class="hero-icon"></XMarkIcon></button>
                                <img :src="image" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <h6 class="mb-6 font-weight-bold">Ingredients</h6>
                       
                            <div class="d-flex gap-2 align-items-center" v-for="ingredient in recipe.ingredients" :key="ingredient">  
                                <div class=" d-flex align-items-center gap-1"><span class="text-secondary fs-2 font-weight-bold">·</span><span>{{ ingredient.name }}</span></div>  
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <h6 class="mb-6 font-weight-bold">Directions</h6>
                           
                            <div v-for="(step, index) in recipe.steps" :key="step">
                                <h6 class="form-label flex-1 ">Step {{ index +1 }}</h6>
                                <div class="d-flex gap-2 align-items-center mb-3">
                                    <CheckCircleIcon class="hero-icon"></CheckCircleIcon>
                                    <div>{{ step.description }}</div>  
                                </div>
                            </div>
            
                        </div>
                    </div>
                </div>

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
</template>


<style>
    .colored-bg {
        z-index: -10;
        background: #ffd988;
        padding: 6rem;
        position: absolute;
        width: 100%;
        left: 0;
        top: 61px;
    }

    .file-input-button {
        border: 1px dashed #ffd988;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        height: 150px;
        width: 100%;
        position: relative;
    }

    .input-empty {
        background: url('../img/blank-image.svg') no-repeat center center;
        background-size: cover;
        width: 150px;
        height: 100px;
    }

    .image-preview {
        width: 100%;
        height: 100px;
        background-size: cover;
        background-position: center;
    }

    .clear-thumbnail {
        position: absolute;
        top: -5px;
        right: 0;
        z-index: 5;
    }
</style>

<script setup>

import { onMounted, toValue, watch, watchEffect } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useRecipesStore } from '../../store/modules/recipes'
import { ref, reactive } from 'vue'
import axios from '../../plugins/axios';
import { PlusIcon, XMarkIcon, PencilSquareIcon, ClockIcon, CheckCircleIcon, ArrowDownIcon, ArrowUpIcon, HeartIcon } from '@heroicons/vue/24/outline'
import { HeartIcon as HeartIconSolid } from '@heroicons/vue/24/solid'
import { useVote } from '../../composables/recipes/useVote';
import { useFavorite } from '../../composables/recipes/useFavorite';

const route = useRoute();
const router = useRouter();
const store = useRecipesStore();

const id = route.params.id;
const recipe = reactive({});


onMounted(() => {
    if (id) {
        axios.get(`/recipes/${id}`).then((response) => {
            Object.assign(recipe, response.data);
        });
    }
});


const { votes, loading, changeVote, hasUpvoted, hasDownvoted } = useVote(id, () => recipe.votes, () => recipe.userVote?.type == 1, () => recipe.userVote?.type != 1);
const { favorites, hasFavorited, favorite, loading: loadingFavorite } = useFavorite(id, () => recipe.favorites, () => recipe.userFavorite != null);


</script>