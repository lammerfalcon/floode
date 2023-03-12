<template>
  <div class="sticky top-0 w-full">
    <div
      class="px-5 flex gap-5 items-center h-14 bg-gradient-to-r from-floode-primary-500 to-floode-primary-200 text-floode-lighten"
    >
      <div
        class="flex items-center justify-center w-8 h-8 bg-floode-lighten transform rotate-45"
      >
        <div
          class="w-7 h-7 transition-all duration-500 bg-gradient-to-tl from-floode-secondary-100 via-floode-primary-500 to-floode-secondary-300 bg-size-200 bg-pos-0 hover:bg-pos-100"
        ></div>
      </div>
      <span>Floode</span>
      <span>|</span>
      <NuxtLink to="posts">to posts</NuxtLink>
    </div>
  </div>
</template>
