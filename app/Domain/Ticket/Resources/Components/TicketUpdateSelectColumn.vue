<template>
    <a href="#" class="ml-3" data-toggle="modal" :data-target="'#changeColumn' + column_key">
        <i class="far fa-edit"></i>
    </a>

    <div class="modal fade" data-backdrop="static" data-keyboard="false"  :id="'changeColumn' + column_key" tabindex="-1" role="dialog" :aria-labelledby="'changeColumnLabel' + column_key" aria-hidden="true">
        <div class="modal-dialog modal-lg text-dark" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ column }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id">{{ column }}</label>
                        <Select2 :settings="settings" v-model="form.id" :class="{'is-invalid':errors[column.key]}" class="grid" :options="_collection"/>

                        <InputError :message="errors[column.key]"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="resetColumn" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" @click="updateColumn" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        collection:Array,
        column:String,
        column_key:String,
        errors:Object,
        ticket:Object,
    },
    data(){
        return {
            form:{
                id: this.ticket[this.column_key],
            },
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    computed:{
        _collection:function(){
            return this.collection.map(entity=>({id:entity.id, text:entity.name}))
        },
    },
    methods:{
        resetColumn(){
            this.form.id = this.ticket[this.column_key];
        },
        updateColumn(){
            this.$emit("updateColumn", {column_id: this.form.id, column_key: this.column_key, column: this.column})
        }
    }
}
</script>

<style scoped>
    .grid{
        width: 100%;
        display: grid;
    }
</style>