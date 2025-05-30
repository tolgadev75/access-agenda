<template>
  <nav v-if="lastPage > 1" :aria-label="ariaLabel" class="mt-8" role="navigation">
    <div class="sr-only" aria-live="polite" aria-atomic="true">
      <span v-if="loading">Chargement de la page {{ currentPage }} en cours...</span>
      <span v-else>Page {{ currentPage }} sur {{ lastPage }} affichée</span>
    </div>

    <ul class="flex justify-center items-center space-x-1" role="list">
      <li role="listitem">
        <button
          v-if="currentPage > 1"
          @click="changePage(1)"
          :disabled="loading"
          class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
          :aria-label="`${firstLabel} (Page 1)`"
          :aria-describedby="loading ? 'pagination-loading' : undefined">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
          </svg>
        </button>
        <span v-else
              class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed"
              aria-disabled="true"
              :aria-label="`${firstLabel} - non disponible`">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
          </svg>
        </span>
      </li>

      <li role="listitem">
        <button
          v-if="currentPage > 1"
          @click="changePage(currentPage - 1)"
          :disabled="loading"
          class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
          :aria-label="`${prevLabel} (Page ${currentPage - 1})`"
          :aria-describedby="loading ? 'pagination-loading' : undefined">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
          {{ prevText }}
        </button>
        <span v-else
              class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed"
              aria-disabled="true"
              :aria-label="`${prevLabel} - non disponible`">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
          {{ prevText }}
        </span>
      </li>

      <li v-for="page in visiblePages" :key="page" class="hidden sm:block" role="listitem">
        <button
          v-if="page !== '...'"
          @click="changePage(page)"
          :disabled="loading || page === currentPage"
          :class="[
            'relative inline-flex items-center px-4 py-2 text-sm font-medium border rounded-md transition-all focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500',
            page === currentPage
              ? 'bg-indigo-600 text-white border-indigo-600'
              : 'text-gray-700 bg-white border-gray-300 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed'
          ]"
          :aria-label="`Aller à la page ${page}`"
          :aria-current="page === currentPage ? 'page' : undefined"
          :aria-describedby="loading ? 'pagination-loading' : undefined">
          {{ page }}
        </button>
        <span v-else
              class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md"
              aria-hidden="true">
          ...
        </span>
      </li>

      <li class="sm:hidden">
        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md">
          <svg v-if="loading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Page {{ currentPage }} sur {{ lastPage }}
        </span>
      </li>

      <li>
        <button
          v-if="currentPage < lastPage"
          @click="changePage(currentPage + 1)"
          :disabled="loading"
          class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
          :aria-label="nextLabel">
          {{ nextText }}
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
        <span v-else
              class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed"
              aria-disabled="true">
          {{ nextText }}
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </span>
      </li>

      <li>
        <button
          v-if="currentPage < lastPage"
          @click="changePage(lastPage)"
          :disabled="loading"
          class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
          :aria-label="lastLabel">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7m-8-14l7 7-7 7"></path>
          </svg>
        </button>
        <span v-else
              class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed"
              aria-disabled="true">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7m-8-14l7 7-7 7"></path>
          </svg>
        </span>
      </li>
    </ul>

    <div v-if="loading" id="pagination-loading" class="flex justify-center mt-4" aria-live="assertive" aria-atomic="true">
      <div class="flex items-center text-sm text-gray-600">
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span>Chargement en cours...</span>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  currentPage: {
    type: Number,
    required: true
  },
  lastPage: {
    type: Number,
    required: true
  },
  loading: {
    type: Boolean,
    default: false
  },
  ariaLabel: {
    type: String,
    default: "Navigation de la pagination"
  },
  prevText: {
    type: String,
    default: "Précédent"
  },
  nextText: {
    type: String,
    default: "Suivant"
  },
  prevLabel: {
    type: String,
    default: "Page précédente"
  },
  nextLabel: {
    type: String,
    default: "Page suivante"
  },
  firstLabel: {
    type: String,
    default: "Première page"
  },
  lastLabel: {
    type: String,
    default: "Dernière page"
  },
  maxVisiblePages: {
    type: Number,
    default: 5
  }
});

const emit = defineEmits(['page-change']);

const visiblePages = computed(() => {
  const pages = [];
  const total = props.lastPage;
  const current = props.currentPage;
  const max = props.maxVisiblePages;

  if (total <= max) {
    for (let i = 1; i <= total; i++) {
      pages.push(i);
    }
  } else {
    const half = Math.floor(max / 2);
    let start = Math.max(1, current - half);
    let end = Math.min(total, start + max - 1);

    if (end === total) {
      start = Math.max(1, end - max + 1);
    }

    if (start > 1) {
      pages.push(1);
      if (start > 2) {
        pages.push('...');
      }
    }

    for (let i = start; i <= end; i++) {
      pages.push(i);
    }

    if (end < total) {
      if (end < total - 1) {
        pages.push('...');
      }
      pages.push(total);
    }
  }

  return pages;
});

const changePage = (page) => {
  if (page === props.currentPage || props.loading || page < 1 || page > props.lastPage) {
    return;
  }

  emit('page-change', page);
};
</script>
