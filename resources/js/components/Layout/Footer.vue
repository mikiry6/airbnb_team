<template>
  <footer class="bg-white border-t border-[#E2E8F0] px-8 py-8 mt-20">

    <div class="max-w-6xl mx-auto flex justify-between items-center">

      <div class="text-[#3B82F6] font-bold text-xl">
        <slot name="logo">StayEase</slot>
      </div>

      <slot name="links">
        <div class="flex gap-6 text-[#64748B] text-sm">
          <a href="#">About</a>
          <a href="#">Destinations</a>
          <a href="#">Support</a>
          <a href="#">Privacy</a>
        </div>
      </slot>

    </div>

  </footer>
</template>