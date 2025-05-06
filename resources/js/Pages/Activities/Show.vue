<template>
    <Head :title="activity.name + ' - Access-agenda'" />
    <AccessibleLayout>
      <div>
        <div class="mb-6">
          <Link :href="route('home')" class="text-indigo-600 hover:text-indigo-800 inline-flex items-center focus:outline-none focus:underline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Retour aux activités
          </Link>
        </div>

        <article class="bg-white rounded-lg shadow-md p-6">
          <header>
            <h2 class="text-3xl font-bold mb-2" tabindex="-1">{{ activity.name }}</h2>
            <p class="text-gray-600 text-lg">{{ activity.sport_type }}</p>
          </header>

          <div v-if="activity.link" class="mt-2">
            <a :href="activity.link" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 focus:outline-none focus:underline">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
              </svg>
              Voir le lien de l'activité
            </a>
          </div>

          <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
              <section aria-labelledby="details-heading">
                <h3 id="details-heading" class="text-xl font-semibold mb-4">Détails de l'activité</h3>
                <div class="prose max-w-none">
                  <p>{{ activity.description }}</p>
                </div>
              </section>

              <section aria-labelledby="accessibility-heading" class="mt-8">
                <h3 id="accessibility-heading" class="text-xl font-semibold mb-4">Accessibilité</h3>
                <AccessibilityBadges :activity="activity" />

                <div v-if="activity.accessibility_details" class="mt-4">
                  <h4 class="font-medium mb-2">Détails supplémentaires sur l'accessibilité :</h4>
                  <p>{{ activity.accessibility_details }}</p>
                </div>
              </section>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
              <section aria-labelledby="info-heading">
                <h3 id="info-heading" class="text-xl font-semibold mb-4">Informations pratiques</h3>

                <ActivityDateTime :activity="activity" full-date />

                <div class="mt-4">
                  <h4 class="font-medium text-gray-700 mb-1">Lieu</h4>
                  <p class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ activity.location }}
                  </p>
                </div>

                <div class="pt-4 border-t border-gray-200 mt-4">
                  <h4 class="font-medium text-gray-700 mb-1">Contact</h4>
                  <p v-if="activity.contact_email" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <a :href="'mailto:' + activity.contact_email" class="text-indigo-600 hover:text-indigo-800 focus:outline-none focus:underline">
                      {{ activity.contact_email }}
                    </a>
                  </p>
                  <p v-if="activity.contact_phone" class="flex items-center mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                  <a :href="'tel:' + activity.contact_phone" class="text-indigo-600 hover:text-indigo-800 focus:outline-none focus:underline">
                    {{ activity.contact_phone }}
                  </a>
                </p>
              </div>
            </section>
          </div>
        </div>
      </article>
    </div>
  </AccessibleLayout>
</template>

<script setup>
import AccessibleLayout from '@/Layouts/AccessibleLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import AccessibilityBadges from '@/Components/AccessibilityBadges.vue';
import ActivityDateTime from '@/Components/ActivityDateTime.vue';

const props = defineProps({
  activity: Object
});
</script>
