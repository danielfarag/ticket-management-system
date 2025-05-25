<template>
    <div :class="{'active': tab == 'home'}" class="tab-pane" id="home">
        <div class="form-group row">
            <label for="show_slider" class="col-sm-2 col-form-label">Show Slider</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.show_slider"  class="custom-control-input" id="show_slider">
                    <label class="custom-control-label" for="show_slider"></label>
                </div>
                <InputError :message="errors.show_slider"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="show_search" class="col-sm-2 col-form-label">Show Search</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.show_search"  class="custom-control-input" id="show_search">
                    <label class="custom-control-label" for="show_search"></label>
                </div>
                <InputError :message="errors.show_search"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="show_departments" class="col-sm-2 col-form-label">Show Departments</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.show_departments"  class="custom-control-input" id="show_departments">
                    <label class="custom-control-label" for="show_departments"></label>
                </div>
                <InputError :message="errors.show_departments"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="show_submit_ticket" class="col-sm-2 col-form-label">Show Submit Ticket</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.show_submit_ticket"  class="custom-control-input" id="show_submit_ticket">
                    <label class="custom-control-label" for="show_submit_ticket"></label>
                </div>
                <InputError :message="errors.show_submit_ticket"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="show_faq" class="col-sm-2 col-form-label">Show FAQ</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.show_faq"  class="custom-control-input" id="show_faq">
                    <label class="custom-control-label" for="show_faq"></label>
                </div>
                <InputError :message="errors.show_faq"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="show_help" class="col-sm-2 col-form-label">Show Help</label>
            <div class="col-sm-10">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" @input="$emit('updated', form)" v-model="form.show_help"  class="custom-control-input" id="show_help">
                    <label class="custom-control-label" for="show_help"></label>
                </div>
                <InputError :message="errors.show_help"/>
            </div>
        </div>
    </div>
</template>

<script>
import InputError from '@/Components/InputError.vue';
export default {
    components:{
        InputError,
    },
    props:{
        settings:Object,
        errors:Object,
        tab:String,
    },
    data(){
        return {
            form:{
                show_slider:false,
                show_search:false,
                show_departments:false,
                show_submit_ticket:false,
                show_faq:false,
                show_help:false,
            }
        }
    },
    watch:{
        errors:function(value){
            if(value.show_slider  ==  undefined && 
            value.show_search  ==  undefined &&
            value.show_departments  ==  undefined &&
            value.show_submit_ticket  ==  undefined &&
            value.show_faq  ==  undefined &&
            value.show_help  ==  undefined){
                    this.$emit('onErrors', {key:'home', value:false});
                }else{
                    this.$emit('onErrors', {key:'home', value:true});
                }
        }
    },
    mounted(){
        this.form.show_slider = this.isUndefined(this.settings.show_slider,false)  == true;
        this.form.show_search = this.isUndefined(this.settings.show_search,false)  == true;
        this.form.show_departments = this.isUndefined(this.settings.show_departments,false)  == true;
        this.form.show_submit_ticket = this.isUndefined(this.settings.show_submit_ticket,false)  == true;
        this.form.show_faq = this.isUndefined(this.settings.show_faq,false)  == true;
        this.form.show_help = this.isUndefined(this.settings.show_help,false)  == true;
        this.$emit('updated', this.form);
    },
}
</script>