<style>
    .widget-user .widget-user-header{
        height: 250px;
        background-size: cover !important;
    }
    .widget-user .card-footer{
        padding-top: 0;
    }
</style>


<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-dark" style="background: url('./img/Tulips.jpg') center center;">
                        <h3 class="widget-user-username">Elizabeth Pierce</h3>
                        <h5 class="widget-user-desc">Web Designer</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">3,200</h5>
                            <span class="description-text">SALES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">13,000</h5>
                            <span class="description-text">FOLLOWERS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">35</h5>
                            <span class="description-text">PRODUCTS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    </div>
                    <!-- /.widget-user -->
                </div>


                 <div class="col-md-9">
                    <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            
                        </div>
                       
                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-12">
                                    <input type="email" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" id="inputName" placeholder="Name">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-12">
                                    <input type="email" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control"  id="inputEmail" placeholder="Email">
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                <div class="col-sm-12">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo" class="col-sm-12 control-label">Profile Photo</label>
                                <div class="col-sm-12">
                                    <input type="file" @change="uploadPhoto" class="form-input" name="photo" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-12 control-label">Password (leave empty if not changing)</label>
                                <div class="col-sm-12">
                                    <input type="password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" id="password" placeholder="passport">
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                <button type="submit" @click.prevent="updateInfo" class="btn btn-success">Update</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>   


            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                form: new Form({
                    id: '',
                    name : '',
                    email : '',
                    password : '',
                    type : '',
                    bio : '',
                    photo : ''
                })
            }
        },

        methods:{

            getProfilePhoto(){

                let photo = ( this.form.photo.length > 200 ) ? this.form.photo : "img/profilephoto/"+ this.form.photo;
                return photo;
            },

            updateInfo(){
                this.$Progress.start();

                this.form.put('api/profile')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(()=>{

                    this.$Progress.fail();
                });    
            },
            uploadPhoto(e){
                //console.log('photoupload');
                let file = e.target.files[0];
                //console.log(file);
                let reader = new FileReader();
                
                if(file['size'] < 2097152){
                    reader.onloadend = (file) => {
                        //console.log('RESULT', reader.result);
                        this.form.photo = reader.result;
                    }
                    reader.readAsDataURL(file);
                
                }else{
                        swal.fire({
                                type:'error',
                                text:'Your file is very large.',
                                title:'Oops...'
                        })
                }
            }
        },
        created(){
            axios.get('api/profile')
            .then(({ data }) => (this.form.fill(data)));
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
