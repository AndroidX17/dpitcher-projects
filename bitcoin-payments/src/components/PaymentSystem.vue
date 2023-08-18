<template> <!-- PaymentSystem.vue -->

  <div :key="key">

    <div v-if="!isLoggedIn">
      <h1>Login</h1>
      <form @submit.prevent="loginUser">
        <label for="username">Username:</label><br>
        <input type="text" id="username" v-model="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" v-model="password"><br>
        <input class="likeabutton" type="submit" value="Submit">
      </form>
      <div v-if="loginStatus !== null">
        <p v-if="loginStatus === 'success'">Login successful!</p>
        <p v-else-if="loginStatus === 'failed'">Login failed. Please check your credentials.</p>
        <p v-else-if="loginStatus === 'error'">An error occurred. Please try again later.</p>
      </div>
    </div>
    <div v-else>
      <p>You are logged in as {{ username }}!</p>
      <button @click="logoutUser">Logout</button>
    </div>

    <h1>Mortality Core Payments System</h1>
    <p>{{ clipboardMessage }}</p>
    <p v-if="depositAddress">

      Your personal bitcoin deposit address is: 
      <strong>{{ depositAddress }}</strong>
      <img 
        src="/coinicons/questionmark.png" 
        alt="Question Mark" 
        style="width: 24px; height: 24px; vertical-align: super;"
        @mouseenter="handleMouseEnter"
        @mouseleave="handleMouseLeave"
      >
      
      <!-- Copy icon -->
      <img 
        src="/coinicons/copy.png" 
        alt="Copy BTC Address" 
        style="width: 24px; height: 24px; vertical-align: super; cursor: pointer;"
        @click="copyToClipboard(depositAddress)"
      >
      <ToolTip 
        v-show="show" 
        :content="'Use an exchange or your wallet to send bitcoin to this address, and your account balance will be credited.'" 
        :style="{ left: `${x}px`, top: `${y}px` }"
      />
    </p>

<!--
 <p v-if="ethDepositAddress">
    Your personal ethereum deposit address is: 
    <strong>{{ ethDepositAddress }}</strong>
    <img 
      src="/coinicons/questionmark.png" 
      alt="Question Mark" 
      style="width: 24px; height: 24px; vertical-align: super;"
      @mouseenter="handleMouseEnter"
      @mouseleave="handleMouseLeave"
    >
    <ToolTip 
      v-show="show" 
      :content="'Use an exchange or your wallet to send ETH to this address, and your account balance will be credited.'" 
      :style="{ left: `${x}px`, top: `${y}px` }"
    />
  </p>
-->

    <!-- <p v-if="walletBalance !== null">Account balance: <strong>{{ walletBalance }}</strong></p> THIS FEATURE IS DOWN -->
<p v-else>Log in or <a class="my-link" @click="changePage('SignupPage')">sign up</a> to make a payment</p>

<!-- Existing BTC balance -->
<p v-if="userBalance !== null && isLoggedIn">Account btc balance: <strong>{{ userBalance }}</strong> BTC</p>
<button v-if="isLoggedIn && depositAddress !== null" @click="toggleQrCode">{{showQrCode ? 'Hide' : 'Show'}} QR Code</button>

<!-- New ETH balance 
<p v-if="userETHBalance !== null && isLoggedIn">Account eth balance: <strong>{{ userETHBalance }}</strong> ETH</p>
-->

<div v-if="showQrCode" class="modal">
  <div class="modal-content">
    <span class="close" @click="toggleQrCode">&times;</span>
<vue-qrcode :value="depositAddress"></vue-qrcode>
<!--<vue-qrcode :value="'\n' + depositAddress + 'bitcoin:' + depositAddress"></vue-qrcode>-->
<!--  the industry standard format for bitcoin QR codes is the following: bitcoin:<address>?amount=<amount>&label=<label>&message=<message>-->

  </div>
</div>

  </div>
</template>


<script>
import axios from 'axios';

import { Buffer } from 'buffer';
global.Buffer = Buffer; // Note this line
import jwt_decode from 'jwt-decode';
import sharedState from '../sharedState.js';
import { reactive, watchEffect } from 'vue';

