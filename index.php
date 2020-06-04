<!DOCTYPE html>
<html>

<head>
    <title>Landing Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.13.1/lodash.min.js"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark black">
        <div class="container">
            <a class="navbar-brand" href="#"><strong>Navbar</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="view intro-2">
        <div class="full-bg-img">
            <div class="mask rgba-black-strong flex-center">
                <div class="container">
                    <div class="white-text text-center wow fadeInUp">
                        <h2>AutoSales</h2>
                        <h4>This is Landing Page</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<h2 class="text-center"></h2>
<div class="container">


    <div id="app">

        <div  v-for="(car,index) in cars" class="row image-row col-md-11">
            <div class="col-md-4">
                <img class="card-img-top" :src="'/img/' + car.src" alt="Card image cap" :id="car.id">
            </div>
            <div class="col-md-5">
                <h5 class="card-title">{{car.title}}
                    <button class="btn btn-danger float-right" v-on:click="delete_post(index,car.id)" name="delete" v-bind:value="car.id">Delete</button>
                </h5>
                        <p class="card-text">{{car.text}}</p>
                <p class="card-text"><em class="text-danger">Price {{car.price}}$</em></p>
                <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#cars' + car.id">
                     Change post(only photo)
                </button>
            </div>
        </div>

        <div v-for="car in cars" class="modal fade" :id="'cars' + car.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="exampleModalLabel">{{car.title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="resetForm(car.src,car.id)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center" style="background: #4e6a8e">
                        <img class="card-img-top change" :src="'/img/' + car.src" alt="Card image cap" :id="car.id" style="max-height: 400px">

                            <form @submit.prevent="changeNewPost(car.id)" enctype="multipart/form-data" method="post">
                            <div class="custom-file">
                                <input type="file" name="userfile" v-on:change="changeImage($event,car.id)" class="custom-file-input" id="customFileLang" lang="in">
                                <label class="custom-file-label" for="customFileLang">Click to choose image... </label>
                            </div>

                            <input type="submit" value="Load image" class="semi-transparent-button">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <em class="bg-dark text-white">
                            1. Choose image
                        </em>
                        <em class="bg-dark text-white">
                            2. Click Load Image(central button on image)
                        </em>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="resetForm(car.src,car.id)">Close</button>
                    </div>
                </div>
            </div>
        </div>


<div class="row">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            Add car
        </button>
    </div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="resetForm()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background: #4e6a8e">
                    <form @submit.prevent="addNewPost" enctype="multipart/form-data" method="post">

                        <input maxlength="250" name="title" type="text" v-model="title" class="col-md-12" placeholder="Title...">
                        <input maxlength="250" name="text" type="text" v-model="text" class="col-md-12" placeholder="Description...">
                        <input maxlength="250" name="text" type="text" v-model="price" class="col-md-12" placeholder="Price...">
                        <div class="custom-file">
                            <input type="file" ref="userfile" name="userfile" v-on:change="uploadImage($event)"  class="custom-file-input" id="customFileLang" lang="in">
                            <label class="custom-file-label" for="customFileLang">Click to choose image... </label>
                        </div>

                        <div class="text-center">
                            <img class="image-preview-new" :src="imageNewPreview" style="max-width: 250px;max-height: 300px;padding: 15px;">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="resetForm()">Close</button>
                </div>
            </div>
        </div>
    </div>

    </div>


    <script type="text/javascript">


        new Vue({
            el: "#app",
            methods:
                {
                    showAllPosts: function () {
                        var self = this;
                        axios.post('functions.php',{ action : 'loadAllPosts'},{headers: { 'Content-Type': 'application/json' }})
                            .then(function (response) {
                                self.cars = response.data;
                            })
                    },
                    addNewPost: function () {

                        var self = this;
                        var title = this.title;
                        var text = this.text;
                        var image = this.image;
                        var price = this.price;
                        var formData = new FormData();
                        formData.append('action','addNewPosts');
                        formData.append('title', title);
                        formData.append('text', text);
                        formData.append('price', price);
                        formData.append('image', image);

                        axios.defaults.headers.common['Content-Type'] = 'multipart/form-data; boundary=someArbitraryUniqueString';

                        if((title&&text&&price)!=''){
                            axios.post('functions.php',formData,{headers:{'Content-Type': 'undefined'} })
                                .then(function (response) {
                                    self.cars.push(response.data);
                                    $('#exampleModal').modal('hide');
                                })
                        }
                        else {
                            confirm('You must fill all fields');
                        }



                    },
                    changeNewPost : function (indexChangedPost) {
                        var self = this;
                        var image = this.image;
                        var formData = new FormData();
                        formData.append('action','changeNewPost');
                        formData.append('id', indexChangedPost);
                        formData.append('image', image);

                        axios.defaults.headers.common['Content-Type'] = 'multipart/form-data; boundary=someArbitraryUniqueString';

                        axios.post('functions.php',formData,{headers:{'Content-Type': 'undefined'} })
                            .then(function (response) {
                                $('.modal.fade').modal('hide');
                                this.imagePreview = window.URL.createObjectURL(image);
                                $('#'+indexChangedPost+'.card-img-top').attr('src',this.imagePreview);
                                self.image = '';
                            })
                    },
                    delete_post: function (indexDeletedPost,idDeletedPost) {

                        var indexDeleted = indexDeletedPost;

                        var self = this;
                        axios.post('functions.php',{ action : 'delete', id : idDeletedPost},{headers: { 'Content-Type': 'application/json' }})
                            .then(function (response) {
                                self.cars.splice(indexDeleted,1);
                            })


                    },
                    changeImage : function (e,id) {
                        this.image = e.target.files[0];
                        this.imagePreview = window.URL.createObjectURL(this.image);
                        $('#'+id+'.card-img-top.change').attr('src',this.imagePreview).css({'padding': '20px','maxWidth': '320px','maxHeight': '300px'});
                        },
                    uploadImage : function (e) {
                        this.image = e.target.files[0];
                        this.imageNewPreview = window.URL.createObjectURL(this.image);
                        $('.image-preview-new').attr('src',this.imageNewPreview);

                    },
                    resetForm : function (srcImage,idImage) {
                        this.image = '';
                        //this.title = this.text = this.price = '';
                      var localPath = 'img/'+srcImage;
                      $('#'+idImage+'.card-img-top.change').attr('src',localPath);
                      $('label.custom-file-label').html('Click to choose image...');
                        $('.image-preview-new').attr('src','');
                    }

                }
            ,
            data :{
                imagePreview: '',
                imageNewPreview : '',
                count: 0,
                title: '',
                text: '',
                price: '',
                image: '',
                cars : []
            },
            created: function () {
                this.showAllPosts();
            }
        })

         //Close modal window
//        $('#exampleModal').on('hidden.bs.modal', function () {
//            $(this).find('form').trigger('reset');
//            $(this).find('label.custom-file-label').html('Click to choose image...');
//            $('.image-preview-new').attr('src','');
//        })

       //Add
//        $('.modal.fade').on('hidden.bs.modal', function () {
//            $(this).find('form').trigger('reset');
//            $(this).find('label.custom-file-label').html('Click to choose image...');
//            $('.image-preview-new').attr('src','');
//        })

        $('body').on('change','.custom-file-input',function () {
            var fileName = $(this).val().replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })


    $('.carousel').carousel({interval: 6000});

        </script>

</div>




<footer class="page-footer font-small special-color-dark pt-4" style="background-color: #1E282D; color: darkgrey">
    <div class="footer-copyright text-center py-3">© 2020
        <a href="https://mdbootstrap.com/">Ukraine</a>
    </div>
</footer>

</body>
</html>