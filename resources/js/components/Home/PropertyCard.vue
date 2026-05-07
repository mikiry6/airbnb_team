<template>
  <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl hover:-translate-y-2 transition border border-[#E2E8F0]">

    <!-- IMAGE -->
    <div class="relative">
      <slot name="image">
        <img
          src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=1200&auto=format&fit=crop"
          class="h-64 w-full object-cover"
        />
      </slot>

      <button class="absolute top-4 right-4 bg-white/90 px-3 py-2 rounded-full shadow">
        ❤
      </button>
    </div>

    <div class="p-5">

      <div class="flex justify-between items-center mb-2">

        <slot name="title">
          <h3 class="font-bold text-lg">Modern Beach House</h3>
        </slot>

        <slot name="rating">
          <span class="text-[#3B82F6] font-semibold">★ 4.9</span>
        </slot>

      </div>

      <slot name="location">
        <p class="text-[#64748B] text-sm mb-4">Miami, United States</p>
      </slot>

      <div class="flex justify-between items-center">

        <slot name="price">
          <div>
            <span class="font-bold text-xl">$240</span>
            <span class="text-[#64748B] text-sm"> / night</span>
          </div>
        </slot>

        <slot name="action">
          <button class="bg-[#3B82F6] text-white px-4 py-2 rounded-xl">
            Reserve
          </button>
        </slot>

      </div>

    </div>

  </div>
</template>