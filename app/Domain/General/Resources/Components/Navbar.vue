<template>
    
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <Link :href="$route('dashboard')" class="nav-link">Home</Link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <Link :href="$route('users.index')" class="nav-link">Users</Link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <Link :href="$route('settings.index')" class="nav-link">Settings</Link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <Link :href="$route('tickets.index')" class="nav-link">Tickets</Link>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <DashboardSearch />
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <DashboardNotifications />
      </li>

      <li class="nav-item">
        <DashboardFullscreen />
      </li>

      <li class="nav-item">
        <DashboardLogout />
      </li>
    </ul>
  </nav>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import DashboardSearch from '@/Components/DashboardSearch.vue'
import DashboardNotifications from '@/Components/DashboardNotifications.vue'
import DashboardMessages from '@/Components/DashboardMessages.vue'
import DashboardFullscreen from '@/Components/DashboardFullscreen.vue'
import DashboardLogout from '@/Components/DashboardLogout.vue'

export default {
    components: {
        Link,
        DashboardSearch,
        DashboardNotifications,
        DashboardMessages,
        DashboardFullscreen,
        DashboardLogout,
    },
}
</script>
