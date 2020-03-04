<template>
    <div class="title-row">
        <div class="page-title">{{title}}</div>
        <div class="title-row__action">
            <slot class="slot-styles"></slot>
            <div class="">
                <q-tooltip style="width:100px">Go full screen!</q-tooltip>
                <q-btn
                    flat round dense
                    color="primary"
                    @click="$q.fullscreen.toggle()"
                    :icon="$q.fullscreen.isActive ? 'fullscreen_exit' : 'fullscreen'"
                />
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    props: ['title'],
    data() {
      return {}
    },
    methods: {},
    computed: {}
  }

</script>
<style scoped lang="scss">
    .title-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        width: 100%;

        .title-row__action {
            display: flex;
            align-items: center;
            align-content: center;
        }
    }

    .page-title {
        padding: .1rem 0;
        font-size: 2rem;
        font-weight: 900;
    }

    .slot-style {
        margin-bottom: 1.5rem;
        margin-right: 1rem;
        display: flex;

    }
</style>
