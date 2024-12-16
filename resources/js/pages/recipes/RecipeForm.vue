<template>
    <div class="col-lg-7 mx-auto my-7">
        <card class="rounded-4 p-3 shadow-lg">
            <h3 class="mb-5">{{ form.id ? 'Edit Recipe' : 'Create a recipe' }}</h3>
            <form @submit.prevent="saveRecipe">
                <div class="row">
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label>Title</label>
                            <input solid v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control" name="title">
                            <has-error :form="form" field="title" />
            
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            
                            <textarea v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" class="form-control" name="description"></textarea>
                            <has-error :form="form" field="description" />
            
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label>Photo</label>
                        <div class="border border-dotted rounded-3 p-3 h-11">

                        </div>
                        <!-- <img class="rounded-4 img-fluid" src="https://images.pexels.com/photos/1099680/pexels-photo-1099680.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt=""> -->
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="mb-6">Ingredients</h6>
                            <div class="d-flex gap-2 align-items-center" v-for="ingredient in form.ingredients" :key="ingredient">    
                                <input solid v-model="ingredient.name" class="form-control mb-5">
                                <button @click.prevent="removeIngredient">X</button>
                            </div>

                            <v-button @click.prevent="addIngredient">+ Add ingredient</v-button>
                            <has-error :form="form" field="ingredients" />
                            
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="mb-6">Directions</h6>
                            <div class="d-flex gap-2 align-items-center" v-for="step in form.steps" :key="step">    
                                <input solid v-model="step.title" class="form-control mb-5">
                                <button @click.prevent="removeStep">X</button>
                            </div>
                            <v-button @click.prevent="addStep">+ Add step</v-button>
                            <has-error :form="form" field="steps" />
            
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Prep time</label>
                            <input solid v-model="form.prep_time" :class="{ 'is-invalid': form.errors.has('prep_time') }" class="form-control" name="prep_time" type="number">
                            <has-error :form="form" field="prep_time" />
            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-5">
                            <input solid v-model="form.prep_time" :class="{ 'is-invalid': form.errors.has('prep_time') }" class="form-control" name="prep_time" type="number">
                            <has-error :form="form" field="prep_time" />
            
                        </div>
                    </div>
                    
                </div>
                
                <v-button class="" large :loading="form.busy">Save</v-button>
            </form>


        </card>
    </div>
</template>


<script setup>

import { onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import Form from 'vform'
import { useRecipesStore } from '../../store/modules/recipes'
import { ref, reactive } from 'vue'
import axios from '../../plugins/axios';

const route = useRoute();
const router = useRouter();
const store = useRecipesStore();

const form = reactive( new Form({
  title: '',
  description: '',
  thumbnail: '',
  ingredients: [{}, {}, {}],
  steps: [{}, {}, {}],

}));


const id = route.params.id;

const saveRecipe = async () => {
    if (id) {

        const { data } = await form.patch('/recipes/' + id, form)


    } else {
        
        const data  = await form.post('/recipes')

        console.log(data);
        
        // store.dispatch('createRecipe', recipe).then(() => {
        //     router.push('/');
        // });
    }
};

onMounted(() => {
    if (id) {
        form.get(`/api/recipes/${id}`).then((response) => {
            Object.assign(form, response.data);
        });
    }
});

const addStep = () => {
    form.steps.push({});
}

const removeStep = (index) => {
    form.steps.splice(index, 1);
}

const addIngredient = () => {
    form.ingredients.push({});
}   

const removeIngredient = (index) => {
    form.ingredients.splice(index, 1);
}

</script>