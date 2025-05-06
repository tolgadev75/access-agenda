<template>
    <div class="flex flex-wrap gap-2">
      <AccessibilityBadge
        type="mobility"
        :is-accessible="activity.is_accessible_mobility"
        :small="small"
      />
      <AccessibilityBadge
        type="vision"
        :is-accessible="activity.is_accessible_vision"
        :small="small"
      />
      <AccessibilityBadge
        type="hearing"
        :is-accessible="activity.is_accessible_hearing"
        :small="small"
      />
      <AccessibilityBadge
        type="cognitive"
        :is-accessible="activity.is_accessible_cognitive"
        :small="small"
      />
    </div>
  </template>

  <script setup>
  import AccessibilityBadge from './AccessibilityBadge.vue';

  defineProps({
    activity: {
      type: Object,
      required: true
    },
    small: {
      type: Boolean,
      default: false
    }
  });
  </script>
