<template>
  <div class="space-y-5">

    <div class="bg-white rounded-2xl shadow p-6 border border-slate-100">
      <h2 class="text-2xl font-bold text-slate-800">
        Contact Info
      </h2>

      <p class="text-slate-500 mt-2">
        On répond généralement en moins de 24h
      </p>
    </div>

    <div class="info">
      📧 support@airbnbclone.com
    </div>

    <div class="info blue">
      📞 +261 34 00 000 00
    </div>

    <div class="info">
      📍 Antananarivo, Madagascar
    </div>

  </div>
</template>

<style scoped>
.info {
  background: #f8fafc;
  padding: 16px;
  border-radius: 12px;
  border: 1px solid #e2e8f0;
  transition: 0.2s;
}

.info:hover {
  transform: translateY(-2px);
}

.blue {
  background: #eff6ff;
}
</style>