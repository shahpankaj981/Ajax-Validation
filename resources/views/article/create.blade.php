<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Article</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw=="
        crossorigin="anonymous">
  <style>
    .body {
      height: 200px !important;
    }

    .error {
      color: darkred;
      margin-top: 5px;
      display: block;
    }
  </style>

</head>
<body>
<div id="app">
  <form @submit.prevent="submitForm" class="col-md-4 col-md-offset-4" action="/article" method="post">
    <h1>Create New Article</h1>
    <hr>

    {!! csrf_field() !!}

    <div class="form-group">
      <input class="form-control title" type="text" name="title" placeholder="Title" v-model="formInputs.title">
        <span v-if="formErrors['title']" class="error">@{{ formErrors['title'] }}</span>
    </div>

    <div class="form-group">
      <textarea class="form-control body" name="body" placeholder="Content" v-model="formInputs.body"></textarea>
        <span v-if="formErrors['body']" class="error">@{{ formErrors['body'] }}</span>
    </div>

    <button class="btn btn-primary" type="submit">Publish</button>
  </form>
</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.14/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js"></script>

<script>
  new Vue({
    el: '#app',

    data: {
      formInputs: {},
      formErrors: {}
    },

    methods: {
      submitForm: function(e) {
        var form = e.srcElement;
        var action = form.action;
        var csrfToken = form.querySelector('input[name="_token"]').value;

        this.$http.post(action, this.formInputs, {
          headers: {
            'X-CSRF-TOKEN': csrfToken
          }
        })
          .then(function() {
            form.submit();
          })
          .catch(function (data, status, request) {
            var errors = data.data;
            this.formErrors = errors;
          });
      }
    },

  });
</script>

</html>