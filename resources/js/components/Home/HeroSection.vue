<template>
  <section class="bg-[#EFF6FF] px-8 py-20">

    <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-12 items-center">

      <div>

        <slot name="badge">
          <p class="text-[#3B82F6] uppercase font-semibold mb-4">
            Modern Travel Experience
          </p>
        </slot>

        <slot name="title">
          <h1 class="text-5xl font-bold mb-6">
            Find the perfect place for your next vacation.
          </h1>
        </slot>

        <slot name="description">
          <p class="text-[#64748B] text-lg mb-8">
            Discover beautiful stays and modern booking made simple.
          </p>
        </slot>

        <slot name="actions">
          <div class="flex gap-4">
            <button class="bg-[#3B82F6] text-white px-6 py-3 rounded-xl font-semibold">
              Explore
            </button>
          </div>
        </slot>

      </div>

      <div class="bg-white rounded-3xl p-6 shadow-xl border border-[#E2E8F0]">
        <slot name="image">
          <img
            src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=1200&auto=format&fit=crop"
            class="rounded-2xl h-[400px] w-full object-cover"
          />
        </slot>
      </div>

    </div>

  </section>
</template>