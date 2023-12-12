<template>
  <div class="card">
    <slot name="default"></slot>
    <div v-if="$slots.header" class="card-header fw-bold">
      <slot name="header"></slot>
    </div>
    <slot name="overlay"></slot>
    <slot name="imgTop"></slot>
    <div v-if="!$slots.default" class="card-body position-relative">
      <div>
        <h6
          v-if="$slots.title"
          class="card-title mb-1"
          :class="{ 'text-white': textWhite }"
        >
          <slot name="title"></slot>
        </h6>
        <p
          v-if="$slots.subTitle"
          class="card-sub-title"
          :class="{ 'text-white': textWhite }"
        >
          <slot name="subTitle"></slot>
        </p>
        <slot name="body"></slot>
      </div>
    </div>

    <slot name="imgBottom"></slot>
    <div
      v-if="$slots.footer"
      class="card-footer"
      :class="{ 'border-top-0': noBorderTop }"
    >
      <slot name="footer"></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: {
    textWhite: Boolean,
    noBorderTop: Boolean,
  },
};
</script>
