<template> <!-- ToolTip.vue -->
  <div class="tooltip" v-show="show" :style="{ left: `${x}px`, top: `${y}px` }">
    {{ content }}
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  props: {
    content: {
      type: String,
      required: true,
    },
  },
  setup() {
    const show = ref(false);
    const x = ref(0);
    const y = ref(0);

    const handleMouseEnter = (e) => {
      show.value = true;
      x.value = e.clientX;
      y.value = e.clientY;
    };

    const handleMouseLeave = () => {
      show.value = false;
    };

    return {
      show,
      x,
      y,
      handleMouseEnter,
      handleMouseLeave,
    };
  },
};
</script>

<style scoped>
.tooltip {
  position: fixed;
  border: 1px solid #333;
  background-color: #161616;
  color: #fff;
  padding: 5px 10px;
  border-radius: 5px;
  z-index: 10000;
}
</style>
