<template>
    <div class="centeredPage" v-if="loading">
      <q-spinner-puff color="deep-orange" size="5rem"/>
    </div>
    <div v-else class="centeredPage" v-else-if="!hasData">
      <div class="">{{noContentMessage}}</div>
      <slot></slot>
    </div>
</template>

<script>
  export default {
    props:['loading','noContentMessage','hasData'],
    data() {
      return {}
    },
    methods: {},
    computed: {}
  }

</script>
<style lang="scss">

</style>