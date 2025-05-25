<template>

  <div class="container">
      <div class="row">
          <div class="col text-center">
              <ul class="list-inline">

                  <li class="list-inline-item" v-for="(page,index) in data.links" :key="index">

                    <InertiaLink v-if="index == 0 " class="btn btn-primary" :class="{'disabled': page.active || page.url == null}" :href="page.url">
                      <font-awesome-icon icon="angle-left"/>
                    </InertiaLink>
                    
                    <InertiaLink v-if="index > 0 && index < data.links.length - 1 " class="btn btn-primary" :class="{'disabled': page.active || page.url == null}" :href="page.url">
                      {{ page.label }}
                    </InertiaLink>

                    <InertiaLink v-if="index == data.links.length - 1" class="btn btn-primary" :class="{'disabled': page.active || page.url == null}" :href="page.url">
                      <font-awesome-icon icon="angle-right"/>
                    </InertiaLink>
                  </li>
              </ul>
          </div>
      </div>
  </div>

</template>

<script>
    import { InertiaLink } from '@inertiajs/inertia-vue3';

    export default {
      components:{
        InertiaLink
      },
      props: {
        data: Object
      },
    }
</script>