<template>
    <div class="flex flex-col min-h-screen bg-gray-50">
      <header class="bg-white bg-opacity-80 backdrop-blur-md sticky top-0 z-50 shadow-sm" role="banner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
          <nav aria-label="Navigation principale" role="navigation">
            <div class="flex justify-between items-center">
              <div class="hidden space-x-8 sm:flex">
                <Link
                  :href="route('home')"
                  class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-full hover:bg-indigo-50 text-gray-700 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                  :class="{ 'bg-indigo-50 text-indigo-700': route().current('home') }"
                  :aria-current="route().current('home') ? 'page' : undefined"
                >
                  Accueil
                </Link>

                <Link
                  :href="route('dashboard')"
                  class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-full hover:bg-indigo-50 text-gray-700 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                  :class="{ 'bg-indigo-50 text-indigo-700': route().current('dashboard') }"
                  :aria-current="route().current('dashboard') ? 'page' : undefined"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                  </svg>
                  Tableau de bord
                </Link>
              </div>

              <div class="flex items-center space-x-4">
                <Link v-if="!$page.props.auth.user"
                  :href="route('login')"
                  class="text-sm text-gray-700 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 px-3 py-2 rounded-full transition-all"
                  aria-label="Se connecter"
                >
                  Se connecter
                </Link>

                <Link v-if="!$page.props.auth.user"
                  :href="route('register')"
                  class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-full font-medium text-sm text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                  aria-label="S'inscrire"
                >
                  S'inscrire
                </Link>

                <div
                  v-if="$page.props.auth.user"
                  ref="dropdownRef"
                  @mouseenter="isDropdownOpen = true"
                  @mouseleave="closeWithDelay"
                  @focusin="isDropdownOpen = true"
                  @focusout="onFocusOut"
                  class="relative"
                >
                  <button
                    ref="dropdownToggleRef"
                    @click="isDropdownOpen = !isDropdownOpen"
                    @keydown.enter.prevent="isDropdownOpen = !isDropdownOpen"
                    @keydown.space.prevent="isDropdownOpen = !isDropdownOpen"
                    @keydown.escape.prevent="isDropdownOpen = false"
                    @keydown.arrow-down.prevent="focusFirstMenuItem"
                    aria-haspopup="true"
                    :aria-expanded="isDropdownOpen.toString()"
                    class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-full px-3 py-2 transition-all"
                  >
                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                      <span class="text-indigo-600 font-medium">{{ $page.props.auth.user.name.charAt(0) }}</span>
                    </div>
                    <span>{{ $page.props.auth.user.name }}</span>
                    <svg
                      class="h-4 w-4"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </button>

                  <ul
                    v-show="isDropdownOpen"
                    class="absolute right-0 mt-2 w-48 py-1 bg-white rounded-lg shadow-lg border border-gray-100"
                    role="menu"
                    aria-orientation="vertical"
                    :aria-labelledby="$refs.dropdownToggleRef?.id"
                    @mouseenter="cancelCloseTimer"
                    @mouseleave="closeWithDelay"
                  >
                    <li>
                      <Link
                        :href="route('dashboard')"
                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 focus:outline-none focus:bg-indigo-50 focus:text-indigo-700 transition-all"
                        role="menuitem"
                        ref="firstMenuItem"
                      >
                        <div class="flex items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                          </svg>
                          Tableau de bord
                        </div>
                      </Link>
                    </li>
                    <li>
                      <Link
                        :href="route('profile.edit')"
                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 focus:outline-none focus:bg-indigo-50 focus:text-indigo-700 transition-all"
                        role="menuitem"
                      >
                        <div class="flex items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                          </svg>
                          Profil
                        </div>
                      </Link>
                    </li>
                    <li class="border-t border-gray-100 mt-1 pt-1">
                      <button
                        @click="logout"
                        class="block w-full text-left px-4 py-2 text-sm leading-5 text-red-600 hover:bg-red-50 focus:outline-none focus:bg-red-50 transition-all"
                        role="menuitem"
                      >
                        <div class="flex items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                          </svg>
                          Se déconnecter
                        </div>
                      </button>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>

      <main id="main-content" class="py-12 flex-grow" role="main">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <slot />
            </div>
          </div>
        </div>
      </main>

      <footer class="bg-indigo-50 mt-auto" role="contentinfo">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
          <div class="flex flex-col md:flex-row md:justify-between items-center">
            <div class="flex items-center mb-4 md:mb-0">
              <span class="font-medium text-gray-700">Access-agenda</span>
            </div>
            <p class="text-gray-500 text-sm">
              &copy; {{ new Date().getFullYear() }} Access-agenda - Tous droits réservés
            </p>
          </div>
        </div>
      </footer>
    </div>
  </template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { onClickOutside } from '@vueuse/core';

const isDropdownOpen = ref(false);
const dropdownRef = ref(null);
const closeTimer = ref(null);

const logout = () => {
  router.post(route('logout'));
};

// Fermeture du menu quand on ne survol plus le menu
const closeWithDelay = () => {
  closeTimer.value = setTimeout(() => {
    isDropdownOpen.value = false;
  }, 200);
};

// Annuler la fermeture si on revient sur le menu
const cancelCloseTimer = () => {
  if (closeTimer.value) {
    clearTimeout(closeTimer.value);
  }
};

// Ferme le menu quand on perd le focus quand on navigue via le clavier
const onFocusOut = (event) => {
  if (dropdownRef.value && !dropdownRef.value.contains(event.relatedTarget)) {
    isDropdownOpen.value = false;
  }
};
</script>
