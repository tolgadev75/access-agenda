<template>
    <Head
    title="Tableau de bord - Access-agenda"
    description="Access-agenda rend le sport accessible à tous. Plateforme inclusive pour activités sportives adaptées à tous les handicaps."
    />
    <AccessibleLayout>
      <div class="bg-gradient-to-r from-indigo-500 to-purple-600 -mx-6 -mt-6 p-8 rounded-b-lg text-white mb-8">
        <h1 class="text-2xl font-bold">Bonjour {{ $page.props.auth.user.name }} ! 👋</h1>
        <p class="text-indigo-100 mt-2">Voici un aperçu de vos activités sportives</p>
      </div>

      <div v-if="$page.props.flash && $page.props.flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative" role="alert">
        <span class="block sm:inline">{{ $page.props.flash.success }}</span>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm border">
          <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-2xl font-semibold text-gray-900">{{ upcomingCount }}</p>
              <p class="text-gray-600 text-sm">À venir</p>
            </div>
          </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border">
          <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-2xl font-semibold text-gray-900">{{ todayCount }}</p>
              <p class="text-gray-600 text-sm">Aujourd'hui</p>
            </div>
          </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border">
          <div class="flex items-center">
            <div class="p-3 bg-gray-100 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-2xl font-semibold text-gray-900">{{ totalCount }}</p>
              <p class="text-gray-600 text-sm">Total</p>
            </div>
          </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border">
          <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-2xl font-semibold text-gray-900">{{ thisMonthCount }}</p>
              <p class="text-gray-600 text-sm">Ce mois</p>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-sm border mb-8">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Actions rapides</h3>
        <div class="flex flex-wrap gap-4">
          <button
            @click="openActivityModal()"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nouvelle activité
          </button>

          <Link
            :href="route('home')"
            class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            Voir les activités publiques
          </Link>

          <Link
            :href="route('profile.edit')"
            class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Mon profil
          </Link>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-sm border">
        <div class="p-6 border-b border-gray-200">
          <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Toutes mes activités</h3>
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
        </div>

        <div class="p-6">
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

          <div v-if="activitiesPagination.loading.value" class="flex justify-center items-center py-12 mt-6">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
            <span class="ml-2 text-gray-600">Chargement...</span>
          </div>

          <div v-else class="mt-6">
            <ActivityList
              :activities="filteredActivities"
              emptyMessage="Vous n'avez pas encore créé d'activités. Utilisez le bouton 'Ajouter une activité' pour commencer."
            >
              <template #badges="{ activity }">
                <span
                  v-if="isActivityPast(activity)"
                  class="inline-block px-2 py-1 text-xs font-medium bg-gray-200 text-gray-700 rounded-full mb-2"
                >
                  Terminée
                </span>
                <span
                  v-else-if="isActivityToday(activity)"
                  class="inline-block px-2 py-1 text-xs font-medium bg-yellow-200 text-yellow-800 rounded-full mb-2"
                >
                  Aujourd'hui
                </span>
                <span
                  v-else
                  class="inline-block px-2 py-1 text-xs font-medium bg-green-200 text-green-800 rounded-full mb-2"
                >
                  À venir
                </span>
              </template>

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
                <div class="mt-8" v-if="activitiesPagination.paginatedData.value && activitiesPagination.paginatedData.value.last_page > 1">
                  <AjaxPagination
                    :current-page="activitiesPagination.paginatedData.value.current_page"
                    :last-page="activitiesPagination.paginatedData.value.last_page"
                    :loading="activitiesPagination.loading.value"
                    @page-change="activitiesPagination.changePage"
                  />
                </div>
              </template>
            </ActivityList>
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
  import { ref, computed, onMounted } from 'vue';
  import { Head, Link, router } from '@inertiajs/vue3';
  import AccessibleLayout from '@/Layouts/AccessibleLayout.vue';
  import AjaxPagination from '@/Components/AjaxPagination.vue';
  import ActivityForm from '@/Components/Dashboard/ActivityForm.vue';
  import ActivityFilters from '@/Components/Activities/ActivityFilters.vue';
  import ActivityList from '@/Components/Activities/ActivityList.vue';
  import ConfirmationModal from '@/Components/Activities/UI/ConfirmationModal.vue';
  import { useFilters } from '@/composables/useFilters';
  import { useAjaxPagination } from '@/composables/useAjaxPagination';

  const props = defineProps({
    activities: Object
  });

  const activitiesPagination = useAjaxPagination({
    dataKey: 'activities',
    pageParam: 'page',
  });

  onMounted(() => {
    activitiesPagination.initialize(props.activities);
  });

  const showActivityModal = ref(false);
  const showDeleteModal = ref(false);
  const editingActivity = ref(null);
  const activityToDelete = ref(null);

  const activitiesRef = computed(() => {
    return activitiesPagination.paginatedData.value?.data || [];
  });

  const {
    filters,
    months,
    toggleMonthFilter,
    toggleSportTypeFilter,
    resetFilters,
    filteredActivities
  } = useFilters(activitiesRef);

  const isActivityPast = (activity) => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const activityDate = new Date(activity.date);
    activityDate.setHours(0, 0, 0, 0);
    return activityDate < today;
  };

  const isActivityToday = (activity) => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const activityDate = new Date(activity.date);
    activityDate.setHours(0, 0, 0, 0);
    return activityDate.getTime() === today.getTime();
  };

  const totalCount = computed(() => activitiesRef.value.length);

  const upcomingCount = computed(() => {
    return activitiesRef.value.filter(activity => !isActivityPast(activity) && !isActivityToday(activity)).length;
  });

  const todayCount = computed(() => {
    return activitiesRef.value.filter(activity => isActivityToday(activity)).length;
  });

  const thisMonthCount = computed(() => {
    const currentMonth = new Date().getMonth();
    const currentYear = new Date().getFullYear();
    return activitiesRef.value.filter(activity => {
      const activityDate = new Date(activity.date);
      return activityDate.getMonth() === currentMonth && activityDate.getFullYear() === currentYear;
    }).length;
  });

  const openActivityModal = (activity = null) => {
    editingActivity.value = activity;
    showActivityModal.value = true;
  };

  const saveActivity = (formData) => {
    if (editingActivity.value) {
      router.put(route('activities.update', editingActivity.value.id), formData, {
        onSuccess: () => {
          showActivityModal.value = false;
          activitiesPagination.refresh();
        },
        onError: (errors) => {
          console.error('Erreurs de validation:', errors);
        }
      });
    } else {
      router.post(route('activities.store'), formData, {
        onSuccess: () => {
          showActivityModal.value = false;
          activitiesPagination.refresh();
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
        activitiesPagination.refresh();
      }
    });
  };
  </script>
