import { ref, toValue, watch, watchEffect } from 'vue';
import axios from '../../plugins/axios';



export function useFavorite(recipeId, initialFavorites, initialHasFavorited ) {
  
  const favorites = ref( toValue(initialFavorites) || 0 );
  const hasFavorited = ref( toValue(initialHasFavorited) );
  const loading = ref(false);

  
  const favorite = async () => {
    
    if( loading.value) return;

    hasFavorited.value = !hasFavorited.value;
    favorites.value = hasFavorited.value ? favorites.value + 1 : favorites.value - 1;

    loading.value = true;

    try {
      await axios.post('/recipes/' + recipeId + '/favorite', {
        direction: hasFavorited.value
      });
    }finally {
      loading.value = false;
    }
  }


  watchEffect(() => {
    favorites.value = toValue(initialFavorites) || 0;
    hasFavorited.value = toValue(initialHasFavorited);
  })


  return {
    favorites,
    loading,
    hasFavorited,
    favorite,
  };
}
