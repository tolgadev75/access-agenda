import { ref, reactive, computed } from 'vue';

export function useFilters(activities) {
  const showFilters = ref(false);

  const months = [
    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
  ];

  const filters = reactive({
    status: 'all',
    months: [],
    sportTypes: [],
    accessibility: {
      mobility: false,
      vision: false,
      hearing: false,
      cognitive: false
    }
  });

  const toggleMonthFilter = (monthIndex) => {
    const index = filters.months.indexOf(monthIndex);
    if (index === -1) {
      filters.months.push(monthIndex);
    } else {
      filters.months.splice(index, 1);
    }
  };

  const toggleSportTypeFilter = (type) => {
    const index = filters.sportTypes.indexOf(type);
    if (index === -1) {
      filters.sportTypes.push(type);
    } else {
      filters.sportTypes.splice(index, 1);
    }
  };

  const resetFilters = () => {
    filters.status = 'all';
    filters.months = [];
    filters.sportTypes = [];
    filters.accessibility.mobility = false;
    filters.accessibility.vision = false;
    filters.accessibility.hearing = false;
    filters.accessibility.cognitive = false;
  };

  const getMonthFromDate = (dateString) => {
    const date = new Date(dateString);
    return date.getMonth();
  };

  const filteredActivities = computed(() => {
    if (filters.months.length === 0 &&
        !filters.accessibility.mobility &&
        !filters.accessibility.vision &&
        !filters.accessibility.hearing &&
        !filters.accessibility.cognitive &&
        (!filters.sportTypes || filters.sportTypes.length === 0) &&
        filters.status === 'all') {
      return activities.value;
    }

    return activities.value.filter(activity => {
      let passesStatusFilter = true;
      if (filters.status !== 'all') {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const activityDate = new Date(activity.date);
        activityDate.setHours(0, 0, 0, 0);

        const isPast = activityDate < today;
        const isFuture = activityDate >= today;

        passesStatusFilter =
          (filters.status === 'past' && isPast) ||
          (filters.status === 'upcoming' && isFuture);
      }

      if (!passesStatusFilter) return false;

      const activityMonth = getMonthFromDate(activity.date);
      const passesMonthFilter = filters.months.length === 0 || filters.months.includes(activityMonth);

      if (!passesMonthFilter) return false;

      const passesSportTypeFilter =
        filters.sportTypes.length === 0 ||
        (activity.sport_type && filters.sportTypes.includes(activity.sport_type));

      if (!passesSportTypeFilter) return false;

      const passesAccessibilityFilter = (
        (!filters.accessibility.mobility || activity.is_accessible_mobility) &&
        (!filters.accessibility.vision || activity.is_accessible_vision) &&
        (!filters.accessibility.hearing || activity.is_accessible_hearing) &&
        (!filters.accessibility.cognitive || activity.is_accessible_cognitive)
      );

      return passesAccessibilityFilter;
    });
  });

  return {
    showFilters,
    months,
    filters,
    toggleMonthFilter,
    toggleSportTypeFilter,
    resetFilters,
    filteredActivities
  };
}
