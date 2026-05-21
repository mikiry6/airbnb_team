<template>
  <nav class="bg-white border-b border-[#E2E8F0] px-8 py-5 flex justify-between items-center sticky top-0 z-50">

    <!-- LOGO SLOT -->
    <div class="text-2xl font-bold text-[#3B82F6]">
      <slot name="logo">StayEase</slot>
    </div>

    <!-- SEARCH SLOT -->
    <div class="hidden md:flex items-center gap-3 bg-[#EFF6FF] border border-[#DBEAFE] px-4 py-2 rounded-full w-[420px]">
      <slot name="search">
        <input
          type="text"
          placeholder="Where are you going?"
          class="bg-transparent outline-none flex-1 text-sm"
        />
      </slot>

      <button class="bg-[#3B82F6] hover:bg-[#2563EB] transition text-white px-4 py-2 rounded-full text-sm">
        Search
      </button>
    </div>

    <!-- ACTIONS SLOT -->
    <div>
      <slot name="actions">
        <button class="bg-[#3B82F6] hover:bg-[#2563EB] transition text-white px-5 py-2 rounded-xl">
          Login
        </button>
      </slot>
    </div>

  </nav>
</template>