<template>
    <nav v-if="lastPage > 1" :aria-label="ariaLabel" class="mt-8">
      <ul class="flex justify-center items-center space-x-1">
        <li>
          <Link v-if="currentPage > 1"
                :href="getPageUrl(1)"
                class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                :aria-label="firstLabel">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
            </svg>
          </Link>
          <span v-else
                class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed"
                aria-disabled="true">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
            </svg>
          </span>
        </li>

        <li>
          <Link v-if="prevPageUrl"
                :href="prevPageUrl"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                :aria-label="prevLabel">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            {{ prevText }}
          </Link>
          <span v-else
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed"
                aria-disabled="true">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            {{ prevText }}
          </span>
        </li>

        <li>
          <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md">
            Page {{ currentPage }} sur {{ lastPage }}
          </span>
        </li>

        <li>
          <Link v-if="nextPageUrl"
                :href="nextPageUrl"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                :aria-label="nextLabel">
            {{ nextText }}
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </Link>
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
          <Link v-if="currentPage < lastPage"
                :href="getPageUrl(lastPage)"
                class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                :aria-label="lastLabel">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7m-8-14l7 7-7 7"></path>
            </svg>
          </Link>
          <span v-else
                class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed"
                aria-disabled="true">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7m-8-14l7 7-7 7"></path>
            </svg>
          </span>
        </li>
      </ul>
    </nav>
  </template>

  <script setup>
  import { Link } from '@inertiajs/vue3';
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
    prevPageUrl: {
      type: String,
      default: null
    },
    nextPageUrl: {
      type: String,
      default: null
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
    }
  });

  const getPageUrl = (page) => {
    const url = new URL(window.location.href);
    url.searchParams.set('page', page);
    return url.toString();
  };
  </script>
