<template>
    <div>
        <h1>Recipes</h1>
        <router-link to="/create">Create Recipe</router-link>
        <ul>
            <li v-for="recipe in recipes" :key="recipe.id">
                {{ recipe.title }}
                <router-link :to="`/recipe/${recipe.id}`">Edit</router-link>
                <button @click="deleteRecipe(recipe.id)">Delete</button>
            </li>
        </ul>

        <!-- <v-infinite-scroll  :items="items" :onLoad="load">
            <template v-for="(item, index) in items" :key="item">
            <div :class="['pa-2', index % 2 === 0 ? 'bg-grey-lighten-2' : '']">
                Item number #{{ item }}
            </div>
            </template>
        </v-infinite-scroll> -->
    </div>
</template>

<script setup>
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const recipes = computed(() => store.state.recipes);

const fetchRecipes = () => store.dispatch('fetchRecipes');
const deleteRecipe = (id) => store.dispatch('deleteRecipe', id);

onMounted(fetchRecipes);

</script>