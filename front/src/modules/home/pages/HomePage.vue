<template>
  <BaseTemplate>
      <p>
          Salut je suis la homme page

      </p>
      <h2>{{ $t("test") }}</h2>
      <button class="app-btn"/>
  </BaseTemplate>
</template>

<script lang="ts" setup>
import BaseTemplate from '@/modules/shared/Pages/BaseTemplate.vue'
import FetcherService from '@/modules/shared/services/FetcherService'

FetcherService.get()
    .path('/api/v2/shop/products')
    .method('get')
    .create()({})
    .then((response) => {
        // console.log(response)
        console.log(response.data[0].mainTaxon)
        return response
    })

</script>
