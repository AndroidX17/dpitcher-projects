<template>
  <div class="signup-container">
    <h2>Sign Up</h2>
    <form @submit.prevent="submitForm" class="signup-form">
      <div class="form-group">
        <input v-model="username" type="text" placeholder="username....">
      </div>
      <div class="form-group">
        <input v-model="password" type="password" placeholder="password....">
      </div>
      <div class="form-group">
        <input v-model="passwordRepeat" type="password" placeholder="repeat pass....">
      </div>
      <div class="form-group">
        <button type="submit">Sign Up</button>
      </div>
    </form>
    <div v-if="errorMessage" class="error-message">
      <p>{{ errorMessage }}</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

import jwt_decode from 'jwt-decode';
export default {
    props: ['changePage'],
  data() {
    return {
      username: '',
      password: '',
      passwordRepeat: '',
      errorMessage: '',
    };
  },
  methods: {
    async loginUser(username, password) {
  return axios.post('https://mortalitycore.com/api/v1/login.php', {
    username,
    password
  })
  .then(async response => {
    if (response.data.status === 'success') {
      console.log("LOGGING IN USER");
      const token = response.data.jwt;
      const decoded = jwt_decode(token);
      this.userId = decoded.sub;
      this.isLoggedIn = true;
      localStorage.setItem('token', token);
      localStorage.setItem('username', username);
      return true;
    } else {
      return false;
    }
  })
  .catch(error => {
    console.error(error);
    return false;
  });
},
submitForm() {
  const data = new URLSearchParams({
    'uid': this.username,
    'pwd': this.password,
    'pwdrepeat': this.passwordRepeat
  });

  axios.post('https://mortalitycore.com/includes/shopsignup.inc.php', data, {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    }
  })
  .then(response => {
    if (response.data.error) {
      this.errorMessage = response.data.error;
    } else {
      console.log("MADE A USER");
      this.loginUser(this.username, this.password)
        .then(success => {
          if(success){
            // The login was successful, do something here if needed
               this.changePage('ShopPage'); // Use the changePage method here
              
          }else{
            // The login was not successful, handle error
            this.errorMessage = 'An error occurred during signup.';
            
  console.log("ISSUE");
          }
        })
    }
  })
  .catch(error => {
    console.log(error);
    this.errorMessage = 'An error occurred during signup.';
  });
}
  }
}
</script>

<style scoped>
.signup-container {
  max-width: 500px;
  margin: 0 auto;
}

.signup-form .form-group {
  margin-bottom: 15px;
}

.signup-form .form-group input {
  width: 100%;
  padding: 10px;
  font-size: 1rem;
}

.signup-form .form-group button {
  padding: 10px 20px;
  font-size: 1rem;
  color: white;
  background-color: #2c3e50;
  border: none;
  cursor: pointer;
}

.error-message {
  color: red;
  font-weight: bold;
}
</style>
