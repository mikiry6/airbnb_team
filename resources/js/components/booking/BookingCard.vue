<template>
  <div class="bg-white border border-[#E2E8F0] rounded-3xl p-8 shadow-lg">

    <slot name="title">
      <h2 class="text-2xl font-bold mb-6">Book Your Stay</h2>
    </slot>

    <slot name="form">
      <div class="space-y-4">

        <input
          class="w-full border border-[#E2E8F0] rounded-xl px-4 py-3"
          placeholder="Destination"
        />

        <div class="grid grid-cols-2 gap-4">
          <input type="date" class="border border-[#E2E8F0] rounded-xl px-4 py-3" />
          <input type="date" class="border border-[#E2E8F0] rounded-xl px-4 py-3" />
        </div>

        <input
          class="w-full border border-[#E2E8F0] rounded-xl px-4 py-3"
          placeholder="Guests"
        />

      </div>
    </slot>

    <slot name="button">
      <button class="w-full mt-6 bg-[#3B82F6] text-white py-4 rounded-xl font-semibold">
        Confirm Booking
      </button>
    </slot>

  </div>
</template>