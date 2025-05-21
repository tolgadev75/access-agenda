<template>
    <div class="mb-6">
      <button
        @click="showFilters = !showFilters"
        class="flex items-center text-sm text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
        </svg>
        {{ showFilters ? 'Masquer les filtres' : 'Filtrer les activités' }}
      </button>

      <div class="relative w-full mt-4 mb-4">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <input
            type="text"
            :value="filters.search"
            @input="updateSearch($event.target.value)"
            placeholder="Rechercher une activité..."
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            aria-label="Rechercher une activité"
        />
        <button
            v-if="filters.search"
            @click="clearSearch"
            class="absolute inset-y-0 right-0 pr-3 flex items-center"
            aria-label="Effacer la recherche"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        </div>

      <div v-if="showFilters" class="mt-3 bg-white p-4 border border-gray-200 rounded-lg space-y-4">
        <div v-if="showStatusFilter">
          <h4 class="font-medium text-gray-700 mb-2">Statut</h4>
          <div class="flex space-x-2">
            <button
              @click="filters.status = 'all'"
              :class="[
                'px-3 py-1 rounded-lg text-sm font-medium transition-colors',
                filters.status === 'all'
                  ? 'bg-indigo-100 text-indigo-800'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              Toutes
            </button>
            <button
              @click="filters.status = 'upcoming'"
              :class="[
                'px-3 py-1 rounded-lg text-sm font-medium transition-colors',
                filters.status === 'upcoming'
                  ? 'bg-indigo-100 text-indigo-800'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              À venir
            </button>
            <button
              @click="filters.status = 'past'"
              :class="[
                'px-3 py-1 rounded-lg text-sm font-medium transition-colors',
                filters.status === 'past'
                  ? 'bg-indigo-100 text-indigo-800'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              Passées
            </button>
          </div>
        </div>

        <div>
          <h4 class="font-medium text-gray-700 mb-2">Par mois</h4>
          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2">
            <button
              v-for="(month, index) in months"
              :key="index"
              @click="toggleMonthFilter(index)"
              :class="[
                'py-1 px-2 rounded-lg text-sm font-medium transition-colors',
                filters.months.includes(index)
                  ? 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              {{ month }}
            </button>
          </div>
        </div>

        <div v-if="showSportTypeFilter">
          <h4 class="font-medium text-gray-700 mb-2">Par type de sport</h4>
          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
            <button
              v-for="type in sportTypes"
              :key="type"
              @click="toggleSportTypeFilter(type)"
              :class="[
                'py-1 px-2 rounded-lg text-sm font-medium transition-colors truncate',
                filters.sportTypes.includes(type)
                  ? 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              {{ type }}
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
                class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500"
                tabindex="0"
                @keydown.enter="filters.accessibility.mobility = !filters.accessibility.mobility"
              />
              <label for="mobility-filter" class="text-gray-700 cursor-pointer text-sm">
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500"
                tabindex="0"
                @keydown.enter="filters.accessibility.vision = !filters.accessibility.vision"
              />
              <label for="vision-filter" class="text-gray-700 cursor-pointer text-sm">
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500"
                tabindex="0"
                @keydown.enter="filters.accessibility.hearing = !filters.accessibility.hearing"
              />
              <label for="hearing-filter" class="text-gray-700 cursor-pointer text-sm">
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500"
                tabindex="0"
                @keydown.enter="filters.accessibility.cognitive = !filters.accessibility.cognitive"
              />
              <label for="cognitive-filter" class="text-gray-700 cursor-pointer text-sm">
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
            @click="resetFilters"
            class="text-sm text-gray-700 hover:text-gray-900 focus:outline-none focus:underline"
          >
            Réinitialiser les filtres
          </button>

          <div class="text-sm text-gray-500">
            {{ filteredCount }} activité{{ filteredCount !== 1 ? 's' : '' }} trouvée{{ filteredCount !== 1 ? 's' : '' }}
          </div>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, computed } from 'vue';
  import { SPORT_TYPES } from '@/constants/sportTypes';

  const props = defineProps({
    filters: {
      type: Object,
      required: true
    },
    months: {
      type: Array,
      required: true
    },
    filteredCount: {
      type: Number,
      required: true
    },
    showStatusFilter: {
      type: Boolean,
      default: false
    },
    showSportTypeFilter: {
      type: Boolean,
      default: false
    }
  });

  const emit = defineEmits(['toggleMonthFilter', 'toggleSportTypeFilter', 'resetFilters', 'updateSearch']);

  const showFilters = ref(false);
  const sportTypes = SPORT_TYPES;

  const toggleMonthFilter = (monthIndex) => {
    emit('toggleMonthFilter', monthIndex);
  };

  const toggleSportTypeFilter = (type) => {
    emit('toggleSportTypeFilter', type);
  };

  const resetFilters = () => {
    emit('resetFilters');
  };

  const updateSearch = (value) => {
  emit('updateSearch', value);
  };

  const clearSearch = () => {
  emit('updateSearch', '');
  };
  </script>
