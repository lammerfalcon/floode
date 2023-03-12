<template>
  <div class="h-full">
    <layout-header></layout-header>
    <div class="flex m-3 gap-3 flex-shrink h-[calc(100%-76px)]">
      <layout-aside class="sticky top-[68px] self-start"></layout-aside>
      <div class="rounded-md overflow-hidden">
        <slot class="h-full" />
      </div>
    </div>
  </div>
</template>
