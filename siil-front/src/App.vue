<template>
  <v-app id="app">
 <router-view/>
  </v-app>
</template>

<script>


export default {
  props: {
      source: String,
    },
  name: 'App',
  components: {}
};
</script>
