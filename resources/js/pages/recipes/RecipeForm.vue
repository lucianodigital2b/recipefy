<template>
    <div>
        <h1>{{ recipe.id ? 'Edit Recipe' : 'Create Recipe' }}</h1>
        <form @submit.prevent="saveRecipe">
            <div>
                <label>Title</label>
                <input v-model="recipe.title" />
            </div>
            <div>
                <label>Description</label>
                <textarea v-model="recipe.description"></textarea>
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
</template>


<script setup>

import { reactive, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useStore } from 'vuex';
import axios from 'axios';

const route = useRoute();
const router = useRouter();
const store = useStore();

const recipe = reactive({
    title: '',
    description: '',
});

const id = route.params.id;

const saveRecipe = () => {
    if (id) {
        store.dispatch('updateRecipe', { ...recipe, id }).then(() => {
            router.push('/');
        });
    } else {
        store.dispatch('createRecipe', recipe).then(() => {
            router.push('/');
        });
    }
};

onMounted(() => {
    if (id) {
        axios.get(`/recipes/${id}`).then((response) => {
            Object.assign(recipe, response.data);
        });
    }
});

</script>