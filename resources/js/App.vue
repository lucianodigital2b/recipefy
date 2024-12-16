<template>
  <component :is="this.$route.meta.layoutComponent">
      <router-view />
  </component>
</template>