import ToolTip from './ToolTip.vue';
import VueQrcode from '@chenfengyuan/vue-qrcode';


const bitcoin = require('bitcoinjs-lib');
const bip39 = require('bip39');
const bip32 = require('bip32');

export default {
    props: ['changePage'],
  components: {
    ToolTip,
    VueQrcode,  // add this line
  },
  data() {
    return {
       showQrCode: false,
      key: 0,
      username: '',
      password: '',
    userETHBalance: null,
      loginStatus: null,
      isLoggedIn: false,
      userId: null,
      depositAddress: null,
      walletBalance: null,
      userBalance: null,
       reactiveSharedState: reactive(sharedState),
      tooltipVisible: false,
      show: false,
        ethDepositAddress: null,
      x: 0,
      y: 0,
      clipboardMessage: null,
    };
  },
 mounted() {
    const token = localStorage.getItem('token');
    this.username = localStorage.getItem('username'); // Retrieve the username
   // console.log("MOUNT FOR " + this.username);
    if (token) {
        
  const decoded = jwt_decode(token);
        this.userId = decoded.sub;
      this.isLoggedIn = true;
      this.initialize(decoded.sub);
    }
watchEffect(() => {
  this.userBalance = this.reactiveSharedState.userBalance;
  this.userETHBalance = this.reactiveSharedState.userETHBalance; // New line
});

  },
created() {
  const token = localStorage.getItem('token');
  if (token) {
    this.username = localStorage.getItem('username'); // Retrieve the username
    this.isLoggedIn = true;
  }
},

  methods: {
     toggleQrCode() {
    this.showQrCode = !this.showQrCode;
  },
copyToClipboard(text) {
    navigator.clipboard.writeText(text)
      .then(() => {
        this.clipboardMessage = 'BTC address copied to clipboard';
      })
      .catch(() => {
        this.clipboardMessage = 'Failed to copy BTC address';
      });

    // Hide the message after 3 seconds
    setTimeout(() => {
      this.clipboardMessage = null;
    }, 3000);
  },
    async getUserETHBalance(userID) {
  return axios.get(`https://www.mortalitycore.com/api/v1/get_user_eth_balance.php?userId=${userID}`)
    .then(response => {
      if (response.data.balance) {
        this.userETHBalance = response.data.balance;

        // Update the shared state
        sharedState.userETHBalance = response.data.balance;
      } else {
        console.log("no eth balance scenario");
        this.userETHBalance = 0;
        sharedState.userETHBalance = 0;
      }
    });
},
      handleMouseEnter(event) {
      this.show = true;
  this.x = event.clientX + 10; // Add an offset of 10px
  this.y = event.clientY + 10; // Add an offset of 10px
    },
    handleMouseLeave() {
      this.show = false;
    },
 async getUserBalance(userID) {
      return axios.get(`https://www.mortalitycore.com/api/v1/get_user_balance.php?userId=${userID}`)
        .then(response => {
          if (response.data.balance) {
            this.userBalance = response.data.balance;

            // Update the shared state
            sharedState.userBalance = response.data.balance;
          } else {
            console.log("no balance scenario");
            this.userBalance = 0;
            sharedState.userBalance = 0;
          }
        });
    },

         async initialize(userID) {

                const token = localStorage.getItem('token');
      // Decode JWT and get user ID
      if (token) {
        this.userId = userID;

        // Get or create the deposit address for the user
        await this.getOrCreateDepositAddress(userID);
      await this.getOrCreateETHDepositAddress(userID);
        // Now that we're sure the deposit address exists, get the wallet balance
       // await this.getWalletBalance(); // New method call // commenting out because limits reached
      //  console.log("GET BALANCE FOR " + userID);
       await this.getUserBalance(userID);
       await this.getUserETHBalance(userID);






await this.getUserPurchasedItems(userID);




      } else {
        // Clear the user information when the user is not logged in
        this.userId = null;
        this.depositAddress = null;
        this.ethDepositAddress = null;
        this.walletBalance = null;
        
    this.userETHBalance = null; // New line
      //  console.log("NO LOG");



      }
    },

async getUserPurchasedItems(userID) {
  try {
    const response = await axios.get('https://www.mortalitycore.com/api/v1/getPurchasedItems.php', {
      params: {
        user_id: userID
      }
    });

    // Store purchased items in shared state
    sharedState.purchasedItems = response.data.purchasedItems;
  } catch (error) {
    console.log("API error:", error); // Log error
  }
},
async getOrCreateETHDepositAddress(userID) {
  console.log("CHECKING DATABASE FOR USER WITH ID " + userID);
  return axios.post(`https://www.mortalitycore.com/api/v1/get_address_eth.php`, {
    userId: userID
  }).then(response => {
    // If a deposit address exists, use it
    if (response.data.depositAddress) {
        this.ethDepositAddress = response.data.depositAddress;
        console.log("ADDRESS GOT: " + this.ethDepositAddress);
    } else {
        // If no deposit address exists, create a new one
        console.log("NO ADDRESS GET");
        return this.createETHDepositAddress(userID);
    }
  });
},
// Then have the createETHDepositAddress method similar to your current setup


async createETHDepositAddress(userID) {
console.log("CAN WE DO " + userID);
  const Wallet = require('ethereumjs-wallet').default;
  const HDKey = require('hdkey');
  const bip39 = require('bip39');

  // Get the seed phrase from your server (similar to your current BTC setup)
  // This should be securely stored and retrieved
  const response = await axios.get('https://www.mortalitycore.com/api/v1/keys3.php');
  const seedPhrase = response.data.seedPhrase; // 12-word seed phrase

  // Generate the seed from the seed phrase
  const seed = bip39.mnemonicToSeedSync(seedPhrase);
  
  const hdkey = HDKey.fromMasterSeed(seed);

if (isNaN(userID) || userID < 0) {
  throw new Error('Invalid user ID');
}
  // We use the user's ID to generate a unique path for each user
  // Ethereum HD paths look slightly different from Bitcoin ones
  // "m/44'/60'/0'/0/{userID}"
  const path = `m/44'/60'/0'/0/${userID}`;

  const walletHDPath = hdkey.derive(path);
  const wallet = Wallet.fromPrivateKey(walletHDPath._privateKey);

  // The Ethereum address
  const address = '0x' + wallet.getAddress().toString('hex');

  console.log(address);

      this.ethDepositAddress = address;
// Uncomment the following code block to store the address
await axios.post('https://www.mortalitycore.com/api/v1/store_address_eth.php', {
  userId: userID,
  depositAddress: address
})
.then((response) => {
  console.log('Response from server:', response.data);
})
.catch((error) => {
  console.error('An error occurred while storing the address:', error);
});

return address;
},



getOrCreateDepositAddress(userID) {
    console.log("CHECKING DATABASE FOR USER WITH ID " + userID);
   return axios.post(`https://www.mortalitycore.com/api/v1/get_address.php`, {
    userId: userID
  }).then(response => {
        // If a deposit address exists, use it
        if (response.data.depositAddress) {
            this.depositAddress = response.data.depositAddress;
            console.log("ADDRESS GOT: " + this.depositAddress);
        } else {
            // If no deposit address exists, create a new one
            console.log("NO ADDRESS GET");
            return this.createDepositAddress(userID);
        }
    });
},
async createDepositAddress(userID) {
 
 console.log("CREATING ADDRESS FOR " + userID);
 try {
    // Call the keys3.php endpoint to fetch the master private key
    const response = await axios.get('https://www.mortalitycore.com/api/v1/keys3.php');

    const seedPhrase = response.data.seedPhrase;
    const network = bitcoin.networks.bitcoin;
    const seed = bip39.mnemonicToSeedSync(seedPhrase);
    const root = bip32.fromSeed(seed, network);

    // We use the user's ID to generate a unique path for each user
    const path = `m/84'/0'/0'/0/${userID}`;

    
 console.log("CREATING path FOR " + path);
    const child = root.derivePath(path);
    
    // Generate the P2WPKH (Pay-to-Witness-Public-Key-Hash) address
    const { address } = bitcoin.payments.p2wpkh({ pubkey: child.publicKey, network });



await axios.post('https://www.mortalitycore.com/api/v1/store_address.php', {
  userId: userID,
  depositAddress: address
})
.then((response) => {
  // If the request is successful, this code will run
  console.log('Response from server:', response.data);
})
.catch((error) => {
  // If there was an error with the request, this code will run
  if (error.response) {
    // The request was made and the server responded with a status code
    // that falls out of the range of 2xx
    console.error('An error occurred while storing the address:', error.response.data);
  } else if (error.request) {
    // The request was made but no response was received
    console.error('No response received:', error.request);
  } else {
    // Something happened in setting up the request that triggered an Error
    console.error('Error', error.message);
  }
});



    // If everything went well, set the newly created address
    this.depositAddress = address;
  } catch (error) {
    console.error('An error occurred while creating a deposit address: ', error);
  }

    
},
    async getWalletBalance() {
      try {
        const response = await axios.get(`https://api.blockcypher.com/v1/btc/main/addrs/${this.depositAddress}/balance`)
        // Update the wallet balance
        this.walletBalance = response.data.final_balance;
      } catch (error) {
        console.error('An error occurred while fetching wallet balance: ', error);
      }
    },

       getProtectedData() {
      const token = localStorage.getItem('token'); // Retrieve the JWT from local storage
      if (token) {
        axios.get('https://mortalitycore.com/api/v1/test.php', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
        .then(response => {
          if (response.data.status === 'success') {
          console.log('Protected data: ', response.data.data);
            // Display the protected data or handle it as necessary
          } else {
          console.log('Failed to access protected data: ', response.data.message);
            // Handle failure to access protected data
          }
        })
        .catch(error => {
         console.log('An error occurred: ', error);
          // Handle the error here
        });
      } else {
    console.log('No token found');
        // No token found in local storage
      }
    },
 async loginUser() {
   // console.log("LOGGING IN FOR " + this.username);
      axios.post('https://mortalitycore.com/api/v1/login.php', {
        username: this.username,
        password: this.password,
      })
      .then(async response => {
        if (response.data.status === 'success') {
          this.loginStatus = 'success';
          const token = response.data.jwt;
  
  const decoded = jwt_decode(token);
        this.userId = decoded.sub;
          this.isLoggedIn = true;
        localStorage.setItem('token', token);
        localStorage.setItem('username', this.username);
        await this.initialize(decoded.sub);
      //  console.log("LOGGING IN FOR " + this.username);
         
        } else {
          this.loginStatus = 'failed';
        }
      })
 .catch(error => {
  if (error.response) {
    console.log('Response data: ', error.response.data);
    console.log('Response status: ', error.response.status);
    console.log('Response headers: ', error.response.headers);
  } else if (error.request) {
    console.log('The request was made but no response was received: ', error.request);
  } else {
    console.log('Something happened in setting up the request and triggered an Error: ', error.message);
  }
  console.log('Config: ', error.config);
  this.loginStatus = 'error';
});

    },
logoutUser() {

 // console.log("LOG OUT");
  this.username = '';
  this.password = ''; // Reset the password
this.userETHBalance = null;
        this.ethDepositAddress = null;
  this.depositAddress = null; // Reset depositAddress
  this.walletBalance = null; // Reset walletBalance
this.userBalance = null;
   this.isLoggedIn = false;
      localStorage.removeItem('token');
      localStorage.removeItem('username');
      //this.initialize(null);
      
  this.key++; // increment the key value
},


  },
};
</script>
<style scoped>
.my-link {
  color: blue; /* standard link color */
  text-decoration: none; /* remove underline */
  cursor: pointer; /* show pointer cursor when hovering */
}

.my-link:hover {
  text-decoration: underline; /* add underline when hovering */
}
.modal {
  display: block;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
  text-align: center;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}


.likeabutton {
  background-color: #ffcc00; /* yellow background for buttons */
  color: #1a1a1a; /* dark text for buttons */
  border: none;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.likeabutton:hover {
  background-color: #1a1a1a; /* dark background for button hover */
  color: white; /* white text for button hover */
}

button:hover {
  background-color: #1a1a1a; /* dark background for button hover */
  color: white; /* white text for button hover */
}

button {
  background-color: #ffcc00; /* yellow background for buttons */
  color: #1a1a1a; /* dark text for buttons */
  border: none;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}
</style>