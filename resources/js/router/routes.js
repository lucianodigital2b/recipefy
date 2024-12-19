
 function page (path) {
  return async () => await import(`/resources/js/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', component: page('Dashboard.vue'), name: '/', meta: { layout: 'default' } },  
  { path: '/dashboard', component: page('Dashboard.vue'), name: 'dashboard', meta: { layout: 'default' } },  
  { path: '/login', component: page('auth/Login.vue'), name: 'login', meta: { layout: 'basic' } },  
  { path: '/register', component: page('auth/Register.vue'), name: 'register', meta: { layout: 'basic' } },
  { path: '/recipes/create', component: page('recipes/RecipeForm.vue'), name: 'recipes.create', meta: { layout: 'default' } },
  { path: '/recipes/:id/edit', component: page('recipes/RecipeForm.vue'), name: 'recipes.edit', meta: { layout: 'default' } },
  { path: '/recipes/:slug', component: page('recipes/RecipeShow.vue'), name: 'recipes.show', meta: { layout: 'default' } },
  // { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  // { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  // { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  // { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },
  // {
  //   path: '/settings',
  //   component: page('settings/index.vue'),
  //   children: [
  //     { path: '', redirect: { name: 'settings.profile' } },
  //     { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
  //     { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
  //   ]
  // },

  { path: '/:pathMatch(.*)*', component: page('errors/404.vue'), meta: { layout: 'default' } }
]
