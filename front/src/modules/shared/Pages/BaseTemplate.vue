<template>
  <div class="base-template">
    <header>
      <nav class="flex items-center justify-between flex-wrap lg:px-12 bg-white wrapper">
        <RouterLink v-for="(pageName, key) in PageList" :key="key" :to="{name: pageName}">
          {{ key }}
        </RouterLink>
      </nav>
    </header>

    <main class="mt-5 w-1/2 wrapper m-auto">
      <slot/>
    </main>
  </div>
</template>

<script lang="ts" setup>
import {useHead} from '@vueuse/head'
import {PageList} from '@/router'

const props = defineProps({
  title: {
    required: false,
    type: String,
    default: '',
  }
})

useHead({
  title: props.title,
  meta: [
    {
      property: 'og:title',
      content: props.title,
    },
    {
      name: 'twitter:title',
      content: props.title,
    },
  ],
  link: [
    {
      rel: 'icon',
      href: 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1184px-Vue.js_Logo_2.svg.png',
      type: '16x16'
    },
    {
      rel: 'icon',
      href: 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1184px-Vue.js_Logo_2.svg.png',
      type: '32x32'
    },
    {
      rel: 'shortcut icon',
      href: 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1184px-Vue.js_Logo_2.svg.png'
    },
    {
      rel: 'apple-touch-icon',
      href: 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1184px-Vue.js_Logo_2.svg.png'
    }
  ]
})

</script>

<style lang="scss" scoped>
.base-template {
  min-height: 100vh;
}
</style>
