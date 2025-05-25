<template>

    <Head title="Home Page" />

    <WebsiteLayout>
        <div class="head">
            <div class="container-fluid px-5 py-2">
                <div class="row">
                    <div class="col-3">
                        <h1>Contact Us</h1>
                        <p>This is your profile page. You can Edit Your Profile on this Page and Check Your Statics on this Page.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <div class="container-fluid px-5">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card  rounded-3">

                            <div class="card-body">
                                <div class="form-group mb-4">
                                    <label for="name">Name</label>
                                    <input type="text" :class="{'is-invalid':errors.name}" class="form-control" v-model="form.name" placeholder="Name" />
                                    <InputError :message="errors.name"/>
                                </div>
                                                    
                                <div class="form-group mb-4">
                                    <label for="email">Email</label>
                                    <input type="email" :class="{'is-invalid':errors.email}" class="form-control" v-model="form.email" placeholder="Email" />
                                    <InputError :message="errors.email"/>
                                </div>
                                                    
                                <div class="form-group mb-4">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" :class="{'is-invalid':errors.phone_number}" class="form-control" v-model="form.phone_number" placeholder="Phone Number" />
                                    <InputError :message="errors.phone_number"/>
                                </div>
                                                    
                                <div class="form-group mb-4">
                                    <label for="message">Message</label>
                                    <textarea :class="{'is-invalid':errors.message}" class="form-control" v-model="form.message" placeholder="message"></textarea>
                                    <InputError :message="errors.message"/>
                                </div>

                                <button @click="contact" type="button" class="mb-4 btn btn-primary d-grid w-100">Send</button>
                    
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 contact-desc">
                        <ul>
                            <li>
                                <p class="h1">How Can We Help ?</p>
                            </li>
                            <li class="mb-3">
                                <p class="fw-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, similique, ad perspiciatis delectus, architecto est dolorum officiis obcaecati eveniet dolore esse fuga! Voluptates corporis earum eaque assumenda temporibus, impedit eum.</p>
                            </li>
                            <li class="mb-3">
                                <p class="h4 fw-bold">Title Goes Here</p>
                                <p class="h6 fw-light">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis sunt explicabo inventore unde nulla recusandae sit, numquam suscipit atque esse quas eos, sequi animi tenetur, aspernatur consequuntur. Ipsum, magnam minima.</p>
                            </li>
                            <li class="mb-3">
                                <p class="h4 fw-bold">Title Goes Here</p>
                                <p class="h6 fw-light">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis sunt explicabo inventore unde nulla recusandae sit, numquam suscipit atque esse quas eos, sequi animi tenetur, aspernatur consequuntur. Ipsum, magnam minima.</p>
                            </li>
                            <li class="mb-3">
                                <p class="h4 fw-bold">Title Goes Here</p>
                                <p class="h6 fw-light">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis sunt explicabo inventore unde nulla recusandae sit, numquam suscipit atque esse quas eos, sequi animi tenetur, aspernatur consequuntur. Ipsum, magnam minima.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </WebsiteLayout>

</template>


<script>
import WebsiteLayout from '@/Layouts/Website.vue'
import { Head } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    components: {
        Head,
        WebsiteLayout,
        InputError,
    },
    props:{
        errors:Object
    },
    data(){
        return {
            form:{
                name: null,
                email: null,
                phone_number: null,
                message: null,
            }
        }
    },
    methods:{
        contact(){
            this.$inertia.post(route('contact.submit'), this.form)
        }
    }
}
</script>


<style scoped>
    .head{
        background: rgb(31, 73, 97);
        color: white;
        padding: 50px 0;
    }

    .head h1{
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-style: oblique;
    }
    .body{
        padding:81px;
        position: relative;
    }

    .contact-desc{
        border-left: 1px solid #d2d2d2
    }
</style>