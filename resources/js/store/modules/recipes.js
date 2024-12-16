import { defineStore } from 'pinia';

export const useRecipesStore = defineStore('recipes', {
  state: () => ({
    recipes: [],
  }),
  getters: {
    allRecipes: (state) => state.recipes,
    recipeById: (state) => (id) => state.recipes.find((recipe) => recipe.id === id),
  },
  actions: {
    fetchRecipes() {
      const recipes = [
        { id: 1, title: 'Recipe 1', description: 'Delicious food' },
        { id: 2, title: 'Recipe 2', description: 'Another great meal' },
      ];
      this.recipes = recipes;
    },
    addRecipe(recipe) {
      this.recipes.push(recipe);
    },
  },
});