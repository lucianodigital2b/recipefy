import { ref, watch } from 'vue';
import axios from '../../plugins/axios';


/**
 * Composable that handles favoriting for a recipe.
 *
 * @param {number} recipeId - The ID of the recipe to favorite.
 * @param {number} [initialFavorites=0] - The initial number of favorites.
 * @param {boolean} [initialHasFavorited=false] - Whether the user has already favorited.
 *
 * @returns {Object} An object containing the following properties:
 * - `favorites`: A ref containing the current number of favorites.
 * - `loading`: A ref indicating whether a favorite is currently being processed.
 * - `hasFavorited`: A ref indicating whether the user has favorited.
 * - `favorite`: A function that can be called to toggle the favorite by the given amount.
 */
export function useFavorite(recipeId, initialFavorites = 0, initialHasFavorited = false, ) {
  
  const favorites = ref(initialFavorites);
  const hasFavorited = ref(initialHasFavorited);
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

  return {
    favorites,
    loading,
    hasFavorited,
    favorite,
  };
}
