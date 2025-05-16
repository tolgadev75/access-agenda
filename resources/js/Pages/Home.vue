<template>
    <Head title="Accueil - Access-agenda" />
    <AccessibleLayout>
      <div class="space-y-12">
        <section class="bg-gradient-to-r from-indigo-500 to-purple-600 -mx-6 p-8 rounded-lg text-white">
          <div class="max-w-3xl">
            <h2 class="text-3xl font-bold mb-4" tabindex="-1">Activités sportives accessibles</h2>
            <p class="text-lg opacity-90 mb-6">
              Découvrez des activités sportives adaptées et accessibles. Notre plateforme est conçue pour être
              entièrement utilisable au clavier et compatible avec les technologies d'assistance.
            </p>
            <div class="flex flex-wrap gap-4">
              <Link
                :href="route('register')"
                class="inline-flex items-center px-6 py-3 bg-white text-indigo-700 rounded-full font-medium text-sm shadow-lg hover:shadow-xl transition-all focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-500"
              >
                Rejoindre la communauté
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
              </Link>
              <Link
                :href="'#featured-activities'"
                class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white border border-indigo-300 border-opacity-30 rounded-full font-medium text-sm shadow hover:bg-indigo-700 transition-all focus:outline-none focus:ring-2 focus:ring-white"
              >
                Voir les activités
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </Link>
            </div>
          </div>
        </section>

        <section aria-labelledby="introduction-heading" class="bg-white p-8 rounded-lg shadow-sm">
          <h3 id="introduction-heading" class="text-2xl font-semibold mb-6 text-gray-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Bienvenue sur Access-agenda
          </h3>

          <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-indigo-50 p-6 rounded-lg">
              <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </div>
              <h4 class="text-lg font-medium text-gray-800 mb-2">Communauté inclusive</h4>
              <p class="text-gray-600">
                Rejoignez une communauté dynamique dédiée à rendre le sport accessible à tous, quelles que soient vos capacités.
              </p>
            </div>

            <div class="bg-indigo-50 p-6 rounded-lg">
              <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
              </div>
              <h4 class="text-lg font-medium text-gray-800 mb-2">Accessibilité totale</h4>
              <p class="text-gray-600">
                Notre plateforme est conçue pour être entièrement accessible au clavier et compatible avec les technologies d'assistance.
              </p>
            </div>

            <div class="bg-indigo-50 p-6 rounded-lg">
              <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                </svg>
              </div>
              <h4 class="text-lg font-medium text-gray-800 mb-2">Partagez vos événements</h4>
              <p class="text-gray-600">
                Créez un compte pour partager et informer la communauté des activités sportives adaptées que vous organisez.
              </p>
            </div>
          </div>
        </section>

        <section aria-labelledby="filters-heading" class="bg-white p-6 rounded-lg shadow-sm">
          <h3 id="filters-heading" class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            Filtrer les activités
          </h3>

          <div class="space-y-6">
            <div>
              <h4 class="font-medium text-gray-700 mb-2">Par mois</h4>
              <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2">
                <button
                  v-for="(month, index) in months"
                  :key="index"
                  @click="toggleMonthFilter(index)"
                  :class="[
                    'py-2 px-3 rounded-lg text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1',
                    filters.months.includes(index)
                      ? 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'
                      : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                  ]"
                >
                  {{ month }}
                </button>
              </div>
            </div>

            <div>
              <h4 class="font-medium text-gray-700 mb-2">Par accessibilité</h4>
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex items-center space-x-3">
                  <input
                    type="checkbox"
                    id="mobility-filter"
                    v-model="filters.accessibility.mobility"
                    class="w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500"
                    aria-describedby="mobility-label"
                    tabindex="0" @keydown.enter="filters.accessibility.mobility = !filters.accessibility.mobility"
                  />
                  <label id="mobility-label" for="mobility-filter" class="text-gray-700 cursor-pointer" tabindex="0" @keydown.enter="filters.accessibility.mobility = !filters.accessibility.mobility">
                    <span class="flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                      </svg>
                      Mobilité réduite
                    </span>
                  </label>
                </div>

                <div class="flex items-center space-x-3">
                  <input
                    type="checkbox"
                    id="vision-filter"
                    v-model="filters.accessibility.vision"
                    class="w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500"
                    aria-describedby="vision-label"
                    tabindex="0" @keydown.enter="filters.accessibility.mobility = !filters.accessibility.mobility"
                  />
                  <label id="vision-label" for="vision-filter" class="text-gray-700 cursor-pointer" tabindex="0" @keydown.enter="filters.accessibility.mobility = !filters.accessibility.mobility">
                    <span class="flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                      Déficience visuelle
                    </span>
                  </label>
                </div>

                <div class="flex items-center space-x-3">
                  <input
                    type="checkbox"
                    id="hearing-filter"
                    v-model="filters.accessibility.hearing"
                    class="w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500"
                    aria-describedby="hearing-label"
                    tabindex="0" @keydown.enter="filters.accessibility.mobility = !filters.accessibility.mobility"
                  />
                  <label id="hearing-label" for="hearing-filter" class="text-gray-700 cursor-pointer" tabindex="0" @keydown.enter="filters.accessibility.mobility = !filters.accessibility.mobility">
                    <span class="flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                      </svg>
                      Déficience auditive
                    </span>
                  </label>
                </div>

                <div class="flex items-center space-x-3">
                  <input
                    type="checkbox"
                    id="cognitive-filter"
                    v-model="filters.accessibility.cognitive"
                    class="w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500"
                    aria-describedby="cognitive-label"
                    tabindex="0" @keydown.enter="filters.accessibility.mobility = !filters.accessibility.mobility"
                  />
                  <label id="cognitive-label" for="cognitive-filter" class="text-gray-700 cursor-pointer" tabindex="0" @keydown.enter="filters.accessibility.mobility = !filters.accessibility.mobility">
                    <span class="flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                      </svg>
                      Déficience cognitive
                    </span>
                  </label>
                </div>
              </div>
            </div>

            <div class="flex justify-between items-center pt-2">
              <button
                type="button"
                @click="resetFilters"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
              >
                Réinitialiser les filtres
              </button>

              <div class="text-sm text-gray-500">
                {{ filteredActivities.length }} activité{{ filteredActivities.length !== 1 ? 's' : '' }} trouvée{{ filteredActivities.length !== 1 ? 's' : '' }}
              </div>
            </div>
          </div>
        </section>

        <section id="featured-activities" aria-labelledby="featured-activities-heading" class="pt-8">
          <div class="flex justify-between items-center mb-6">
            <h3 id="featured-activities-heading" class="text-2xl font-semibold text-gray-800 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              Activités à venir
            </h3>
          </div>

          <div v-if="filteredActivities.length > 0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              <div
                v-for="activity in filteredActivities"
                :key="activity.id"
                class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-md transition-all transform hover:-translate-y-1 focus-within:ring-2 focus-within:ring-indigo-400 focus-within:ring-offset-2"
                tabindex="0"
              >
                <div class="h-2 bg-indigo-600"></div>

                <div class="p-6">
                  <h4 class="font-bold text-lg mb-3 text-gray-800">{{ activity.name }}</h4>

                  <p class="text-gray-600 mb-4 line-clamp-3">{{ truncate(activity.description, 150) }}</p>

                  <div class="space-y-3 mb-4">
                    <ActivityDateTime :activity="activity" compact />

                    <div class="flex items-center text-sm text-gray-700">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                      <span>{{ activity.location }}</span>
                    </div>

                    <div v-if="activity.categories && activity.categories.length" class="flex flex-wrap gap-2">
                      <span
                        v-for="category in activity.categories"
                        :key="category.id"
                        class="px-2 py-1 text-xs font-medium bg-indigo-50 text-indigo-700 rounded-full"
                      >
                        {{ category.name }}
                      </span>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-2">
                      <span v-if="activity.is_accessible_mobility"
                        class="w-8 h-8 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full"
                        title="Accessible aux personnes à mobilité réduite">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                      </span>

                      <span v-if="activity.is_accessible_vision"
                        class="w-8 h-8 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full"
                        title="Accessible aux personnes avec déficience visuelle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                      </span>

                      <span v-if="activity.is_accessible_hearing"
                        class="w-8 h-8 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full"
                        title="Accessible aux personnes avec déficience auditive">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                      </span>

                      <span v-if="activity.is_accessible_cognitive"
                        class="w-8 h-8 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full"
                        title="Accessible aux personnes avec déficience cognitive">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                      </span>
                    </div>
                  </div>

                  <div class="mt-4 text-right">
                    <Link
                      :href="route('activities.show', activity.id)"
                      class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                      aria-label="Voir les détails de l'activité"
                    >
                      Voir les détails
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                      </svg>
                    </Link>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-8" v-if="activities.last_page > 1">
              <Pagination
                :current-page="activities.current_page"
                :last-page="activities.last_page"
                :prev-page-url="activities.prev_page_url"
                :next-page-url="activities.next_page_url"
              />
            </div>
          </div>
          <div v-else class="bg-white p-8 text-center rounded-lg shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-gray-600 text-lg">
              Aucune activité ne correspond à vos critères de filtrage.
            </p>
            <p class="text-gray-400 mt-2">
              Essayez de modifier vos filtres ou revenez plus tard !
            </p>
          </div>
        </section>

        <section class="bg-gradient-to-r from-purple-600 to-indigo-500 p-8 rounded-lg text-white text-center">
          <h3 class="text-2xl font-bold mb-4">Rejoignez notre mission d'accessibilité</h3>
          <p class="text-lg mb-6 max-w-2xl mx-auto">
            Contribuez à rendre le sport accessible à tous en partageant vos événements et activités.
            Ensemble, nous pouvons créer un monde où chacun peut pratiquer le sport qu'il aime.
          </p>
          <div class="flex justify-center">
            <Link
              :href="route('register')"
              class="inline-flex items-center px-6 py-3 bg-white text-indigo-700 rounded-full font-medium text-sm shadow-lg hover:shadow-xl transition-all focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-500"
            >
              Créer un compte
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </Link>
          </div>
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
  import { reactive, computed } from 'vue';

  const props = defineProps({
    activities: Object
  });

  const { truncate } = useActivity();

  const months = [
    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
  ];

  // initialiser filtre
  const filters = reactive({
    months: [],
    accessibility: {
      mobility: false,
      vision: false,
      hearing: false,
      cognitive: false
    }
  });

  const toggleMonthFilter = (monthIndex) => {
    const index = filters.months.indexOf(monthIndex);
    if (index === -1) {
      // Si le mois n'est pas déjà sélectionné, l'ajouter
      filters.months.push(monthIndex);
    } else {
      // Sinon retirer
      filters.months.splice(index, 1);
    }
  };

  const resetFilters = () => {
    filters.months = [];
    filters.accessibility.mobility = false;
    filters.accessibility.vision = false;
    filters.accessibility.hearing = false;
    filters.accessibility.cognitive = false;
  };

  // extraire format "YYYY-MM-DD"
  const getMonthFromDate = (dateString) => {
    const date = new Date(dateString);
    return date.getMonth();
  };

  const filteredActivities = computed(() => {
    if (filters.months.length === 0 &&
        !filters.accessibility.mobility &&
        !filters.accessibility.vision &&
        !filters.accessibility.hearing &&
        !filters.accessibility.cognitive) {
      return props.activities.data;
    }

    return props.activities.data.filter(activity => {
      const activityMonth = getMonthFromDate(activity.date);
      const passesMonthFilter = filters.months.length === 0 || filters.months.includes(activityMonth);

      const passesAccessibilityFilter = (
        (!filters.accessibility.mobility || activity.is_accessible_mobility) &&
        (!filters.accessibility.vision || activity.is_accessible_vision) &&
        (!filters.accessibility.hearing || activity.is_accessible_hearing) &&
        (!filters.accessibility.cognitive || activity.is_accessible_cognitive)
      );

      return passesMonthFilter && passesAccessibilityFilter;
    });
  });
  </script>
