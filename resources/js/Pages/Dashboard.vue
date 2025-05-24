<template>
    <Head
    title="Tableau de bord - Access-agenda"
    description="Access-agenda rend le sport accessible à tous. Plateforme inclusive pour activités sportives adaptées à tous les handicaps."
    />
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

          <ActivityFilters
            :filters="filters"
            :months="months"
            :filteredCount="filteredActivities.length"
            :showStatusFilter="true"
            :showSportTypeFilter="true"
            @toggleMonthFilter="toggleMonthFilter"
            @toggleSportTypeFilter="toggleSportTypeFilter"
            @resetFilters="resetFilters"
            @updateSearch="filters.search = $event"
          />

          <ActivityList
            :activities="filteredActivities"
            emptyMessage="Vous n'avez pas encore créé d'activités. Utilisez le bouton 'Ajouter une activité' pour commencer."
          >
            <template #actions="{ activity }">
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
            </template>

            <template #pagination>
              <Pagination
                v-if="activities.data && activities.data.length > 0"
                :current-page="activities.current_page"
                :last-page="activities.last_page"
                :prev-page-url="activities.prev_page_url"
                :next-page-url="activities.next_page_url"
              />
            </template>
          </ActivityList>
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
                    <ActivityForm
                      :activity="editingActivity"
                      :isEditing="!!editingActivity"
                      @submit="saveActivity"
                      @cancel="showActivityModal = false"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <ConfirmationModal
        v-if="showDeleteModal"
        title="Supprimer l'activité"
        message="Êtes-vous sûr de vouloir supprimer cette activité ? Cette action ne peut pas être annulée."
        confirmButtonText="Supprimer"
        @confirm="deleteActivity"
        @cancel="showDeleteModal = false"
      />

    </AccessibleLayout>
  </template>

  <script setup>
  import { ref, computed } from 'vue';
  import { Head, router } from '@inertiajs/vue3';
  import AccessibleLayout from '@/Layouts/AccessibleLayout.vue';
  import Pagination from '@/Components/Pagination.vue';
  import ActivityForm from '@/Components/Dashboard/ActivityForm.vue';
  import ActivityFilters from '@/Components/Activities/ActivityFilters.vue';
  import ActivityList from '@/Components/Activities/ActivityList.vue';
  import ConfirmationModal from '@/Components/Activities/UI/ConfirmationModal.vue';
  import { useFilters } from '@/composables/useFilters';

  const props = defineProps({
    activities: Object
  });

  // Modaux et états d'édition
  const showActivityModal = ref(false);
  const showDeleteModal = ref(false);
  const editingActivity = ref(null);
  const activityToDelete = ref(null);

  const activitiesRef = computed(() => props.activities.data);
  const {
    filters,
    months,
    toggleMonthFilter,
    toggleSportTypeFilter,
    resetFilters,
    filteredActivities
  } = useFilters(activitiesRef);

  const openActivityModal = (activity = null) => {
    editingActivity.value = activity;
    showActivityModal.value = true;
  };

  const saveActivity = (formData) => {
    if (editingActivity.value) {
      router.put(route('activities.update', editingActivity.value.id), formData, {
        onSuccess: () => {
          showActivityModal.value = false;
        },
        onError: (errors) => {
          console.error('Erreurs de validation:', errors);
        }
      });
    } else {
      router.post(route('activities.store'), formData, {
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
