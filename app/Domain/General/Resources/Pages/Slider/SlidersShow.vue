<template>
    <Head :title="'Dashboard - Slider - ' + slider.title" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_image="slider">
                <img width="150" :src="slider.image"/>
            </template>
        </EntityShow>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import EntityShow from '@/Components/EntityShow.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        EntityShow,
    },
    props:{
        slider:Object
    }, 
    computed:{
        settings(){
            return {
                entity: this.slider,
                lang: {
                    entity: 'Slider',
                    title: 'title',
                },
                routes:{
                    bind: 'slider',
                    edit: 'sliders.edit',
                    destroy: 'sliders.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Title',
                        key:'title'
                    },
                    { 
                        label:'Subtitle',
                        key:'subtitle'
                    },
                    { 
                        label:'Button',
                        key:'button'
                    },
                    { 
                        label:'Link',
                        key:'link'
                    },
                    { 
                        label:'Image',
                        key:'image'
                    },
                    { 
                        label:'Status',
                        key:'status'
                    },
                    { 
                        label:'Created At',
                        key:'created_at'
                    },
                    { 
                        label:'Updated At',
                        key:'updated_at'
                    },
                ]
            }
        }
    },
}
</script>
