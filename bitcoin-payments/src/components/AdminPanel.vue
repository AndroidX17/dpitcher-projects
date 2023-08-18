
<template> <!-- AdminPanel.vue -->
<div>
<div v-if="isAdmin">
    <h2>Add New Product</h2>
    <form @submit.prevent="createProduct" enctype="multipart/form-data">
      <label for="name">Product Name:</label>
      <input id="name" v-model="newProduct.name" required><br>
      
      <label for="description">Product Description:</label>
      <input id="description" v-model="newProduct.description" required><br>
      
      <label for="price">Product Price:</label>
      <input id="price" v-model="newProduct.price" required><br>
      
      <label for="image">Product Image:</label>
      <input id="image" type="file" ref="file" required><br>

  <label for="stock">Initial Stock:</label>
  <input id="stock" v-model="newProduct.stock" required><br>
      <button type="submit">Create Product</button>
    <div v-if="message">{{ message }}</div>

    
    </form>
<div>
    <button @click="transferFundsZero">Transfer Funds Zero</button>
    <!-- Display the message if it exists -->
    <p v-if="messageTFZ">{{ messageTFZ }}</p>
  </div>
      <h2>Review Orders</h2>
    <button @click="fetchOrders">Fetch Orders</button>

<ul>
    <li v-for="order in orders" :key="order.order_id">
      <h3>Order {{ order.order_id }}</h3>
      <p>Customer: {{ order.customer }}</p>
      <p>Total: {{ order.total }} btc </p>
      <p>Status: {{ order.status }}</p> <!-- Display the status of the order -->
 <button v-if="order.status !== 'fulfilled'" @click="fulfillOrder(order.order_id)">Fulfill Order</button>
    <button @click="deleteOrder(order.order_id)">Delete Order</button>


      <ul>
        <li v-for="item in order.items" :key="item.product_id">  <!-- I've also changed the key to item.product_id as item.id does not seem to be defined -->
          {{ item.product_name }} ({{ item.price * item.quantity }} btc total): x{{ item.quantity }}
        </li>
      </ul>
    </li>
  </ul>
  <h2>Manage Download Links</h2>
<ul>
  <li v-for="product in products" :key="product.id">
    <h3>{{ product.name }}</h3>
    <p>Current download link: {{ product.download_link }}</p>
    <form @submit.prevent="updateDownloadLink(product.id, product.newDownloadLink)">
      <label for="newDownloadLink">New Download Link:</label>
      <input id="newDownloadLink" v-model="product.newDownloadLink" required>
      <button type="submit">Update Download Link</button>
    </form>
    <p v-if="product.updateMessage">{{ product.updateMessage }}</p>
  </li>
</ul>

<h2>Check Imported Wallet Address</h2>
<form @submit.prevent="checkWallet">
  <label for="walletAddress">Wallet Address:</label>
  <input id="walletAddress" v-model="wallet.address" required><br>
  <button type="submit">Check Address</button>
</form>
<div v-if="walletMessage">{{ walletMessage }}</div>

 <h2>Import Wallet</h2>
  <form @submit.prevent="importWallet">
    <label for="importWalletAddress">Wallet Address:</label>
    <input id="importWalletAddress" v-model="wallet.addressToImport" required><br>
    <button type="submit">Import Wallet</button>
  </form>
  <div v-if="importWalletMessage">{{ importWalletMessage }}</div>
 <div>
    <h1>Total UTXOs:    </h1>
    <p v-if="totalUnspentFunds">Your new wallet is: <strong>{{ totalUnspentFunds }}</strong></p>
    <button @click="getTotalUtxos">Refresh Total UTXOs</button>
  </div>

 <h2>Transfer Funds to Cold Storage</h2>
  <form @submit.prevent="transferFunds">
    <label for="address">Destination Address:</label>
    <input id="address" v-model="transfer.address" reqnpuired><br>

    <label for="change_address">Change Address:</label> <!-- New field -->
    <input id="change_address" v-model="transfer.changeAddress" required><br>

    <label for="amount">Amount to Transfer:</label>
    <input id="amount" v-model="transfer.amount" required><br>

    <button type="submit">Transfer Funds</button>
  </form>
  <div v-if="transferMessage">{{ transferMessage }}</div>


     <div>
    <h1>Seed Phrase Generator</h1>
    <p v-if="seedPhrase">Your new seed phrase is: <strong>{{ seedPhrase }}</strong></p>
    <p v-else>Generate new seed phrase...</p>
           <button @click="createSeedPhrase">Create Seed Phrase</button>

  </div>

    <div>
    <h1>Master Wallet Generator</h1>
    <p v-if="root">Your new wallet is: <strong>{{ root }}</strong></p>
    <p v-if="root">Your master private key is: <strong>{{ root.toBase58() }}</strong></p>
    <p v-if="base58">Your base58 private key is: <strong>{{ base58 }}</strong></p>
