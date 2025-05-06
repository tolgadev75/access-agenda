<template>
    <div class="text-sm text-gray-700">
      <div class="flex items-center mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" :class="iconClass" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span>{{ formattedDate }}</span>
      </div>
      <div v-if="showTime && (activity.start_time || activity.end_time)" class="flex items-center mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" :class="iconClass" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ timeDisplay }}</span>
      </div>
    </div>
  </template>

  <script setup>
  import { computed } from 'vue';
  import { useActivity } from '@/composables/useActivity';

  const props = defineProps({
    activity: {
      type: Object,
      required: true
    },
    fullDate: {
      type: Boolean,
      default: false
    },
    showTime: {
      type: Boolean,
      default: true
    },
    compact: {
      type: Boolean,
      default: false
    }
  });

  const { formatDate, formatFullDate } = useActivity();

  const formattedDate = computed(() => {
    return props.fullDate
      ? formatFullDate(props.activity.date)
      : formatDate(props.activity.date);
  });

  const timeDisplay = computed(() => {
    const times = [];
    if (props.activity.start_time) times.push(props.activity.start_time);
    if (props.activity.end_time) times.push(props.activity.end_time);
    return times.join(' - ');
  });

  const iconClass = computed(() => props.compact ? 'h-4 w-4 mr-2' : 'h-5 w-5 mr-2 text-indigo-600');
  </script>
