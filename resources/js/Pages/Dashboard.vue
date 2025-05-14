<template>
    <Head title="Tableau de bord - Access-agenda" />
    <AccessibleLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tableau de bord</h2>
      </template>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div v-if="$page.props.flash && $page.props.flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative" role="alert">
            <span class="block sm:inline">{{ $page.props.flash.success }}</span>
          </div>

          <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-medium text-gray-900">Mes activités</h3>
            <button
              @click="openActivityModal()"
              class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              aria-label="Ajouter une nouvelle activité">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              Ajouter une activité
            </button>
          </div>

          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div v-if="activities.data.length === 0" class="p-6 bg-white border-b border-gray-200">
              <p class="text-gray-600">Vous n'avez pas encore créé d'activités. Utilisez le bouton "Ajouter une activité" pour commencer.</p>
            </div>

            <div v-else class="divide-y divide-gray-200">
              <div v-for="activity in activities.data" :key="activity.id" class="p-6 bg-white border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between">
                  <div>
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
                    <button
                      @click="openActivityModal(activity)"
                      class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline"
                      aria-label="Modifier cette activité">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </button>
                    <button
                      @click="confirmDelete(activity)"
                      class="text-red-600 hover:text-red-900 focus:outline-none focus:underline"
                      aria-label="Supprimer cette activité">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <Pagination
              v-if="activities.data && activities.data.length > 0"
              :current-page="activities.current_page"
              :last-page="activities.last_page"
              :prev-page-url="activities.prev_page_url"
              :next-page-url="activities.next_page_url"
            />
          </div>
        </div>
      </div>

      <div v-if="showActivityModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showActivityModal = false"></div>

          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                  <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    {{ editingActivity ? 'Modifier une activité' : 'Ajouter une activité' }}
                  </h3>
                  <div class="mt-4 space-y-4">
                    <form @submit.prevent="saveActivity">
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
                            @click="showActivityModal = false"
                            class="px-4 py-2 bg-white border border-gray-300 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Annuler
                          </button>
                          <button
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 border border-transparent text-sm font-medium rounded-md text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ editingActivity ? 'Enregistrer' : 'Créer' }}
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="showDeleteModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showDeleteModal = false"></div>

          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                  <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                  </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    Supprimer l'activité
                  </h3>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">
                      Êtes-vous sûr de vouloir supprimer cette activité ? Cette action ne peut pas être annulée.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <button
                @click="deleteActivity"
                type="button"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Supprimer
              </button>
              <button
                @click="showDeleteModal = false"
                type="button"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Annuler
              </button>
            </div>
          </div>
        </div>
      </div>
    </AccessibleLayout>
  </template>

  <script setup>
  import { ref, reactive } from 'vue';
  import { Head, router } from '@inertiajs/vue3';
  import AccessibleLayout from '@/Layouts/AccessibleLayout.vue';
  import { useActivity } from '@/composables/useActivity';
  import AccessibilityBadges from '@/Components/AccessibilityBadges.vue';
  import ActivityDateTime from '@/Components/ActivityDateTime.vue';
  import Pagination from '@/Components/Pagination.vue';
  import { SPORT_TYPES } from '@/constants/sportTypes';

  const props = defineProps({
    activities: Object
  });

  const showActivityModal = ref(false);
  const showDeleteModal = ref(false);
  const editingActivity = ref(null);
  const activityToDelete = ref(null);

  const { truncate, truncateUrl } = useActivity();

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

  const openActivityModal = (activity = null) => {
    if (activity) {
      // Mode édition
      editingActivity.value = activity;
      Object.keys(form).forEach(key => { // je parcour les champs du form name, description etc
        if (key === 'date' && activity[key]) {
          const dateObj = new Date(activity[key]);
          form[key] = dateObj.toISOString().split('T')[0];
        } else {
          form[key] = activity[key] || '';
        }
      });
    } else {
      // Mode création
      editingActivity.value = null;
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

    showActivityModal.value = true;
  };

  const saveActivity = () => {
    form.is_accessible_mobility = Boolean(form.is_accessible_mobility);
    form.is_accessible_vision = Boolean(form.is_accessible_vision);
    form.is_accessible_hearing = Boolean(form.is_accessible_hearing);
    form.is_accessible_cognitive = Boolean(form.is_accessible_cognitive);

    if (editingActivity.value) {
      router.put(route('activities.update', editingActivity.value.id), form, {
        onSuccess: () => {
          showActivityModal.value = false;
        },
        onError: (errors) => {
          console.error('Erreurs de validation:', errors);
        }
      });
    } else {
      router.post(route('activities.store'), form, {
        onSuccess: () => {
          showActivityModal.value = false;
        },
        onError: (errors) => {
          console.error('Erreurs de validation:', errors);
        }
      });
    }
  };

  const confirmDelete = (activity) => {
    activityToDelete.value = activity;
    showDeleteModal.value = true;
  };

  const deleteActivity = () => {
    router.delete(route('activities.destroy', activityToDelete.value.id), {
      onSuccess: () => {
        showDeleteModal.value = false;
      }
    });
  };
  </script>
