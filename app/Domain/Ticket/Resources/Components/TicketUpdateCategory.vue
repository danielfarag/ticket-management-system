<template>
    <a href="#" class="ml-3" data-toggle="modal" data-target="#changeCategory">
        <i class="far fa-edit"></i>
    </a>

    <div class="modal fade" data-backdrop="static" data-keyboard="false"  id="changeCategory" tabindex="-1" role="dialog" aria-labelledby="changeCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg text-dark" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <Select2 :settings="settings" v-model="form.category_id" :class="{'is-invalid':errors.category_id}" class="grid" :options="_categories"/>

                        <InputError :message="errors.category_id"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="resetCategory" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" @click="assignCategory" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        categories:Array,
        errors:Object,
        ticket:Object,
    },
    data(){
        return {
            form:{
                category_id: this.ticket.category?.id
            },
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    computed:{
        _categories:function(){
            return this.categories.map(category=>({id:category.id, text:category.name}))
        },
    },
    methods:{
        resetCategory(){
            this.form.category_id = null;
        },
        assignCategory(){
            this.$emit("updateCategory", this.form.category_id)
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