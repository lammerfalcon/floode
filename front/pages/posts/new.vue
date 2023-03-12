<script lang="ts" setup>
const inputs = ref([]);
const value = ref<string>("");
</script>
<template>
  <div>
    <button @click="inputs.push(value)">push</button>
    <textarea v-model="value"></textarea>
    <div v-for="area in inputs" :key="area.index">
      <h1 class="text-5xl">{{ area }}</h1>
    </div>
  </div>
</template>
