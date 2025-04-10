<template>
  <HorizontalStack class="align-items-center">
    <div class="text-right">
      <h6 class="m-0">{{ username }}</h6>
      <p class="m-0 text-secondary">{{
          new Date(date).toLocaleString(
              'pl-PL',
              {
                hour: '2-digit',
                minute: '2-digit',
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
              }
          )
        }}</p>
    </div>
    <b-avatar :variant="variant" :text="username.slice(0, 2)"></b-avatar>
  </HorizontalStack>
</template>
<script>
import HorizontalStack from '@/components/ui/HorizontalStack.vue';

export default {
  name: 'UserSignature',
  components: { HorizontalStack },

  props: {
    username: String,
    date: Date,
    variant: {
      type: String,
      default: 'primary'
    }
  }
};
</script>
