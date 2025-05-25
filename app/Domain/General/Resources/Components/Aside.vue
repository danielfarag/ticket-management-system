<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a :href="$route('dashboard')" class="brand-link">
      <img src="/adminlte/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">{{ app_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/adminlte/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <Link :href="$route('dashboard.me')" class="d-block">{{ user.name }} <span class="badge badge-primary">{{ user.type }}</span></Link>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          

          <li v-for="(nav,index) in activeNavigation" :key="index" :class="{
            'nav-header': nav.type == 'head',
            'nav-item': nav.type == 'single' || nav.type == 'multi' ,
            'menu-open': nav.type == 'multi' && routeIs(nav.open, route_name)
          }">
            <span v-if="nav.type == 'head'"> {{ nav.label }}</span>

            <Link v-if="nav.type == 'single'" :href="nav.href" class="nav-link" :class="{'active':routeIs(nav.route, route_name)}">
              <i :class="nav.icon"></i>
              <p>
                {{ nav.label }}
                <span v-if="nav.badge" class="badge badge-info right">{{ nav.badge }}</span>
              </p>
            </Link>

            <a v-if="nav.type == 'multi'" href="#" class="nav-link" :class="{'active':routeIs(nav.open, route_name)}">
              <i :class="nav.icon"></i>
              <p>
                {{ nav.label }}
                <i class="fas fa-angle-left right"></i>
                <span v-if="nav.badge" class="badge badge-info right">{{ nav.badge }}</span>
              </p>
            </a>

            <ul v-if="nav.type == 'multi'" class="nav nav-treeview">
              <li v-for="(menu,index) in nav.menu" :key="index" class="nav-item">
                <Link v-if="menu.route != 'export'" :href="menu.href" class="nav-link" :class="{'active':routeIs(routeName(menu.route), route_name)}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ menu.name }}</p>
                </Link>
                <a v-else target="_blank" :href="menu.href" class="nav-link" :class="{'active':routeIs(routeName(menu.route), route_name)}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ menu.name }}</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>


<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
  components:{
    Link
  },
  computed: {
      activeNavigation(){
        return this.navigation.filter(el=>{
          if(el.menu){
            el.menu = el.menu.filter(sub=>sub.show)
          }
          return el.show;
        })
      },
      navigation(){
        return [
        {
          type :'single',
          label: 'Dashboard',
          icon: 'nav-icon fas fa-home',
          badge: false,
          route: 'dashboard',
          href: route('dashboard'),
          show: true,
        },
        {
          type :'single',
          label: 'Todos',
          icon: 'nav-icon fas fa-tasks',
          badge: false,
          route: 'todos.index',
          href: route('todos.index'),
          show: this.can.manage_todos,
        },
        {
          type: 'head',
          label: 'User Management',
          show: this.can.manage_users || this.can.manage_roles,
        },
        {
          type :'multi',
          label: 'Users',
          icon: 'nav-icon fas fa-users',
          badge: false,
          route: false,
          open: 'users.*',
          show: this.can.manage_users,
          menu: [
            {
              name: 'List Users',
              route: 'users.index',
              href: route('users.index'),
              show: this.can.read_user,
            },
            {
              name: 'Create User',
              route: 'users.create',
              href: route('users.create'),
              show: this.can.create_user,
            },
            {
              name: 'Import Users',
              route: 'import',
              href: route('import', 'users'),
              show: this.can.import_user,
            },
            {
              name: 'Export Users',
              route: 'export',
              href: route('export', 'users'),
              show: this.can.export_user,
            }
          ]
        },
        {
          type :'multi',
          label: 'Roles',
          icon: 'nav-icon fas fa-user-shield',
          badge: false,
          route: false,
          open: 'roles.*',
          show: this.can.manage_roles,
          menu: [
            {
              name: 'List Roles',
              route: 'roles.index',
              href: route('roles.index'),
              show: this.can.read_role,
            },
            {
              name: 'Create Role',
              route: 'roles.create',
              href: route('roles.create'),
              show: this.can.create_role,
            },
            {
              name: 'Import Roles',
              route: 'import',
              href: route('import', 'roles'),
              show: this.can.import_role,
            },
            {
              name: 'Export Roles',
              route: 'export',
              href: route('export', 'roles'),
              show: this.can.export_role,
            }
          ]
        },
        {
          type: 'head',
          label: 'Ticket Management',
          show: this.can.manage_tickets || this.can.manage_statuses || this.can.manage_severities || this.can.manage_departments,
        },
        {
          type :'multi',
          label: 'Tickets',
          icon: 'nav-icon fas fa-ticket-alt',
          badge: this.count_tickets,
          route: false,
          open: 'tickets.*',
          show: this.can.manage_tickets,
          menu: [
            {
              name: 'List Tickets',
              route: 'tickets.index',
              href: route('tickets.index'),
              show: this.can.read_ticket,
            },
            {
              name: 'Create Ticket',
              route: 'tickets.create',
              href: route('tickets.create'),
              show: this.can.create_ticket,
            },
            {
              name: 'Categories',
              route: {route: 'categories.index', args:{type:'tickets'}},
              href: route('categories.index', {type:'tickets'}),
              show: this.can.manage_ticket_categories,
            },
            {
              name: 'Import Tickets',
              route: 'import',
              href: route('import', 'tickets'),
              show: this.can.import_ticket,
            },
            {
              name: 'Export Tickets',
              route: 'export',
              href: route('export', 'tickets'),
              show: this.can.export_ticket,
            }
          ]
        },
        {
          type :'multi',
          label: 'Statuses',
          icon: 'nav-icon fas fa-bezier-curve',
          badge: false,
          route: false,
          open: 'statuses.*',
          show: this.can.manage_statuses,
          menu: [
            {
              name: 'List Statuses',
              route: 'statuses.index',
              href: route('statuses.index'),
              show: this.can.read_status,
            },
            {
              name: 'Create Status',
              route: 'statuses.create',
              href: route('statuses.create'),
              show: this.can.create_status,
            },
            {
              name: 'Import Statuses',
              route: 'import',
              href: route('import', 'statuses'),
              show: this.can.import_status,
            },
            {
              name: 'Export Statuses',
              route: 'export',
              href: route('export', 'statuses'),
              show: this.can.export_status,
            }
          ]
        },
        {
          type :'multi',
          label: 'Severities',
          icon: 'nav-icon fas fa-arrow-alt-circle-up',
          badge: false,
          route: false,
          open: 'severities.*',
          show: this.can.manage_severities,
          menu: [
            {
              name: 'List Severities',
              route: 'severities.index',
              href: route('severities.index'),
              show: this.can.read_severity,
            },
            {
              name: 'Create Severity',
              route: 'severities.create',
              href: route('severities.create'),
              show: this.can.create_severity,
            },
            {
              name: 'Import Severities',
              route: 'import',
              href: route('import', 'severities'),
              show: this.can.import_severity,
            },
            {
              name: 'Export Severities',
              route: 'export',
              href: route('export', 'severities'),
              show: this.can.export_severity,
            }
          ]
        },
        {
          type :'multi',
          label: 'Departments',
          icon: 'nav-icon fas fa-copy',
          badge: false,
          route: false,
          open: 'departments.*',
          show: this.can.manage_departments,
          menu: [
            {
              name: 'List Departments',
              route: 'departments.index',
              href: route('departments.index'),
              show: this.can.read_department,
            },
            {
              name: 'Create Department',
              route: 'departments.create',
              href: route('departments.create'),
              show: this.can.create_department,
            },
            {
              name: 'Import Departments',
              route: 'import',
              href: route('import', 'departments'),
              show: this.can.import_department,
            },
            {
              name: 'Export Departments',
              route: 'export',
              href: route('export', 'departments'),
              show: this.can.export_department,
            }
          ]
        },
        {
          type: 'head',
          label: 'Customer Relation Management',
          show: this.can.manage_surveys || this.can.manage_escalations || this.can.manage_announcements || this.can.manage_contacts,
        },
        {
          type :'multi',
          label: 'Surveys',
          icon: 'nav-icon fas fa-star-half-alt',
          badge: false,
          route: false,
          open: 'surveys.*',
          show: this.can.manage_surveys,
          menu: [
            {
              name: 'List Surveys',
              route: 'surveys.index',
              href: route('surveys.index'),
              show: this.can.read_survey,
            },
            {
              name: 'Import Surveys',
              route: 'import',
              href: route('import', 'surveys'),
              show: this.can.import_survey,
            },
            {
              name: 'Export Surveys',
              route: 'export',
              href: route('export', 'surveys'),
              show: this.can.export_survey,
            }
          ]
        },
        {
          type :'multi',
          label: 'Escalations',
          icon: 'nav-icon fas fa-exclamation',
          badge: this.count_escalations,
          route: false,
          open: 'escalations.*',
          show: this.can.manage_escalations,
          menu: [
            {
              name: 'List Escalations',
              route: 'escalations.index',
              href: route('escalations.index'),
              show: this.can.read_escalation,
            },
            {
              name: 'Create Escalation',
              route: 'escalations.create',
              href: route('escalations.create'),
              show: this.can.create_escalation,
            },
            {
              name: 'Import Escalations',
              route: 'import',
              href: route('import', 'escalations'),
              show: this.can.import_escalation,
            },
            {
              name: 'Export Escalations',
              route: 'export',
              href: route('export', 'escalations'),
              show: this.can.export_escalation,
            }
          ]
        },
        {
          type :'multi',
          label: 'Announcements',
          icon: 'nav-icon fas fa-copy',
          badge: false,
          route: false,
          open: 'announcements.*',
          show: this.can.manage_announcements,
          menu: [
            {
              name: 'List Announcements',
              route: 'announcements.index',
              href: route('announcements.index'),
              show: this.can.read_announcement,
            },
            {
              name: 'Create Announcement',
              route: 'announcements.create',
              href: route('announcements.create'),
              show: this.can.create_announcement,
            },
            {
              name: 'Import Announcements',
              route: 'import',
              href: route('import', 'announcements'),
              show: this.can.import_announcement,
            },
            {
              name: 'Export Announcements',
              route: 'export',
              href: route('export', 'announcements'),
              show: this.can.export_announcement,
            }
          ]
        },
        {
          type :'single',
          label: 'Contact',
          icon: 'nav-icon fas fa-phone-square-alt',
          badge: false,
          route: 'contacts.index',
          href: route('contacts.index'),
          show: this.can.manage_contacts,
        },
        {
          type: 'head',
          label: 'Mail Management',
          show: this.can.manage_mails || this.can.manage_mail_templates,
        },
        {
          type :'multi',
          label: 'Mails',
          icon: 'nav-icon fas fa-envelope-open',
          badge: false,
          route: false,
          open: 'mails.*',
          show: this.can.manage_mails,
          menu: [
            {
              name: 'List Mails',
              route: 'mails.index',
              href: route('mails.index'),
              show: this.can.read_mail,
            },
            {
              name: 'Create Mail',
              route: 'mails.create',
              href: route('mails.create'),
              show: this.can.create_mail,
            },
            {
              name: 'Import Mails',
              route: 'import',
              href: route('import', 'mails'),
              show: this.can.import_mail,
            },
            {
              name: 'Export Mails',
              route: 'export',
              href: route('export', 'mails'),
              show: this.can.export_mail,
            }
          ]
        },
        {
          type :'multi',
          label: 'Mail Templates',
          icon: 'nav-icon fas fa-mail-bulk',
          badge: false,
          route: false,
          open: 'mail_templates.*',
          show: this.can.manage_mail_templates,
          menu: [
            {
              name: 'List Mail Templates',
              route: 'mail_templates.index',
              href: route('mail_templates.index'),
              show: this.can.read_mail_template,
            },
            {
              name: 'Create Mail Template',
              route: 'mail_templates.create',
              href: route('mail_templates.create'),
              show: this.can.create_mail_template,
            },
            {
              name: 'Import Mail Templates',
              route: 'import',
              href: route('import', 'mail_templates'),
              show: this.can.import_mail_template,
            },
            {
              name: 'Export Mail Templates',
              route: 'export',
              href: route('export', 'mail_templates'),
              show: this.can.export_mail_template,
            }
          ]
        },
        {        
          type: 'head',
          label: 'Knowledge Base Management',
          show: this.can.manage_articles || this.can.manage_faqs,
        },
        {
          type :'multi',
          label: 'Faqs',
          icon: 'nav-icon fas fa-question-circle',
          badge: false,
          route: false,
          open: 'faqs.*',
          show: this.can.manage_faqs,
          menu: [
            {
              name: 'List Faqs',
              route: 'faqs.index',
              href: route('faqs.index'),
              show: this.can.read_faq,
            },
            {
              name: 'Create Faq',
              route: 'faqs.create',
              href: route('faqs.create'),
              show: this.can.create_faq,
            },
            {
              name: 'Import Faqs',
              route: 'import',
              href: route('import', 'faqs'),
              show: this.can.import_faq,
            },
            {
              name: 'Export Faqs',
              route: 'export',
              href: route('export', 'faqs'),
              show: this.can.export_faq,
            }
          ]
        },
        {
          type :'multi',
          label: 'Articles',
          icon: 'nav-icon fas fa-newspaper',
          badge: false,
          route: false,
          open: 'articles.*',
          show: this.can.manage_articles,
          menu: [
            {
              name: 'List Articles',
              route: 'articles.index',
              href: route('articles.index'),
              show: this.can.read_article,
            },
            {
              name: 'Create Article',
              route: 'articles.create',
              href: route('articles.create'),
              show: this.can.create_article,
            },
            {
              name: 'Categories',
              route: {route: 'categories.index', args:{type:'articles'}},
              href: route('categories.index', {type:'articles'}),
              show: this.can.manage_article_categories,
            },
            {
              name: 'Import Articles',
              route: 'import',
              href: route('import', 'articles'),
              show: this.can.import_article,
            },
            {
              name: 'Export Articles',
              route: 'export',
              href: route('export', 'articles'),
              show: this.can.export_article,
            }
          ]
        },
        {        
          type: 'head',
          label: 'Setting Management',
          show: this.can.manage_settings || this.can.manage_block_ips || this.can.manage_quick_links || this.can.manage_services || this.can.manage_sliders,
        },
        {
          type :'multi',
          label: 'Block Ips',
          icon: 'nav-icon fas fa-ban',
          badge: false,
          route: false,
          open: 'block_ips.*',
          show: this.can.manage_block_ips,
          menu: [
            {
              name: 'List Block Ips',
              route: 'block_ips.index',
              href: route('block_ips.index'),
              show: this.can.read_block_ip,
            },
            {
              name: 'Create Block Ip',
              route: 'block_ips.create',
              href: route('block_ips.create'),
              show: this.can.create_block_ip,
            },
            {
              name: 'Import Block Ips',
              route: 'import',
              href: route('import', 'block_ips'),
              show: this.can.import_block_ip,
            },
            {
              name: 'Export Block Ips',
              route: 'export',
              href: route('export', 'block_ips'),
              show: this.can.export_block_ip,
            }
          ]
        },
        {
          type :'multi',
          label: 'Quick Links',
          icon: 'nav-icon fas fa-dice-three',
          badge: false,
          route: false,
          open: 'quick_links.*',
          show: this.can.manage_quick_links,
          menu: [
            {
              name: 'List Quick Links',
              route: 'quick_links.index',
              href: route('quick_links.index'),
              show: this.can.read_quick_link,
            },
            {
              name: 'Create Quick Link',
              route: 'quick_links.create',
              href: route('quick_links.create'),
              show: this.can.create_quick_link,
            },
            {
              name: 'Import Quick Links',
              route: 'import',
              href: route('import', 'quick_links'),
              show: this.can.import_quick_link,
            },
            {
              name: 'Export Quick Links',
              route: 'export',
              href: route('export', 'quick_links'),
              show: this.can.export_quick_link,
            }
          ]
        },
        {
          type :'multi',
          label: 'Serivces',
          icon: 'nav-icon fas fa-usps',
          badge: false,
          route: false,
          open: 'services.*',
          show: this.can.manage_services,
          menu: [
            {
              name: 'List Serivces',
              route: 'services.index',
              href: route('services.index'),
              show: this.can.read_service,
            },
            {
              name: 'Create Serivce',
              route: 'services.create',
              href: route('services.create'),
              show: this.can.create_service,
            },
            {
              name: 'Import Serivces',
              route: 'import',
              href: route('import', 'services'),
              show: this.can.import_service,
            },
            {
              name: 'Export Serivces',
              route: 'export',
              href: route('export', 'services'),
              show: this.can.export_service,
            }
          ]
        },
        {
          type :'multi',
          label: 'Sliders',
          icon: 'nav-icon fas fa-images',
          badge: false,
          route: false,
          open: 'sliders.*',
          show: this.can.manage_sliders,
          menu: [
            {
              name: 'List Sliders',
              route: 'sliders.index',
              href: route('sliders.index'),
              show: this.can.read_slider,
            },
            {
              name: 'Create Slider',
              route: 'sliders.create',
              href: route('sliders.create'),
              show: this.can.create_slider,
            },
            {
              name: 'Import Sliders',
              route: 'import',
              href: route('import', 'sliders'),
              show: this.can.import_slider,
            },
            {
              name: 'Export Sliders',
              route: 'export',
              href: route('export', 'sliders'),
              show: this.can.export_slider,
            }
          ]
        },
        {
          type :'multi',
          label: 'Members',
          icon: 'nav-icon fas fa-user-tie',
          badge: false,
          route: false,
          open: 'members.*',
          show: this.can.manage_members,
          menu: [
            {
              name: 'List Members',
              route: 'members.index',
              href: route('members.index'),
              show: this.can.read_member,
            },
            {
              name: 'Create Member',
              route: 'members.create',
              href: route('members.create'),
              show: this.can.create_member,
            },
            {
              name: 'Import Members',
              route: 'import',
              href: route('import', 'members'),
              show: this.can.import_member,
            },
            {
              name: 'Export Members',
              route: 'export',
              href: route('export', 'members'),
              show: this.can.export_member,
            }
          ]
        },
        {
          type :'single',
          label: 'Settings',
          icon: 'nav-icon fas fa-cogs',
          badge: false,
          route: 'settings.index',
          href: route('settings.index'),
          show: this.can.manage_settings,
        },
      ]
    },
    user() {
        return this.$page.props.auth.user
    },
    can() {
        return this.$page.props.auth.can
    },
    app_name() {
        return this.$page.props.app_name
    },
    route_name() {
        return this.$page.props.route_name
    },
    count_tickets(){
      return this.$page.props.active_tickets
    },
    count_escalations(){
      return this.$page.props.active_escalations
    },
  },
  methods:{
    routeName(route){
      return route;
    }
  }
}
</script>

<style scoped>
  .brand-image{
    opacity: 0.8
  }
  .nav-header{
    margin-top: 10px;
    color:white
  }

  .main-sidebar{
    position: fixed !important; 
  }
</style>