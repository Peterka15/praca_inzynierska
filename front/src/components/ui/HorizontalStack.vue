<template>
  <div :class="['d-flex', justifyClass, 'gap-3']">
    <slot/>
  </div>
</template>

<script>
export default {
  name: 'HorizontalStack',
  props: {
    start: Boolean
  },
  computed: {
    justifyClass () {
      return this.start ? 'justify-content-start' : 'justify-content-end';
    }
  }
};
</script>
