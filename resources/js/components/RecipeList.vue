<template>
    <template v-for="(item) in items" :key="item">
        <recipe-card 
          :title="item.title"
          :thumbnail="item.thumbnail"
          :author="'Admin'"
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

onMounted(fetchRecipes)
onMounted(() => {
  window.onscroll = () => {
    bottom.value = bottomVisible();
  }
})

const bottomVisible = () => {
  const visible = document.documentElement.clientHeight;
  const pageHeight = document.documentElement.scrollHeight;
  const bottom = visible + window.scrollY >= pageHeight;

  return bottom;
}



</script>