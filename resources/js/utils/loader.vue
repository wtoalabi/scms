<template>
    <div class="loading-backdrop">
        <q-spinner-puff color="deep-orange-8" :size="maxSize"/>
    </div>
</template>
<style lang="scss">
    .loading-backdrop {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
    }
</style>

<script>
  export default {
    props: ['size'],
    computed:{
      maxSize(){
        return this.size ? this.size : '6rem';
      }
    }
  }
</script>
