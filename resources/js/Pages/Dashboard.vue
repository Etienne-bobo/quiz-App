<template>
<v-app>
<AppLayout />
<Stats />
</v-app>
</template>

<script>
import AppLayout from "../Layouts/AppLayout"
import Stats from "../components/Statistics/stats"
export default {
  name: "Dashboard",
  components: {
    AppLayout,
    Stats
  },
};
</script>
