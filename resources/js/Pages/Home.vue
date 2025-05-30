<template>
    <Head
    title="Accueil - Access-agenda"
    description="Découvrez des activités sportives accessibles près de chez vous. Sports adaptés aux personnes à mobilité réduite, malvoyantes, malentendantes et avec handicap cognitif."
    />
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

        <ActivityFilters
          :filters="filters"
          :months="months"
          :filteredCount="filteredActivities.length"
          @toggleMonthFilter="toggleMonthFilter"
          @toggleSportTypeFilter="toggleSportTypeFilter"
          @resetFilters="resetFilters"
          @updateSearch="filters.search = $event"
        />

        <section id="featured-activities" aria-labelledby="featured-activities-heading" class="pt-8">
          <div class="flex justify-between items-center mb-6">
            <h3 id="featured-activities-heading" class="text-2xl font-semibold text-gray-800 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              Activités à venir
            </h3>
          </div>

          <div v-if="upcomingPagination.loading.value" class="flex justify-center items-center py-12">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
            <span class="ml-2 text-gray-600">Chargement...</span>
          </div>

          <ActivityList
            v-else
            :activities="filteredActivities"
            emptyMessage="Aucune activité ne correspond à vos critères de filtrage. Essayez de modifier vos filtres ou revenez plus tard !"
          >
            <template #actions="{ activity }">
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
            </template>

            <template #pagination>
              <div class="mt-8" v-if="upcomingPagination.paginatedData.value && upcomingPagination.paginatedData.value.last_page > 1">
                <AjaxPagination
                  :current-page="upcomingPagination.paginatedData.value.current_page"
                  :last-page="upcomingPagination.paginatedData.value.last_page"
                  :loading="upcomingPagination.loading.value"
                  @page-change="upcomingPagination.changePage"
                />
              </div>
            </template>
          </ActivityList>
        </section>

        <section id="past-activities" aria-labelledby="past-activities-heading" class="pt-12">
          <h3 id="past-activities-heading" class="text-2xl font-semibold text-gray-800 flex items-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
            </svg>
            Activités passées
          </h3>

          <!-- Indicateur de chargement -->
          <div v-if="pastPagination.loading.value" class="flex justify-center items-center py-12">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
            <span class="ml-2 text-gray-600">Chargement...</span>
          </div>

          <ActivityList
            v-else
            :activities="pastActivitiesRef"
            emptyMessage="Aucune activité passée ne correspond à vos critères."
          >
            <template #actions="{ activity }">
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
            </template>

            <template #pagination>
              <div class="mt-8" v-if="pastPagination.paginatedData.value && pastPagination.paginatedData.value.last_page > 1">
                <AjaxPagination
                  :current-page="pastPagination.paginatedData.value.current_page"
                  :last-page="pastPagination.paginatedData.value.last_page"
                  :loading="pastPagination.loading.value"
                  @page-change="pastPagination.changePage"
                />
              </div>
            </template>
          </ActivityList>
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
  import ActivityFilters from '@/Components/Activities/ActivityFilters.vue';
  import ActivityList from '@/Components/Activities/ActivityList.vue';
  import AjaxPagination from '@/Components/AjaxPagination.vue';
  import { computed, onMounted } from 'vue';
  import { useFilters } from '@/composables/useFilters';
  import { useAjaxPagination } from '@/composables/useAjaxPagination';

  const props = defineProps({
    upcomingActivities: Object,
    pastActivities: Object
  });

  const { truncate } = useActivity();

  const upcomingPagination = useAjaxPagination({
    dataKey: 'upcomingActivities',
    pageParam: 'page'
  });

  const pastPagination = useAjaxPagination({
    dataKey: 'pastActivities',
    pageParam: 'past_page'
  });

  onMounted(() => {
    upcomingPagination.initialize(props.upcomingActivities);
    pastPagination.initialize(props.pastActivities);
  });

  const upcomingActivitiesRef = computed(() => {
    return upcomingPagination.paginatedData.value?.data || [];
  });

  const pastActivitiesRef = computed(() => {
    return pastPagination.paginatedData.value?.data || [];
  });

  const {
    filters,
    months,
    toggleMonthFilter,
    toggleSportTypeFilter,
    resetFilters,
    filteredActivities
  } = useFilters(upcomingActivitiesRef);
  </script>
