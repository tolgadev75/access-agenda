<template>
    <form @submit.prevent="submit">
      <div class="space-y-4">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nom de l'activité *</label>
          <input type="text" id="name" v-model="form.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>

        <div>
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea id="description" v-model="form.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
        </div>

        <div>
          <label for="link" class="block text-sm font-medium text-gray-700">Lien</label>
          <input type="url" id="link" v-model="form.link" placeholder="https://example.com" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
          <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
          <input type="text" id="location" v-model="form.location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Date *</label>
            <input type="date" id="date" v-model="form.date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
          </div>
          <div>
            <label for="start_time" class="block text-sm font-medium text-gray-700">Heure de début</label>
            <input type="time" id="start_time" v-model="form.start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
          </div>
          <div>
            <label for="end_time" class="block text-sm font-medium text-gray-700">Heure de fin</label>
            <input type="time" id="end_time" v-model="form.end_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
          </div>
        </div>

        <div>
          <label for="sport_type" class="block text-sm font-medium text-gray-700">Type de sport</label>
          <select id="sport_type" v-model="form.sport_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Sélectionner un type</option>
            <option v-for="type in sportTypes" :key="type" :value="type">{{ type }}</option>
          </select>
        </div>

        <div>
          <span class="block text-sm font-medium text-gray-700 mb-2">Accessibilité</span>
          <div class="space-y-2">
            <div class="flex items-center">
              <input type="checkbox" id="is_accessible_mobility" v-model="form.is_accessible_mobility" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
              <label for="is_accessible_mobility" class="ml-2 block text-sm text-gray-700">Accessible aux personnes à mobilité réduite</label>
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="is_accessible_vision" v-model="form.is_accessible_vision" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
              <label for="is_accessible_vision" class="ml-2 block text-sm text-gray-700">Accessible aux personnes malvoyantes</label>
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="is_accessible_hearing" v-model="form.is_accessible_hearing" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
              <label for="is_accessible_hearing" class="ml-2 block text-sm text-gray-700">Accessible aux personnes malentendantes</label>
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="is_accessible_cognitive" v-model="form.is_accessible_cognitive" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
              <label for="is_accessible_cognitive" class="ml-2 block text-sm text-gray-700">Accessible aux personnes avec handicap cognitif</label>
            </div>
          </div>
        </div>

        <div>
          <label for="accessibility_details" class="block text-sm font-medium text-gray-700">Détails d'accessibilité</label>
          <textarea id="accessibility_details" v-model="form.accessibility_details" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="contact_email" class="block text-sm font-medium text-gray-700">Email de contact</label>
            <input type="email" id="contact_email" v-model="form.contact_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
          </div>
          <div>
            <label for="contact_phone" class="block text-sm font-medium text-gray-700">Téléphone de contact</label>
            <input type="tel" id="contact_phone" v-model="form.contact_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
          </div>
        </div>

        <div class="mt-6 space-x-3 flex justify-end">
          <button
            type="button"
            @click="$emit('cancel')"
            class="px-4 py-2 bg-white border border-gray-300 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Annuler
          </button>
          <button
            type="submit"
            class="px-4 py-2 bg-indigo-600 border border-transparent text-sm font-medium rounded-md text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ isEditing ? 'Enregistrer' : 'Créer' }}
          </button>
        </div>
      </div>
    </form>
  </template>

  <script setup>
  import { reactive, watch, computed } from 'vue';
  import { SPORT_TYPES } from '@/constants/sportTypes';

  const props = defineProps({
    activity: {
      type: Object,
      default: null
    },
    isEditing: {
      type: Boolean,
      default: false
    }
  });

  const emit = defineEmits(['submit', 'cancel']);

  const sportTypes = SPORT_TYPES;

  const form = reactive({
    name: '',
    description: '',
    link: '',
    location: '',
    date: '',
    start_time: '',
    end_time: '',
    sport_type: '',
    is_accessible_mobility: false,
    is_accessible_vision: false,
    is_accessible_hearing: false,
    is_accessible_cognitive: false,
    accessibility_details: '',
    contact_email: '',
    contact_phone: '',
  });

  // (mode édition)
  watch(() => props.activity, (newActivity) => {
    if (newActivity) {
      Object.keys(form).forEach(key => {
        if (key === 'date' && newActivity[key]) {
          const dateObj = new Date(newActivity[key]);
          form[key] = dateObj.toISOString().split('T')[0];
        } else {
          form[key] = newActivity[key] || '';
        }
      });
    } else {
      // (Mode création)
      Object.keys(form).forEach(key => {
        if (typeof form[key] === 'boolean') {
          form[key] = false;
        } else if (key === 'date') {
          form[key] = new Date().toISOString().split('T')[0];
        } else {
          form[key] = '';
        }
      });
      form.sport_type = '';
    }
  }, { immediate: true });

  const submit = () => {
    // Conversion en booléens
    form.is_accessible_mobility = Boolean(form.is_accessible_mobility);
    form.is_accessible_vision = Boolean(form.is_accessible_vision);
    form.is_accessible_hearing = Boolean(form.is_accessible_hearing);
    form.is_accessible_cognitive = Boolean(form.is_accessible_cognitive);

    emit('submit', form);
  };
  </script>
