<template>
    <div :class="{'active': tab == 'terms'}" class="tab-pane" id="terms">
        <div class="form-group row">
            <label for="terms" class="col-sm-2 col-form-label">Terms & Conditions</label>
            <div class="col-sm-10">
                <editor v-model="form.terms_conditions" @input="$emit('updated', form)" :class="{'is-invalid':errors.terms_conditions}" id="terms_conditions" :api-key="editorApiKey" placeholder="Terms & Conditions"/>
                <InputError :message="errors.terms_conditions"/>
            </div>
        </div>
    
        <div class="form-group row">
            <label for="about" class="col-sm-2 col-form-label">About</label>
            <div class="col-sm-10">
                <editor v-model="form.about" @input="$emit('updated', form)" :class="{'is-invalid':errors.about}" id="about" :api-key="editorApiKey" placeholder="About"/>
                <InputError :message="errors.about"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="privacy_policy" class="col-sm-2 col-form-label">Privacy Policy</label>
            <div class="col-sm-10">
                <editor v-model="form.privacy_policy" @input="$emit('updated', form)" :class="{'is-invalid':errors.privacy_policy}" id="privacy_policy" :api-key="editorApiKey" placeholder="Privacy Policy"/>
                <InputError :message="errors.privacy_policy"/>
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
                terms_conditions:null,
                about:null,
                privacy_policy:null
            }
        }
    },
    watch:{
        errors:function(value){
            if(value.terms_conditions  ==  undefined &&
                value.about  ==  undefined &&
                value.privacy_policy  ==  undefined ){
                    this.$emit('onErrors', {key:'terms', value:false});
                }else{
                    this.$emit('onErrors', {key:'terms', value:true});
                }
        }
    },
    mounted(){
        this.form.terms_conditions = this.isUndefined(this.settings.terms_conditions);
        this.form.about = this.isUndefined(this.settings.about);
        this.form.privacy_policy = this.isUndefined(this.settings.privacy_policy);
        this.$emit('updated', this.form);
    },
}
</script>