<p v-if="base582">Your trust wallet derived wallet is: <strong :class="{ correct: isCorrectAddress }">{{ base582 }}</strong></p>

<p v-if="derivedTrustKey">Your trust wallet derived first wallet key is: {{ derivedTrustKey }}</p>

      <label>Derivation Path:</label>
    <input v-model="derivationPath" type="text">
    <p v-if="chainCode">Your chain code is: <strong>{{ chainCode.toString('hex') }}</strong></p>
    <p v-else>...</p>
   <!--   <button @click="findMasterPrivateKey">Fetch Master Private Key</button>-->


  </div>
 <div>
    <h1>Derive Root Wallet Address</h1>
    <form @submit.prevent="deriveAddress">
      <label for="seedPhrase">Seed Phrase:</label>
      <input id="seedPhrase" v-model="seedPhrase" required><br>
      <button type="submit">Derive Address</button>
    </form>
    <div v-if="derivedAddress">Derived Address: {{ derivedAddress }}</div>
  </div>



  
<h2>Retrieve Previous Transaction Information</h2>
<form @submit.prevent="fetchPreviousTransactionInfo">
  <label for="txhash">Transaction Hash:</label>
  <input id="txhash" v-model="transaction.txhash" required><br>
  
  <label for="vout">Vout:</label>
  <input id="vout" v-model="transaction.vout" required><br>
  
  <label for="blockhash">Blockhash:</label>
  <input id="blockhash" v-model="transaction.blockhash" required><br>
  
  <button type="submit">Fetch Information</button>
</form>
<div v-if="transactionMessage">{{ transactionMessage }}</div>

<div v-if="transactionData">
  <h3>Transaction Information</h3>
  <p><strong>TXID:</strong> {{ transactionData.txid }}</p>
  <p><strong>Vout:</strong> {{ transactionData.vout }}</p>
  <p><strong>ScriptPubKey:</strong> {{ transactionData.scriptPubKey }}</p>
  <!-- Add these lines if you're returning 'redeemScript' and 'witnessScript' from your backend
  <p><strong>RedeemScript:</strong> {{ transactionData.redeemScript }}</p>
  <p><strong>WitnessScript:</strong> {{ transactionData.witnessScript }}</p>
  -->
  <p><strong>Amount:</strong> {{ transactionData.amount }}</p>
</div>

<h2>Base58 Encoder</h2>
<form @submit.prevent="encodeBase58">
  <label for="inputValue">Input Value:</label>
  <input id="inputValue" v-model="input.value" required><br>
  <button type="submit">Encode Value</button>
</form>
<div v-if="encodedValue">Encoded Value: {{ encodedValue }}</div>

<h2>Base58Check Encoder</h2>
<form @submit.prevent="encodeBase58Check">
  <label for="inputValueCheck">Input Value:</label>
  <input id="inputValueCheck" v-model="inputCheck.valueCheck" required><br>
  <button type="submit">Encode Value</button>
</form>
<div v-if="encodedValueCheck">Encoded Value: {{ encodedValueCheck }}</div>


  </div> 


</div>

</template>



<script>
import axios from 'axios';
import { Buffer } from 'buffer';
global.Buffer = Buffer; // Note this line
const bitcoin = require('bitcoinjs-lib');
const bip39 = require('bip39');
const bip32 = require('bip32');

