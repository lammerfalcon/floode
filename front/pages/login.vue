<script setup lang="ts">
// const { status, data, signIn, signOut } = useSession();
// status.value; // Session status: `unauthenticated`, `loading`, `authenticated`
// data.value; // Session data, e.g., expiration, user.email, ...
// await signIn(); // Sign in the user
// await signOut();
// definePageMeta({
//   layout: "custom",
// });
const doAuth = () => {
  // router.push("/");
};
const params =
  "client_id=j2pdx4a8mydwdzbn48f3536ktgn72i&redirect_uri=http://localhost:3000/alerts&response_type=token&scope=user:read:email";
const router = useRouter();
</script>
<template>
  <div class="flex gap-5 cursor-pointer" @click="doAuth()">
    <div
      class="flex items-center justify-center w-28 h-28 bg-floode-lighten transform rotate-45"
    >
      <div
        class="w-28 h-28 transition-all duration-500 bg-gradient-to-tl from-floode-secondary-100 via-floode-primary-500 to-floode-secondary-300 bg-size-200 bg-pos-0 hover:bg-pos-100"
      ></div>
    </div>
    <span class="mt-5">Floode</span>
    <a :href="`https://id.twitch.tv/oauth2/authorize?${params}`"
      >Connect with Twitch</a
    >
  </div>
</template>
