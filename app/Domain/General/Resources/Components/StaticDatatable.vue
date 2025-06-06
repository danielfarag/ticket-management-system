<template>
    <div class="card">
        <div class="card-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <p class="h3">{{ settings.lang.title }}</p>
                    </div>
                    <div class="col text-right" v-if="settings.hasHeaderActions">
                        <slot name="header_actions">
                            <Link v-if="createRoute.route" :href="$route(createRoute.route, createRoute.args)" class="btn btn-secondary">
                                <font-awesome-icon icon="plus" />
                                {{ settings.lang.create }}
                            </Link>
                            <a v-if="settings.routes.import" target="_blank" :href="$route('export', settings.routes.import)" class="btn btn-secondary mx-2">
                                <font-awesome-icon icon="download" />
                                {{ settings.lang.export }}
                            </a>
                            <Link v-if="settings.routes.import" :href="$route('import', settings.routes.import)" class="btn btn-secondary">
                                <font-awesome-icon icon="upload" />
                                {{ settings.lang.import }}
                            </Link>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hovered datatable">
                <thead>
                    <tr>
                        <th :width="column.width ?? (100/settings.columns.length)+'%'" v-for="(column, index) in settings.columns" :key="index">
                            <span>
                                {{ column.name }} 
                            </span>
                        </th>
                        <th width="160px" v-if="settings.hasActions"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="obj in settings.collection" :key="obj.id">
                        <td v-for="(column, index) in settings.columns" :key="index">
                            <slot :name="'column_' + column.key" v-bind="obj">
                                {{ obj[column.key] }}
                            </slot>
                        </td>
                        <td v-if="settings.hasActions">
                            <slot name="actions" v-bind="obj">
                                <Link class="btn btn-link" :href="$route(showRoute.route, {[settings.routes.bind]: obj.id, ...showRoute.args })">
                                    <font-awesome-icon icon="eye" />
                                </Link>

                                <button @click="deleteEntity(obj)" class="btn btn-link text-danger">
                                    <font-awesome-icon icon="trash" />
                                </button>

                                <Link v-if="editRoute.route" class="btn btn-link text-info" :href="$route(editRoute.route, {[settings.routes.bind]: obj.id, ...editRoute.args })">
                                    <font-awesome-icon icon="edit" />
                                </Link>
                            </slot>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Link,
    },
    props:{
        settings:{
            type:Object,
            default:{
                collection:[],
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Entities',
                    create: 'Create Entity',
                    export: 'Export Entities',
                    import: 'Import Entities',
                },
                routes:{
                    bind: 'id',
                    index: 'entities.index',
                    create: 'entities.create',
                    show: 'entities.show',
                    edit: 'entities.edit',
                    destroy: 'entities.destroy',
                    import: 'key',
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
    mounted(){
    },
    methods:{
        deleteEntity(entity){
            this.$inertia.delete(route(this.destroyRoute.route, {[this.settings.routes.bind]: entity.id, ...this.destroyRoute.args}))
        },
    },
    data(){
        return {
            params:{},
            select2:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    computed:{
        request() {
            return this.$page.props.request
        },
        createRoute(){
            let createRoute = {};
            if(typeof this.settings.routes.create === 'object'){
                createRoute = this.settings.routes.create
            }else{
                createRoute.route = this.settings.routes.create;
                createRoute.args = {};
            }

            return createRoute;
        },
        indexRoute(){
            let indexRoute = {};
            if(typeof this.settings.routes.index === 'object'){
                indexRoute = this.settings.routes.index
            }else{
                indexRoute.route = this.settings.routes.index;
                indexRoute.args = {};
            }

            return indexRoute;
        },
        destroyRoute(){
            let destroyRoute = {};
            if(typeof this.settings.routes.destroy === 'object'){
                destroyRoute = this.settings.routes.destroy
            }else{
                destroyRoute.route = this.settings.routes.destroy;
                destroyRoute.args = {};
            }

            return destroyRoute;
        },
        showRoute(){
            let showRoute = {};
            if(typeof this.settings.routes.show === 'object'){
                showRoute = this.settings.routes.show
            }else{
                showRoute.route = this.settings.routes.show;
                showRoute.args = {};
            }

            return showRoute;
        },
        editRoute(){
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

    .datatable th button.active font-awsome-icon{
        color:rgb(131, 131, 131);
    }
    
    .datatable th{
        background-color: #f7f7f7;
    }

    .datatable th button{
        color:#4b8dd5
    }
    .datatable th{
        vertical-align: middle;
    }

</style>