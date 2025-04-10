<script>
export default {
  props: ['comment']
};
</script>

<template>
  <div class="comment">
    <p class="commentator_name">{{ this.comment.author }}</p>
    <p class="comment_text">{{ this.comment.content }}</p>
  </div>
</template>
