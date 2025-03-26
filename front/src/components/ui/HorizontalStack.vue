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
    justifyClass() {
      if (this.start) 
        return 'justify-content-start';
      
      return 'justify-content-end';
    }
  }
}
</script>
