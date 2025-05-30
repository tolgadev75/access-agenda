import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

export function useAjaxPagination(options = {}) {
  const {
    dataKey = 'activities',
    pageParam = 'page',
    preserveScroll = true,
    preserveState = true,
    onSuccess = null,
    onError = null
  } = options;

  const loading = ref(false);
  const paginatedData = ref(null);

  const initialize = (initialData) => {
    paginatedData.value = initialData;
  };

  const changePage = async (page) => {
    if (loading.value || !paginatedData.value || page === paginatedData.value.current_page) {
      return;
    }

    if (page < 1 || page > paginatedData.value.last_page) {
      return;
    }

    loading.value = true;

    try {
      await router.reload({
        data: { [pageParam]: page },
        only: [dataKey],
        onSuccess: (response) => {
          paginatedData.value = response.props[dataKey];

          const url = new URL(window.location);
          url.searchParams.delete(pageParam);
          window.history.replaceState({}, '', url.pathname);

          if (onSuccess) {
            onSuccess(response.props[dataKey]);
          }
        },
        preserveScroll,
        preserveState: false
      });
    } catch (error) {
      console.error(`Erreur lors du chargement de la page ${page}:`, error);
      if (onError) {
        onError(error);
      }
    } finally {
      loading.value = false;
    }
  };

  const nextPage = () => {
    if (paginatedData.value && paginatedData.value.current_page < paginatedData.value.last_page) {
      changePage(paginatedData.value.current_page + 1);
    }
  };

  const prevPage = () => {
    if (paginatedData.value && paginatedData.value.current_page > 1) {
      changePage(paginatedData.value.current_page - 1);
    }
  };

  const firstPage = () => {
    changePage(1);
  };

  const lastPage = () => {
    if (paginatedData.value) {
      changePage(paginatedData.value.last_page);
    }
  };

  const refresh = () => {
    if (paginatedData.value) {
      changePage(paginatedData.value.current_page);
    }
  };

  return {
    loading,
    paginatedData,
    initialize,
    changePage,
    nextPage,
    prevPage,
    firstPage,
    lastPage,
    refresh
  };
}
