<template>
    <template v-for="(item) in items" :key="item">
        <recipe-card 
          :id="item.id"
          :title="item.title"
          :slug="item.slug ?? 'blabla'"
          :thumbnail="item.thumbnail"
          :author="'Admin'"
          :votes="item.votes ?? 0"
          :favorites="item.favorites ?? 0"
        />

    </template>
</template>

<script setup>
import { computed, onMounted, ref, watch } from 'vue';
import axios from '../plugins/axios';

let items = ref([]);
let current_page = ref(1);
let last_page = ref(null);
let bottom = ref(false);

watch(bottom, () => {
  fetchRecipes();
});

const fetchRecipes = async () => {

  if(current_page.value > last_page.value && last_page.value) {
    return;
  }

  const { data } = await axios.get('/recipes', {
    params: {
      page: current_page.value
    }
  });


  items.value.push(...data.data)

  current_page.value += 1;
  last_page.value = data.last_page;
  
}

onMounted(() => {
  fetchRecipes();
})

const bottomVisible = () => {
  const visible = document.documentElement.clientHeight;
  const pageHeight = document.documentElement.scrollHeight;
  const bottom = visible + window.scrollY >= pageHeight;

  return bottom;
}



</script>