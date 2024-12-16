import { createRouter, createWebHistory } from 'vue-router';
import Login from '../pages/auth/login.vue';
import Register from '../pages/auth/register.vue';
import Dashboard from '../pages/dashboard.vue';
import { useAuthStore } from '../store/modules/auth'
import RecipeForm from '../pages/recipes/RecipeForm.vue';

const routes = [
    { path: '/', component: Login, name: 'login', meta: { layout: 'basic' } },  
    { path: '/login', component: Login, name: 'login', meta: { layout: 'basic' } },  
    { path: '/register', component: Register, name: 'register', meta: { layout: 'basic' } },
    { path: '/dashboard', component: Dashboard, name: 'dashboard', meta: { layout: 'default' } },
    { path: '/recipes/:id', component: RecipeForm, props: true, meta: { layout: 'default' } },
    { path: '/recipes/create', component: RecipeForm, meta: { layout: 'default' } },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


router.beforeEach(loadLayoutMiddleware)

async function loadLayoutMiddleware(route, from) {

    
    try {
        let layout = route.meta.layout;
        let layoutComponent = await import(`/resources/js/layouts/${layout}.vue`)

        route.meta.layoutComponent = layoutComponent.default
    } catch (e) {
        console.error('Error occurred in processing of layouts: ', e)
        let layout = 'basic'
        let layoutComponent = await import(`/resources/js/layouts/${layout}.vue`)
        
        route.meta.layoutComponent = layoutComponent.default
    }


}


// router.afterEach(afterEach)

export default router;
