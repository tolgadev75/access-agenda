<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div v-if="activities.length === 0" class="p-6 bg-white border-b border-gray-200">
        <p class="text-gray-600">{{ emptyMessage }}</p>
      </div>

      <div v-else class="divide-y divide-gray-200">
        <div v-for="activity in activities" :key="activity.id" class="p-6 bg-white border-b border-gray-200">
          <div class="flex flex-col sm:flex-row justify-between">
            <div>
              <div class="mb-2">
                <slot name="badges" :activity="activity"></slot>
              </div>

              <h4 class="text-lg font-medium text-gray-900">{{ activity.name }}</h4>

              <ActivityDateTime :activity="activity" :show-time="false" compact />

              <p class="text-sm text-gray-600 mt-2">{{ truncate(activity.description, 150) }}</p>
              <div v-if="activity.link" class="mt-2">
                <a :href="activity.link" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:text-indigo-900 text-sm underline">
                  {{ truncateUrl(activity.link, 40) }}
                </a>
              </div>
              <div class="mt-2">
                <AccessibilityBadges :activity="activity" small />
              </div>
            </div>
            <div class="mt-4 sm:mt-0 flex items-start space-x-2">
              <slot name="actions" :activity="activity"></slot>
            </div>
          </div>
        </div>
      </div>

      <slot name="pagination"></slot>
    </div>
  </template>

  <script setup>
  import ActivityDateTime from '@/Components/ActivityDateTime.vue';
  import AccessibilityBadges from '@/Components/AccessibilityBadges.vue';
  import { useActivity } from '@/composables/useActivity';

  const props = defineProps({
    activities: {
      type: Array,
      required: true
    },
    emptyMessage: {
      type: String,
      default: "Aucune activité n'est disponible pour le moment."
    }
  });

  const { truncate, truncateUrl } = useActivity();
  </script>