export default {
  name: 'AdminPanel',
  data() {
    return {
      products: [],
       transferTFZ: {
        address: '', // this should be filled with actual address
        changeAddress: '', // this should be filled with actual change address
      },
        messageTFZ: '',  // this will hold the server's response message
      totalUnspentFunds: 0,
  transaction: {
        txhash: '09cdf430f9a0eb5ed65f27314a6f70453a8e6c9e41596d9553f8b042a740e996',
        vout: '0',
        blockhash: '0000000000000000000363756ee8e3aec856f6324bbc1b85fa6c80557f28736b',
      },
transactionMessage: '',
    derivationPath: "m/84'/0'/0'/0/0",
    transactionData: null,  // New property to store the response data
      seedPhrase: '', 
      root: null,
      isAdmin: false,
        input: {
      value: '',
    },
    encodedValue: '',
        inputCheck: {
      valueCheck: '',
    },
        base58: '',
        base582: '',
derivedTrustKey: '',
        chainCode: '',
        isCorrectAddress: false,
    encodedValueCheck: '',
      derivedAddress: '',
      newProduct: {
        name: '',
        description: '',
        price: '',
        stock: '', // Add this line
      },
      message: '', // New property for feedback
      orders: [],  // New property for orders
      wallet: {
  address: '',
        addressToImport: '', // New field
},
walletMessage: '', // New property for feedback

      importWalletMessage: '', // New field
    transfer: {
      address: 'bc1qaqtyxnxetxttnuem7d5arwmwka7tk9hhyf6uew',
        changeAddress: 'bc1qaqtyxnxetxttnuem7d5arwmwka7tk9hhyf6uew', // New field
      amount: '0.00004713',
    },
    transferMessage: '', // New property for feedback
    }
  },
  methods: {
    async transferFundsZero() {
  const userConfirmation = window.confirm("Are you sure you want to transfer funds? This action cannot be undone.");
  if (!userConfirmation) {
    return;  // The user clicked 'Cancel', stop the execution of the function
  }

  // For each user, derive their private key
  const { privateKey, address } = await this.deriveKeyAndAddressForUserID(0);

  const token = localStorage.getItem('token');
  if (!token) {
    console.error('No token found in local storage');
    return;
  }

  // get transferData together
  const transferData = {
    // put in key and address
    privateKey: privateKey,
    sourceAddress: address,
    destinationAddress: this.transfer.address,
    changeAddress: this.transfer.changeAddress,
  };

  // we should also send
  const transferResponse = await axios.post('https://mortalitycore.com/api/v1/zero_transfer.php', transferData, {
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });

    // Handle the transfer response
  if (transferResponse.data.status === 'success') {
    // Provide success feedback
    // Save the message to display in the frontend
    this.messageTFZ = transferResponse.data.message + "//ID:"+transferResponse.data.txid;
  } else {
    // Provide error feedback
    // Save the message to display in the frontend
    this.messageTFZ = transferResponse.data.message;
  }
},  

     async encodeBase58() {
  try {
    const response = await axios.post('https://mortalitycore.com/api/v1/base58_encode.php', {
      string: this.input.value,  // Changed 'value' to 'string'
    });

    if (response.data.encoded_string) { // Check if 'encoded_string' is present in response data
      // Store the encoded value
      this.encodedValue = response.data.encoded_string; // Changed 'encodedValue' to 'encoded_string'

      // Clear the input field
      this.input.value = '';






    } else {
      // Handle the error
      console.log(response.data.error);
    }
  } catch (error) {
    console.error('Error encoding value:', error);
  }
},
async encodeBase58Check() {
  try {
    const response = await axios.post('https://mortalitycore.com/api/v1/base58check_encode.php', {
      private_key: this.inputCheck.valueCheck,  // Changed 'value' to 'string'
    });

    if (response.data.wif) { // Check if 'encoded_string' is present in response data
      // Store the encoded value
      this.encodedValueCheck = response.data.wif; // Changed 'encodedValue' to 'encoded_string'

      // Clear the input field
      this.input.valueCheck = '';
    } else {
      // Handle the error
      console.log(response.data.error);
    }
  } catch (error) {
    console.error('Error encoding value:', error);
  }
},
async deleteOrder(orderId) {
  try {
    const token = localStorage.getItem('token');
    const response = await axios.delete(`https://mortalitycore.com/api/v1/delete_order.php?order_id=${orderId}`, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });

    if (response.data.status === 'success') {
      // Remove the order from the orders array
      this.orders = this.orders.filter(order => order.order_id !== orderId);
      
    } else {
      this.message = response.data.message;
    }
  } catch (error) {
    console.log(error);
    this.message = "An error occurred while deleting the order.";
  }
},
    async fetchPreviousTransactionInfo() {
  try {
    const token = localStorage.getItem('token');
    const response = await axios.post('https://mortalitycore.com/api/v1/get_transaction_info.php', {
      txhash: this.transaction.txhash,
      vout: this.transaction.vout,
      blockhash: this.transaction.blockhash,
    }, {
      headers: {
        'Authorization': `Bearer ${token}`,
      }
    });
  
if (response.data.status === 'success') {
  // Store the response data
  this.transactionData = response.data.data;

  // Clear the form
  this.transaction = {
    txhash: '',
    vout: '',
    blockhash: '',
  };

  // Provide success feedback
  this.transactionMessage = response.data.message;
} else {
  // Provide error feedback
  this.transactionMessage = response.data.message;
}

  } catch (error) {
    console.log(error);
    // Provide error feedback
    this.transactionMessage = "An error occurred while fetching the transaction information.";
  }
},
     deriveAddress() {
      this.derivedAddress = this.deriveRootWalletAddress(this.seedPhrase);
    },
    /*
    deriveRootWalletAddress(seedPhrase) {
      try {
        const seed = bip39.mnemonicToSeedSync(seedPhrase);
        const root = bip32.fromSeed(seed, bitcoin.networks.bitcoin);
        const { address } = bitcoin.payments.p2pkh({ pubkey: root.publicKey });
        return address;
      } catch (error) {
        console.error('Error deriving wallet address:', error);
        return null;
      }
    },*/

  deriveRootWalletAddress(seedPhrase) {
    try {
      /*
      const seed = bip39.mnemonicToSeedSync(seedPhrase);
      const root = bip32.fromSeed(seed, bitcoin.networks.bitcoin);
      const { address } = bitcoin.payments.p2wpkh({ pubkey: root.publicKey });*/
      
// Generate seed and derive the private key

    const network = bitcoin.networks.bitcoin;
const seed3 = bip39.mnemonicToSeedSync(seedPhrase);
const root3 = bip32.fromSeed(seed3, network);
    const child3 = root3.derivePath(this.derivationPath);


// Get the P2WPKH (Pay-to-Witness-Public-Key-Hash) address
const { address } = bitcoin.payments.p2wpkh({ pubkey: child3.publicKey, network });


      return address;
    } catch (error) {
      console.error('Error deriving wallet address:', error);
      return null;
    }
  },


    createSeedPhrase() {
      
      this.seedPhrase = bip39.generateMnemonic();
      
    const seed = bip39.mnemonicToSeedSync(this.seedPhrase);
    this.root = bip32.fromSeed(seed, bitcoin.networks.bitcoin);
    
        this.chainCode = this.root.chainCode;
    },
    async importWallet() {
  try {
    const token = localStorage.getItem('token');
const formData = new FormData();
formData.append('address', this.wallet.addressToImport);

const response = await axios.post('https://mortalitycore.com/api/v1/check_wallet2.php', formData, {
    headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'multipart/form-data' // Set the content type so PHP knows how to parse it
    }
});


    if (response.data.status === 'success') {
      // Clear the form
      this.wallet.addressToImport = '';
      // Provide success feedback
      this.importWalletMessage = response.data.message;
    } else {
      // Provide error feedback
      this.importWalletMessage = response.data.message;
    }
  } catch (error) {
    console.log(error);
    // Provide error feedback
    this.importWalletMessage = "An error occurred while importing the wallet address.";
  }
},
    async checkWallet() {
  try {
    const token = localStorage.getItem('token');
const formData = new FormData();
formData.append('address', this.wallet.address);

const response = await axios.post('https://mortalitycore.com/api/v1/check_wallet.php', formData, {
    headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'multipart/form-data' // Set the content type so PHP knows how to parse it
    }
});


    if (response.data.status === 'success') {
      // Clear the form
      this.wallet.address = '';
      // Provide success feedback
      this.walletMessage = response.data.message;
    } else {
      // Provide error feedback
      this.walletMessage = response.data.message;
    }
  } catch (error) {
    console.log(error);
    // Provide error feedback
    this.walletMessage = "An error occurred while checking the wallet address.";
  }
},
      async deriveKeyAndAddress() {
    const response = await axios.get('https://www.mortalitycore.com/api/v1/keys3.php');
    const sensitiveData = response.data;
    const network = bitcoin.networks.bitcoin;
    const seedPhrase = sensitiveData.seedPhrase;

    const seed = bip39.mnemonicToSeedSync(seedPhrase);
    const root = bip32.fromSeed(seed, network);

    const path = "m/84'/0'/0'/0/0";
    const child = root.derivePath(path);
    const privateKeyWIF = child.toWIF();

    const { address } = bitcoin.payments.p2wpkh({ pubkey: child.publicKey, network });

    this.derivedKey = privateKeyWIF;
    this.derivedAddress = address;

    return { privateKey: privateKeyWIF, address };
  },async deriveKeyAndAddressForUserID(userID) {
  const response = await axios.get('https://www.mortalitycore.com/api/v1/keys3.php');
  const sensitiveData = response.data;
  const network = bitcoin.networks.bitcoin;
  const seedPhrase = sensitiveData.seedPhrase;

  const seed = bip39.mnemonicToSeedSync(seedPhrase);
  const root = bip32.fromSeed(seed, network);

  // Use the user ID in the derivation path
  const path = `m/84'/0'/0'/0/${userID}`;
  const child = root.derivePath(path);
  const privateKeyWIF = child.toWIF();

  const { address } = bitcoin.payments.p2wpkh({ pubkey: child.publicKey, network });

  this.derivedKey = privateKeyWIF;
  this.derivedAddress = address;

  return { privateKey: privateKeyWIF, address };
},
async getTotalUtxos() {
  try {
    const response = await axios.get('https://mortalitycore.com/api/v1/get_total_utxos.php');
    const totalUnspentFunds = response.data.totalUnspentFunds;
    console.log('Total Unspent Funds: ', totalUnspentFunds);
    this.totalUnspentFunds = totalUnspentFunds;
  } catch (error) {
    console.error(error);
  }
},

  async transferFunds() {

const userConfirmation = window.confirm("Are you sure you want to transfer funds? This action cannot be undone.");
    if (!userConfirmation) {
      return;  // The user clicked 'Cancel', stop the execution of the function
    }
  const response = await axios.get('https://www.mortalitycore.com/api/v1/getDepositAddresses.php');
  const depositData = response.data;

  // Array to store all the derived keys and addresses
  let derivedKeysAddresses = [];

  for (let user of depositData) {
    // For each user, derive their private key
 const { privateKey, address } = await this.deriveKeyAndAddressForUserID(user.user_id);

    // Validate the derived address with the one fetched from the database
    if (address !== user.deposit_address) {
      console.error(`Derived address for user ${user.user_id} does not match the one in the database.`);
      continue;
    }

    // Add the derived private key and address to the array
    derivedKeysAddresses.push({
      derivedPrivateKey: privateKey,
      derivedAddress: address,
      user_id: user.user_id,
      deposit_address: user.deposit_address,
      amount: this.transfer.amount.toString(),  // assumes same amount for all users
      changeAddress: this.transfer.changeAddress // assumes same change address for all users
    });
  }

  const token = localStorage.getItem('token');
if (!token) {
  console.error('No token found in local storage');
  return;
}

   const transferData = {
    derivedKeysAddresses: derivedKeysAddresses,
    destinationAddress: this.transfer.address,
    changeAddress: this.transfer.changeAddress,
    amount: this.transfer.amount.toString(),
  };

  const transferResponse = await axios.post('https://mortalitycore.com/api/v1/transfer_all_funds.php', transferData, {
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });


// Handle the transfer response
if (transferResponse.data.status === 'success') {
  // Provide success feedback
  this.transferMessage = transferResponse.data.message;  // Save the message to display in the frontend
  console.log(transferResponse.data.message);
} else {
  // Provide error feedback
  this.transferMessage = transferResponse.data.message;  // Save the message to display in the frontend
  console.error(transferResponse.data.message);
}

  // Clear the form
  this.transfer = {
    address: '',
    changeAddress: '',
    amount: '',
  };
  },
   
     async fulfillOrder(orderId) {
        try {
            const token = localStorage.getItem('token'); 
            const response = await axios.post('https://mortalitycore.com/api/v1/fulfill_order.php', {
                order_id: orderId
            }, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

 if (response.data.status === 'success') {
      // Update the local order's status
      const orderIndex = this.orders.findIndex(order => order.order_id === orderId);
      this.orders[orderIndex] = { ...this.orders[orderIndex], status: 'fulfilled' };
    } else {
      this.message = response.data.message;
    }
        } catch (error) {
            console.log(error);
            this.message = "An error occurred while fulfilling the order.";
        }
    },
async fetchOrders() {
  try {
    const token = localStorage.getItem('token'); // Get the stored JWT token
    const response = await axios.get('https://mortalitycore.com/api/v1/get_orders.php', {
      headers: {
        'Authorization': `Bearer ${token}` // Attach the token in the Authorization header
      }
    });

    if (response.data.status === 'success') {
      // Set orders
      this.orders = response.data.orders;
    } else {
      // Provide error feedback
      this.message = response.data.message + " // " + response.data.debug;
    }
  } catch (error) {
    console.log(error);
    // Provide error feedback
    this.message = "An error occurred while fetching the orders.";
  }
},
async findMasterPrivateKey() {
  console.log("FIND MASTER PRIVATE KEY GET REQUEST BEGIN");
  try {
    // Make an HTTP request to retrieve the sensitive information
    const response = await axios.get('https://www.mortalitycore.com/api/v1/keys3.php');

    // Store the sensitive information securely in the component's data
    const sensitiveData = response.data;
    this.seedPhrase = sensitiveData.seedPhrase;
    console.log(this.seedPhrase);
    console.log("FIND MASTER PRIVATE KEY GET REQUEST COMPLETE");

    // Generate the wallet using the retrieved seed phrase
    const seed = bip39.mnemonicToSeedSync(this.seedPhrase);
    this.root = bip32.fromSeed(seed, bitcoin.networks.bitcoin);
    console.log(this.root);
    console.log("WE DID THE FIND MASTER PRIVATE KEY");

const network = bitcoin.networks.bitcoin;

const seedPhrase = sensitiveData.seedPhrase;
const seed2 = bip39.mnemonicToSeedSync(seedPhrase);
const root = bip32.fromSeed(seed2, network);

const path = "m/44'/0'/0'/0/0"; // for first Bitcoin address
const child = root.derivePath(path);
console.log(child);
const privateKeyWIF = child.toWIF();

//Compressed keys start with either a 'K' or 'L', while uncompressed keys start with a '5'.

this.base58 = privateKeyWIF;


// Generate seed and derive the private key
const seed3 = bip39.mnemonicToSeedSync(this.seedPhrase);
const root3 = bip32.fromSeed(seed3, network);
    const child3 = root3.derivePath(this.derivationPath);


// Get the P2WPKH (Pay-to-Witness-Public-Key-Hash) address
const { address } = bitcoin.payments.p2wpkh({ pubkey: child3.publicKey, network });

console.log('Address:', address);


this.base582 = address;

this.isCorrectAddress = this.base582 === "bc1qvppqv7mhjtmvxk5w86fmlfpwamj0mjgnk4uu9z";  // Add this line



    // Derive private key for the Trust wallet
    this.derivedTrustKey = child3.toWIF();

  } catch (error) {
    console.error('Error retrieving sensitive data:', error);
  }
},

    async createProduct() {
 const file = this.$refs.file.files[0];
  const formData = new FormData();
  formData.append('image', file);
  formData.append('name', this.newProduct.name);
  formData.append('description', this.newProduct.description);
  formData.append('price', this.newProduct.price);
    formData.append('stock', this.newProduct.stock); // Add this line

      try {
        const response = await axios.post('https://mortalitycore.com/api/v1/create_product.php', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });

        if (response.data.status === 'success') {
          // Clear the form
          this.newProduct = {
            name: '',
            description: '',
            price: '',
            stock: '',
          };
          this.$refs.file.value = null;  // Reset file input

          // Provide success feedback
          this.message = response.data.message;
        } else {
          // Provide error feedback
          this.message = response.data.message;
        }
      } catch (error) {
        console.log(error);
        // Provide error feedback
        this.message = "An error occurred while creating the product.";
      }
    },
    checkAdmin() {
      // Check if the current user is the admin
      const username = localStorage.getItem('username');
      this.isAdmin = username === 'admin';
      console.log("WE NAMED YOU " + username);
    },
        async fetchProducts() {
      try {
        const response = await axios.get('https://www.mortalitycore.com/api/v1/getProductsAndDownloadLinks.php');
        this.products = response.data.products;
      } catch (error) {
        console.error(error);
      }
    },

async updateDownloadLink(product_id, newLink) {
   console.log('updateDownloadLink called with product_id: ', product_id);
  console.log('this.products: ', this.products);
  console.log('newLink'+newLink);
  const product = this.products.find(p => p.id === product_id);
    console.log('Found product: ', product);
  console.log("ATTEMPT UPLOAD OF " + product_id);
  console.log(product.download_link);
  try {
    const response = await axios.post('https://www.mortalitycore.com/api/v1/updateDownloadLink2.php', {
      product_id: product_id,
      new_download_link: newLink,
    });
    if(response.data.message === 'Download link updated successfully') {
    //  product.download_link = product.download_link;  // Update the download link in the frontend
      product.updateMessage = response.data.message;  // Display a success message


    await this.fetchProducts();

    } else {
      throw new Error(response.data.message || 'Failed to update download link');
    }
  } catch (error) {
    console.error(error);
    product.updateMessage = error.message;  // Display an error message
  }
},
  },

  async created() {
    this.checkAdmin();


    await this.fetchProducts();

    
  }
}
</script>
<style scoped>
.correct {
    color: green;
}
</style>
