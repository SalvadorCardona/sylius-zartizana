<template>
  <div :class="{'loader-fixed': fullPage}" class="content">
    <div class="donut-spinner"/>
  </div>
</template>

<script lang="ts" setup>
defineProps({
  fullPage: {
    default: false,
    required: false,
    type: Boolean
  }
})
</script>

<style lang="scss">
.content {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-content: center;
  &.loader-fixed {
    align-items: center;
    background: rgba(255, 255, 255, 0.8);
    display: inline-flex;
    height: 100%;
    justify-content: center;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
  }

  .donut-spinner {
    animation: donut-spin 1.2s linear infinite;
    border: 4px solid hsl(222, 100%, 95%);
    border-left-color: var(--primary-color);
    border-radius: 50%;
    display: inline-block;
    height: 30px;
    width: 30px;
  }

  @keyframes donut-spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
}
</style>
