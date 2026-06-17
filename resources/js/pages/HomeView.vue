<script setup>
import Navbar from '@/components/layout/Navbar.vue'
import HeroSection from '@/components/home/HeroSection.vue'
import PropertyCard from '@/components/home/PropertyCard.vue'
import BookingCard from '@/components/booking/BookingCard.vue'
import Footer from '@/components/layout/Footer.vue'
</script>

<template>
  <div class="bg-[#F8FAFC] min-h-screen">

    <Navbar />

    <HeroSection />

    <section class="px-8 py-10">
      <div class="max-w-6xl mx-auto grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <PropertyCard />
        <PropertyCard />
        <PropertyCard />
      </div>
    </section>

    <section class="max-w-3xl mx-auto px-8 py-20">
      <BookingCard />
    </section>

    <Footer />

  </div>
</template>