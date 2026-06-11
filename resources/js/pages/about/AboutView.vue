<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-50 via-white to-slate-100 overflow-hidden">

    <!-- HERO -->
    <section class="relative px-6 pt-24 pb-20">

      <div class="absolute top-0 left-0 w-72 h-72 bg-blue-200 rounded-full blur-3xl opacity-30"></div>
      <div class="absolute bottom-0 right-0 w-72 h-72 bg-slate-300 rounded-full blur-3xl opacity-20"></div>

      <div class="relative z-10 max-w-6xl mx-auto grid lg:grid-cols-2 gap-14 items-center">

        <!-- TEXT -->
        <div class="animate-left">
          <p class="text-blue-600 font-semibold mb-3 tracking-wide">
            ABOUT US
          </p>

          <h1 class="text-5xl lg:text-6xl font-bold text-slate-800 leading-tight">
            Des expériences uniques,
            partout dans le monde.
          </h1>

          <p class="mt-6 text-slate-500 text-lg leading-relaxed">
            Notre plateforme aide les voyageurs à découvrir des logements
            exceptionnels et permet aux hôtes de partager leurs espaces
            simplement et en toute confiance.
          </p>

          <button class="mt-8 bg-blue-500 hover:bg-blue-600 transition text-white px-7 py-3 rounded-xl shadow-lg hover:shadow-xl">
            Explorer
          </button>
        </div>

        <!-- CARD -->
        <div class="relative animate-right">

          <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-2xl rounded-[40px] p-8">

            <div class="grid grid-cols-2 gap-5">

              <div class="card">
                <h2>10K+</h2>
                <p>Voyageurs satisfaits</p>
              </div>

              <div class="card blue">
                <h2>500+</h2>
                <p>Logements disponibles</p>
              </div>

              <div class="card blue">
                <h2>24/7</h2>
                <p>Support client</p>
              </div>

              <div class="card">
                <h2>50+</h2>
                <p>Villes couvertes</p>
              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

    <!-- VALUES -->
    <section class="max-w-6xl mx-auto px-6 py-20">

      <div class="text-center mb-14">
        <h2 class="text-4xl font-bold text-slate-800">
          Pourquoi nous choisir ?
        </h2>

        <p class="text-slate-500 mt-3">
          Une expérience moderne, fluide et sécurisée.
        </p>
      </div>

      <div class="grid md:grid-cols-3 gap-8">

        <div class="value-card">
          <div class="icon">🌍</div>
          <h3>Voyage simplifié</h3>
          <p>
            Réservez facilement des logements partout dans le monde.
          </p>
        </div>

        <div class="value-card">
          <div class="icon">🔒</div>
          <h3>Sécurité</h3>
          <p>
            Paiements et réservations sécurisés pour tous les utilisateurs.
          </p>
        </div>

        <div class="value-card">
          <div class="icon">⚡</div>
          <h3>Rapidité</h3>
          <p>
            Une plateforme rapide avec une expérience utilisateur moderne.
          </p>
        </div>

      </div>

    </section>

  </div>
</template>

<style scoped>
.card {
  background: #f8fafc;
  padding: 25px;
  border-radius: 24px;
  transition: 0.3s;
}

.card:hover {
  transform: translateY(-4px);
}

.card h2 {
  font-size: 32px;
  font-weight: bold;
  color: #1e293b;
}

.card p {
  color: #64748b;
  margin-top: 8px;
}

.blue {
  background: #dbeafe;
}

.value-card {
  background: white;
  padding: 30px;
  border-radius: 28px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  transition: 0.3s;
}

.value-card:hover {
  transform: translateY(-6px);
}

.value-card h3 {
  margin-top: 15px;
  font-size: 22px;
  font-weight: bold;
  color: #1e293b;
}

.value-card p {
  margin-top: 10px;
  color: #64748b;
  line-height: 1.6;
}

.icon {
  width: 65px;
  height: 65px;
  border-radius: 20px;
  background: #eff6ff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
}

@keyframes left {
  from {
    opacity: 0;
    transform: translateX(-40px);
  }

  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes right {
  from {
    opacity: 0;
    transform: translateX(40px);
  }

  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.animate-left {
  animation: left 0.8s ease;
}

.animate-right {
  animation: right 0.8s ease;
}
</style>