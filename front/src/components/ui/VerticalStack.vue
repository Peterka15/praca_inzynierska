<template>
  <div :class="['d-flex', 'flex-column', justifyClass, gapClass]">
    <slot/>
  </div>
</template>

<script>
export default {
  name: 'VerticalStack',
  props: {
    start: Boolean,
    wideGaps: Boolean
  },
  computed: {
    justifyClass () {
      return this.start ? 'justify-content-start' : 'justify-content-end';
    },

    gapClass () {
      return this.wideGaps ? 'gap-4_5' : 'gap-3';
    }
  }
};
</script>
