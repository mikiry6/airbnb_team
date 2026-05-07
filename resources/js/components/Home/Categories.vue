
<script setup>
const categories = [
  'Beach',
  'Luxury',
  'Cabin',
  'Pool',
  'Mountain',
  'City',
  'Island'
]
</script>

<template>
  <section class="px-8 py-10">

    <div class="max-w-6xl mx-auto flex flex-wrap gap-4 items-center">

      <slot name="title">
        <h2 class="text-xl font-bold text-[#0F172A] mr-4">
          Explore categories
        </h2>
      </slot>

      <slot name="items">
        <button
          v-for="category in categories"
          :key="category"
          class="bg-white border border-[#E2E8F0] hover:bg-[#EFF6FF] hover:border-[#3B82F6] transition px-5 py-3 rounded-2xl text-sm font-medium"
        >
          {{ category }}
        </button>
      </slot>

    </div>

  </section>
</template>
