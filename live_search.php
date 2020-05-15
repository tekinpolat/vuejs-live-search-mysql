<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <title>Live Search</title>
  </head>
  <body>
    <div class="container">
        <div class="row"  id="app">
            <div class="col-md-12 mt-3">
                <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-lg">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control text-center text-success" v-model="search"  v-on:keyup="searchData" placeholder="Search name or surname or gsmno..">
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Gsm</th>
                            <th scope="col">Code</th>
                        </tr>
                    </thead>
                <tbody>
                    <tr v-for="customer in customers">
                        <td>{{customer.name}}</td>
                        <td>{{customer.surname}}</td>
                        <td>{{customer.gsmno}}</td>
                        <td>{{customer.code}}</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div.col-md-12-mt-3>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js" integrity="sha256-bd8XIKzrtyJ1O5Sh3Xp3GiuMIzWC42ZekvrMMD4GxRg=" crossorigin="anonymous"></script>
    <script>
        const application = new Vue({
            el      : '#app',
            data    : {
                search      : '',
                customers   : "",
            },
            methods : {
                getCustomer : function(search){
                    axios.post('get.php',{search:search})
                    .then(function (response) {
                        console.log(response.data);
                        application.customers = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });  
                },
                searchData : function(){
                    this.getCustomer(this.search);
                }
            },
            created() {
                this.getCustomer('');
            }
        });
    </script>
  </body>
</html>