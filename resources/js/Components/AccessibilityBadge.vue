<template>
    <span
      v-if="isAccessible"
      :class="['px-2 py-1 rounded-full inline-flex items-center', 'bg-' + color + '-100', 'text-' + color + '-800', small ? 'text-xs' : 'px-3 py-1']"
      :aria-label="fullLabel">
      <svg xmlns="http://www.w3.org/2000/svg" :class="[small ? 'h-3 w-3 mr-1' : 'h-4 w-4 mr-2']" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="iconPath" />
      </svg>
      {{ shortLabel }}
    </span>
  </template>

  <script setup>
  import { computed } from 'vue';

  const props = defineProps({
    type: {
      type: String,
      required: true,
      validator: (value) => ['mobility', 'vision', 'hearing', 'cognitive'].includes(value)
    },
    isAccessible: {
      type: Boolean,
      required: true
    },
    small: {
      type: Boolean,
      default: false
    }
  });

  const config = {
    mobility: {
      shortLabel: 'Mobilité',
      fullLabel: 'Accessible aux personnes à mobilité réduite',
      iconPath: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'
    },
    vision: {
      shortLabel: 'Vision',
      fullLabel: 'Accessible aux personnes malvoyantes',
      iconPath: 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'
    },
    hearing: {
      shortLabel: 'Auditif',
      fullLabel: 'Accessible aux personnes malentendantes',
      iconPath: 'M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.465a5 5 0 001.06-7.072m-2.829 9.9a9 9 0 010-12.728'
    },
    cognitive: {
      shortLabel: 'Cognitif',
      fullLabel: 'Accessible aux personnes avec handicap cognitif',
      iconPath: 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'
    }
  };

  const color = computed(() => config[props.type].color);
  const shortLabel = computed(() => config[props.type].shortLabel);
  const fullLabel = computed(() => config[props.type].fullLabel);
  const iconPath = computed(() => config[props.type].iconPath);
  </script>
