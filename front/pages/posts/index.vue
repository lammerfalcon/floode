<script setup lang="ts">
interface Post {
  name: string;
  description: string;
}
const posts = ref<Post[]>([
  { name: "post 1", description: "hello1" },
  { name: "post 2", description: "hello2" },
  { name: "post 3", description: "hello3" },
  { name: "post 4", description: "hello4" },
]);
</script>
<template>
  <div>
    <div v-for="(item, index) in posts" :key="item.name">
      <h1>{{ item.name }}</h1>
      <h1>{{ item.description }}</h1>
      <NuxtLink :to="`posts/${index}`">go to</NuxtLink>
    </div>
  </div>
</template>
