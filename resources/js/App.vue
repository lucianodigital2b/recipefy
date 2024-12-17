<template>
  <component :is="this.$route.meta.layoutComponent">
      <router-view />
  </component>
</template>

<script setup>

import { useRouter } from "vue-router";
import { globalRouter } from "./router/globalRouter";

const router = useRouter();
globalRouter.router = router;

</script>