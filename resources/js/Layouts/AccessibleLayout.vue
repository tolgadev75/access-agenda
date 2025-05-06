<template>
    <div class="flex flex-col min-h-screen bg-gray-100">

      <header class="bg-white shadow" role="banner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
          <nav aria-label="Navigation principale" role="navigation">
            <div class="flex justify-between items-center">
              <div class="flex shrink-0 items-center">
                <Link :href="route('dashboard')">
                  <h1 class="text-xl font-bold text-gray-900">Tableau de bord</h1>
                </Link>
              </div>

              <div class="hidden space-x-8 sm:flex">
                <Link
                  :href="route('home')"
                  class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition"
                  :aria-current="route().current('home') ? 'page' : undefined"
                >
                  Accueil
                </Link>
              </div>

              <div class="flex items-center space-x-4">
                <Link v-if="!$page.props.auth.user"
                  :href="route('login')"
                  class="text-sm text-gray-700 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 px-3 py-2 hover:bg-gray-50"
                  aria-label="Se connecter"
                >
                  Se connecter
                </Link>

                <Link v-if="!$page.props.auth.user"
                  :href="route('register')"
                  class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                  aria-label="S'inscrire"
                >
                  S'inscrire
                </Link>

                <div
                  v-if="$page.props.auth.user"
                  ref="dropdownRef"
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
                    aria-haspopup="true"
                    :aria-expanded="isDropdownOpen.toString()"
                    class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out"
                  >
                    <span>{{ $page.props.auth.user.name }}</span>
                    <svg
                      class="ml-2 -mr-0.5 h-4 w-4"
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
                    class="absolute right-0 mt-2 w-48 py-1 bg-white rounded-md shadow-lg"
                    role="menu"
                    aria-orientation="vertical"
                    :aria-labelledby="$refs.dropdownToggleRef?.id"
                  >
                    <li>
                      <Link
                        :href="route('dashboard')"
                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                        role="menuitem"
                      >
                        Tableau de bord
                      </Link>
                    </li>
                    <li>
                      <Link
                        :href="route('profile.edit')"
                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                        role="menuitem"
                      >
                        Profil
                      </Link>
                    </li>
                    <li>
                      <button
                        @click="logout"
                        class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                        role="menuitem"
                      >
                        Se déconnecter
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

      <footer class="bg-white shadow mt-auto" role="contentinfo">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <p class="text-center text-gray-500 text-sm">
            &copy; {{ new Date().getFullYear() }} Access-agenda
          </p>
        </div>
      </footer>
    </div>
  </template>

  <script setup>
  import { Link, router } from '@inertiajs/vue3';
  import { ref } from 'vue';
  import { onClickOutside } from '@vueuse/core';

  const isDropdownOpen = ref(false);
  const dropdownToggleRef = ref(null);

  const logout = () => {
    router.post(route('logout'));
  };

  // Fermer le menu déroulant quand on clique en dehors
  onClickOutside(dropdownToggleRef, () => {
    isDropdownOpen.value = false;
  });
  </script>
