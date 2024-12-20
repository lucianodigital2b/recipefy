import { ref, watch } from 'vue';
import axios from '../../plugins/axios';

/**
 * Composable that handles voting for a recipe.
 *
 * @param {number} recipeId - The ID of the recipe to vote on.
 * @param {number} [initialVotes=0] - The initial number of votes.
 * @param {boolean} [initialHasUpvoted=false] - Whether the user has already upvoted.
 * @param {boolean} [initialHasDownvoted=false] - Whether the user has already downvoted.
 *
 * @returns {Object} An object containing the following properties:
 * - `votes`: A ref containing the current number of votes.
 * - `loading`: A ref indicating whether a vote is currently being processed.
 * - `hasUpvoted`: A ref indicating whether the user has upvoted.
 * - `hasDownvoted`: A ref indicating whether the user has downvoted.
 * - `changeVote`: A function that can be called to change the vote by the given amount.
 */
export function useVote(recipeId, initialVotes = 0, initialHasUpvoted = false, initialHasDownvoted = false) {
  const votes = ref(initialVotes);
  const hasUpvoted = ref(initialHasUpvoted);
  const hasDownvoted = ref(initialHasDownvoted);
  const loading = ref(false);


  const changeVote = async (vote) => {
    if( loading.value || (hasUpvoted.value || hasDownvoted.value)) return;
  
    votes.value += vote;
    hasUpvoted.value = vote === 1
    hasDownvoted.value = vote !== 1;
  
    loading.value = true;
  
    try {
      await axios.post(`/recipes/${recipeId}/vote`, {
        direction: vote
      });
    }finally {
      loading.value = false;
    }
  }


  return {
    votes,
    loading,
    hasUpvoted,
    hasDownvoted,
    changeVote,
  };
}
