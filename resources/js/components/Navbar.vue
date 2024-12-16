<template>
  <nav class="navbar navbar-expand-lg shadow-none border-bottom">
  <div class="container">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <router-link :to="{ name: 'dashboard' }" class="navbar-brand me-auto">Recipefy</router-link>

      <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link :to="{ name: 'dashboard' }" class="nav-link" active-class="active">Home</router-link>
        </li>
      </ul> -->

      <form class="d-flex " role="search">
        <input class="rounded-pill search rounded-pill border-none" type="search" placeholder="Search" aria-label="Search">
        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
      </form>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
        <li>
          <v-button @click="router.push({ name: 'login' })" class="rounded-3">New Recipe</v-button>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link ml-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img :src="user.photo_url ?? 'https://mdbcdn.b-cdn.net/img/new/avatars/2.webp'" class="rounded-circle profile-photo me-1">
            </a>
            <ul class="dropdown-menu shadow-sm">
              <!-- <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li> -->
              <li><router-link @click.prevent="logout" class="nav-link">Favorites</router-link></li>
              <li><router-link @click.prevent="logout" class="nav-link">Add a recipe</router-link></li>
              <li><hr class="dropdown-divider"></li>
              <li><router-link @click.prevent="logout" class="nav-link">Logout</router-link></li>
            </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>
</template>

<script setup>
  import { useAuthStore } from '../store/modules/auth'
  import { storeToRefs } from 'pinia'
  import { useRouter } from 'vue-router';
  import { PlusIcon } from '@heroicons/vue/24/solid'

  const store = useAuthStore()
  const router = useRouter()
  const { user } = storeToRefs(store)

  const logout = () => {
    store.logout()
    router.push({ name: '/login' })
  }
</script>

<style scoped>
  .profile-photo {
    width: 2rem;
    height: 2rem;
    margin: -.375rem 0;
  }

  /* .container {
    max-width: 1100px;
  } */

  .search {
    position: relative;
    min-width: 200px;
    width: 516px;
    padding: 10px 30px;
    background: #F7F8FC;
  }

  .navbar-expand-lg .navbar-nav .dropdown-menu {
    border-radius: .5rem;
  }

  .dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 0; /* remove the gap so it doesn't close */
  }
</style>
