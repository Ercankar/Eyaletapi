<!DOCTYPE html>
<html>
<head>
	<title>POSTA KODU APİ</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<script type="js/me.js"></script>
	  <link rel="stylesheet" href="styles.css">
	  <style>
	  	
	  </style>
</head>
<body>
    <div id="app">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-md-offset-3">

            <div class="lead-form">
              <h1 class="text-center">POSTA KODUNU YAZ ARA</h1>
              <hr />
             <div class="row">
               <div class="col-md-6">

                 <input type="text" class="form-control" placeholder="posta kodu" v-model="startingZip">
                  <span class="city-span">{{startingCity}}</span>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="başka bir posta kodu" v-model="endingZip">
                  <span class="city-span">{{endingCity}}</span>
                </div>
              </div>
              <div class="row">
               <div class="col-md-12">

                  <button class="btn btn-primary btn-block" id="submit-form">ARA</button>
                </div>
              </div>
              <h3 style="color:red;">SADECE ABD posta kodu giriniz (Türkiye için de yaptım )</h3>
              örnek posta kodu : 90210 
              <b>Sehir ve eyalet için arama yapar ! </b>
            </div><!-- end of .lead-form -->
          </div> <!-- end of .col-md-6.col-md-offset-3 -->
       </div> <!-- end of .row -->
      </div> <!-- end of .container -->
    </div> <!-- end of #app -->
</body>
<script src="https://unpkg.com/vue@2.0.3/dist/vue.js"></script>
  <script src="https://unpkg.com/axios@0.12.0/dist/axios.min.js"></script>
  <script src="https://unpkg.com/lodash@4.13.1/lodash.min.js"></script>
  <script>


    var app = new Vue({
      el: '#app',
      data: {
        startingZip: '',
        startingCity: '',
        endingZip: '',
        endingCity: ''
      },

      watch: {
        startingZip: function() {
          this.startingCity = ''
          if (this.startingZip.length == 5) {
            this.lookupStartingZip()
          }
        },
        endingZip: function() {
          this.endingCity = ''
          if (this.endingZip.length == 5) {
            this.lookupEndingZip()
          }
        }
      },
      methods: {
        lookupStartingZip: _.debounce(function() {
          var app = this
          app.startingCity = "Searching..."
          axios.get('http://ziptasticapi.com/' + app.startingZip)
                .then(function (response) {
                  app.startingCity = response.data.city + ', ' + response.data.state
               })
               .catch(function (error) {
                 app.startingCity = "Invalid Zipcode"
              })
        }, 500),
        lookupEndingZip: _.debounce(function() {
          var app = this
          app.endingCity = "Searching..."
          axios.get('http://ziptasticapi.com/' + app.endingZip)
                .then(function (response) {
                 app.endingCity = response.data.city + ', ' + response.data.state
                })
               .catch(function (error) {
                  app.endingCity = "Invalid Zipcode"

                })
        }, 500)

      }

    })

  </script>
</html>

