<template>

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

import { onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import Form from 'vform'
import { useRecipesStore } from '../../store/modules/recipes'
import { ref, reactive } from 'vue'
import axios from '../../plugins/axios';
import { PlusIcon, XMarkIcon, PencilSquareIcon } from '@heroicons/vue/24/outline'

const route = useRoute();
const router = useRouter();
const store = useRecipesStore();


const slug = route.params.slug;

const form = reactive( new Form({
  title: '',
  description: '',
  thumbnail: null,
  servings: '',
  prep_time: '',
  prep_time_type: '1',
  ingredients: [],
  steps: [],
}));

onMounted(() => {
    if (slug) {
        form.get(`/recipes/${slug}`).then((response) => {
            Object.assign(form, response.data);
        });
    }
});

</script>