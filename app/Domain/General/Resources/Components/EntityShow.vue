<template>
    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">
                <span class="uppercase">{{ settings.lang.entity }}</span> 
                <strong v-if="settings.lang.title">: {{ settings.entity[settings.lang.title] }}</strong>
            </h3>
        </div>

        <div class="card-body">
            <table class="table p-4">
                <tbody>
                    <tr v-for="(column, index) in settings.columns" :key="index">

                        <td scope="row" class="td-head">
                            <slot :name="'column_label_' + column.key" v-bind="settings.entity">
                                {{ column.label }}
                            </slot>
                        </td>

                        <td class="font-weight-bold">
                            <slot :name="'column_value_' + column.key" v-bind="settings.entity">
                                <span v-if="column.key == 'created_at' || column.key == 'updated_at'">
                                    {{ moment(settings.entity[column.key]) }}
                                </span>
                                <span v-else>
                                    {{ settings.entity[column.key] }}
                                </span>
                            </slot>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <Link v-if="editRoute" class="btn btn-link" :href="$route(editRoute.route, {[settings.routes.bind]: settings.entity.id, ...editRoute.args})">
                Edit
            </Link>
            <button v-if="destroyRoute" type="submit" @click="deleteEntity" class="btn btn-danger mx-2">Delete</button>
            
            <slot name="actions" v-bind="settings.entity"></slot>
        </div>
    </div>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Pagination,
        Link,
    },
    props:{
        settings:{
            type:Object,
            default:{
                entity:{},
                lang: {
                    entity: 'entity',
                    title: 'name',
                },
                routes:{
                    bind: 'id',
                    edit: 'entities.edit',
                    destroy: 'entities.destroy',
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id'
                    },
                    {
                        name: 'Created At',
                        key: 'created_at'
                    },
                    {
                        name: 'Updated At',
                        key: 'updated_at'
                    }
                ]
            }
        },
    },
    methods:{
        deleteEntity(){
            this.$inertia.delete(route(this.destroyRoute.route, {[this.settings.routes.bind]: this.settings.entity.id, ...this.destroyRoute.args}))
        },
    },
    computed:{
        destroyRoute(){
            if(!this.settings.routes.destroy){
                return false;
            }

            let destroyRoute = {};
            if(typeof this.settings.routes.destroy === 'object'){
                destroyRoute = this.settings.routes.destroy
            }else{
                destroyRoute.route = this.settings.routes.destroy;
                destroyRoute.args = {};
            }

            return destroyRoute;
        },
        editRoute(){
            if(!this.settings.routes.edit){
                return false;
            }

            let editRoute = {};
            if(typeof this.settings.routes.edit === 'object'){
                editRoute = this.settings.routes.edit
            }else{
                editRoute.route = this.settings.routes.edit;
                editRoute.args = {};
            }

            return editRoute;
        }
    },
}
</script>

<style scoped>

.table .td-head{
    width: 20%;
}
</style>