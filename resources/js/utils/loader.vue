<template>
    <v-sheet
        :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
        class="px-3 pt-3 pb-3"
    >
        <v-skeleton-loader
            class="mx-auto"
            max-width="100%"
            type="image, list-item,card-heading,list-item,card-heading,list-item, card-heading,actions"
        ></v-skeleton-loader>
    </v-sheet>
</template>
<script>
    export default {
        inject: ['theme'],
    }
</script>
