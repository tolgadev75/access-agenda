<template>
    <Head title="Accueil - Access-agenda" />
    <AccessibleLayout>
      <div>
        <h2 class="text-2xl font-bold mb-6" tabindex="-1">Activités sportives accessibles</h2>

        <section aria-labelledby="introduction-heading">
          <h3 id="introduction-heading" class="text-xl font-semibold mb-4">Bienvenue sur Access-agenda</h3>
          <p class="mb-4">
            Découvrez des activités sportives adaptées et accessibles. Ce site est conçu pour être
            entièrement utilisable au clavier et compatible avec les technologies d'assistance.
          </p>
          <p class="mb-6">
            Notre mission est de faciliter l'accès au sport pour tous.
          </p>
        </section>

        <section aria-labelledby="featured-activities-heading" class="mt-8">
          <h3 id="featured-activities-heading" class="text-xl font-semibold mb-4">Activités à venir</h3>
          <p class="text-gray-600 italic">
            La liste des activités sera bientôt disponible. Revenez nous voir prochainement.
          </p>
        </section>
      </div>
    </AccessibleLayout>
  </template>

  <script setup>
  import AccessibleLayout from '@/Layouts/AccessibleLayout.vue';
  import { Head } from '@inertiajs/vue3';
  </script>
