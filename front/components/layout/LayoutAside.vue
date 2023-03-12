<script lang="ts" setup>
import { HomeIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";
const nav = [
  {
    name: "home",
    icon: HomeIcon,
    route: "/",
  },
  {
    name: "Оповещения",
    icon: HomeIcon,
    route: "/alerts",
  },
];
const activeNav = ref("/");
</script>
<template>
  <div
    class="min-w-[260px] min-h-[50vh] w-[260px] bg-gradient-to-t from-floode-primary-500 bg-floode-secondary-100 rounded-xl"
  >
    <div
      class="fixed bottom-0 flex m-6 items-center justify-center h-18 w-18 bg-floode-lighten transform rotate-45"
    >
      <div
        class="w-16 h-16 transition-all duration-500 bg-gradient-to-tl from-floode-secondary-100 via-floode-primary-500 to-floode-secondary-300 bg-size-200 bg-pos-0 hover:bg-pos-100"
      ></div>
    </div>
    <ul class="flex flex-col justify-center items-start px-3 py-3 gap-3">
      <NuxtLink
        v-for="(link, index) in nav"
        :key="index"
        :class="link.route === activeNav ? 'bg-floode-lighten' : ''"
        class="text-floode-ocean-blue-900 flex gap-3 px-5 w-full py-2 border-2 hover:border-floode-ocean-blue-900 rounded-md border-transparent hover:cursor-pointer"
        :to="link.route"
        @click="activeNav = link.route"
      >
        <i>
          <component :is="link.icon" class="w-[24px]"></component>
        </i>
        <span>{{ link.name }}</span>
      </NuxtLink>
    </ul>
  </div>
</template>
