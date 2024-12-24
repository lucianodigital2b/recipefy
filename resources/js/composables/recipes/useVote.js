import { ref, watch, watchEffect } from 'vue';
import axios from '../../plugins/axios';
import { toValue } from 'vue';


export function useVote(recipeId, initialVotes, initialHasUpvoted, initialHasDownvoted) {
  const votes = ref(toValue(initialVotes) || 0);
  const hasUpvoted = ref(initialHasUpvoted);
  const hasDownvoted = ref(initialHasDownvoted);
  const loading = ref(false);

  // console.log(initialVotes, initialHasUpvoted, initialHasDownvoted);  
  

  const changeVote = async (vote) => {
    if( loading.value) return;
    
  
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


  watchEffect(() => {
    votes.value = toValue(initialVotes) || 0;
    hasUpvoted.value = toValue(initialHasUpvoted);
    hasDownvoted.value = toValue(initialHasDownvoted);
  })

  return {
    votes,
    loading,
    hasUpvoted,
    hasDownvoted,
    changeVote,
  };
}
