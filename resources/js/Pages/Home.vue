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
          <p class="mb-6">
            Vous pouvez créer un compte afin de partager et informer la communauté des activités sportives adaptées que vous organisez. Contribuez à rendre le sport accessible à tous !
          </p>
        </section>

        <section aria-labelledby="featured-activities-heading" class="mt-8">
          <h3 id="featured-activities-heading" class="text-xl font-semibold mb-4">Activités à venir</h3>

          <div v-if="activities.data.length > 0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              <div v-for="activity in activities.data" :key="activity.id"
                   class="bg-white shadow rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow"
                   tabindex="0">
                <div class="p-5">
                  <h4 class="font-bold text-lg mb-2">{{ activity.name }}</h4>
                  <p class="text-gray-600 mb-4 line-clamp-3">{{ truncate(activity.description, 150) }}</p>

                  <ActivityDateTime :activity="activity" compact />

                  <div class="flex items-center text-sm text-gray-700 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>{{ activity.location }}</span>
                  </div>

                  <div class="mt-4 text-right">
                    <Link :href="route('activities.show', activity.id)"
                          class="text-indigo-600 hover:text-indigo-800 text-sm font-medium focus:outline-none focus:underline"
                          aria-label="Voir les détails de l'activité">
                      Voir les détails
                    </Link>
                  </div>
                </div>
              </div>
            </div>

            <Pagination
              :current-page="activities.current_page"
              :last-page="activities.last_page"
              :prev-page-url="activities.prev_page_url"
              :next-page-url="activities.next_page_url"
            />
          </div>
          <p v-else class="text-gray-600 italic">
            Aucune activité n'est disponible pour le moment.
          </p>
        </section>
      </div>
    </AccessibleLayout>
  </template>

  <script setup>
  import AccessibleLayout from '@/Layouts/AccessibleLayout.vue';
  import { Head, Link } from '@inertiajs/vue3';
  import { useActivity } from '@/composables/useActivity';
  import ActivityDateTime from '@/Components/ActivityDateTime.vue';
  import Pagination from '@/Components/Pagination.vue';

  const props = defineProps({
    activities: Object
  });

  const { truncate } = useActivity();
  </script>
