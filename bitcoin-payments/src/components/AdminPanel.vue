
<template>
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
  
    <p v-if="messageTFZ">{{ messageTFZ }}</p>
  </div>
      <h2>Review Orders</h2>
    <button @click="fetchOrders">Fetch Orders</button>

<ul>
    <li v-for="order in orders" :key="order.order_id">
      <h3>Order {{ order.order_id }}</h3>
      <p>Customer: {{ order.customer }}</p>
      <p>Total: {{ order.total }} btc </p>
      <p>Status: {{ order.status }}</p> 
 <button v-if="order.status !== 'fulfilled'" @click="fulfillOrder(order.order_id)">Fulfill Order</button>
    <button @click="deleteOrder(order.order_id)">Delete Order</button>


      <ul>
        <li v-for="item in order.items" :key="item.product_id"> 
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

    <label for="change_address">Change Address:</label> 
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
global.Buffer = Buffer; 
const bitcoin = require('bitcoinjs-lib');
const bip39 = require('bip39');
const bip32 = require('bip32');

export default {
  name: 'AdminPanel',
  data() {
    return {
      products: [],
       transferTFZ: {
        address: '',
        changeAddress: '', 
      },
        messageTFZ: '', 
      totalUnspentFunds: 0,
  transaction: {
        txhash: '09cdf430f9a0eb5ed65f27314a6f70453a8e6c9e41596d9553f8b042a740e996',
        vout: '0',
        blockhash: '0000000000000000000363756ee8e3aec856f6324bbc1b85fa6c80557f28736b',
      },
transactionMessage: '',
    derivationPath: "m/84'/0'/0'/0/0",
    transactionData: null,  
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
        stock: '',
      },
      message: '', 
      orders: [], 
      wallet: {
  address: '',
        addressToImport: '',
},
walletMessage: '', 

      importWalletMessage: '', 
    transfer: {
      address: 'bc1qaqtyxnxetxttnuem7d5arwmwka7tk9hhyf6uew',
        changeAddress: 'bc1qaqtyxnxetxttnuem7d5arwmwka7tk9hhyf6uew',
      amount: '0.00004713',
    },
    transferMessage: '', 
    }
  },
  methods: {
    async transferFundsZero() {
  const userConfirmation = window.confirm("Are you sure you want to transfer funds? This action cannot be undone.");
  if (!userConfirmation) {
    return;  
  }

  const { privateKey, address } = await this.deriveKeyAndAddressForUserID(0);

  const token = localStorage.getItem('token');
  if (!token) {
    console.error('No token found in local storage');
    return;
  }


  const transferData = {
    privateKey: privateKey,
    sourceAddress: address,
    destinationAddress: this.transfer.address,
    changeAddress: this.transfer.changeAddress,
  };

  const transferResponse = await axios.post('https://mortalitycore.com/api/v1/zero_transfer.php', transferData, {
    headers: {
      'Authorization': `Bearer ${token}`
    }
  });


  if (transferResponse.data.status === 'success') {
    this.messageTFZ = transferResponse.data.message + "//ID:"+transferResponse.data.txid;
  } else {
    this.messageTFZ = transferResponse.data.message;
  }
},  

     async encodeBase58() {
  try {
    const response = await axios.post('https://mortalitycore.com/api/v1/base58_encode.php', {
      string: this.input.value,
    });

    if (response.data.encoded_string) { 

      this.encodedValue = response.data.encoded_string; 

      this.input.value = '';

    } else {
      console.log(response.data.error);
    }
  } catch (error) {
    console.error('Error encoding value:', error);
  }
},
async encodeBase58Check() {
  try {
    const response = await axios.post('https://mortalitycore.com/api/v1/base58check_encode.php', {
      private_key: this.inputCheck.valueCheck, 
    });

    if (response.data.wif) { 
   
      this.encodedValueCheck = response.data.wif; 

      this.input.valueCheck = '';
    } else {
  
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

  this.transactionData = response.data.data;


  this.transaction = {
    txhash: '',
    vout: '',
    blockhash: '',
  };


  this.transactionMessage = response.data.message;
} else {

  this.transactionMessage = response.data.message;
}

  } catch (error) {
    console.log(error);
    this.transactionMessage = "An error occurred while fetching the transaction information.";
  }
},
     deriveAddress() {
      this.derivedAddress = this.deriveRootWalletAddress(this.seedPhrase);
    },


  deriveRootWalletAddress(seedPhrase) {
    try {

    const network = bitcoin.networks.bitcoin;
const seed3 = bip39.mnemonicToSeedSync(seedPhrase);
const root3 = bip32.fromSeed(seed3, network);
    const child3 = root3.derivePath(this.derivationPath);

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
        'Content-Type': 'multipart/form-data'
    }
});


    if (response.data.status === 'success') {
      this.wallet.addressToImport = '';
      this.importWalletMessage = response.data.message;
    } else {

      this.importWalletMessage = response.data.message;
    }
  } catch (error) {
    console.log(error);

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
        'Content-Type': 'multipart/form-data' 
    }
});


    if (response.data.status === 'success') {
      this.wallet.address = '';
      this.walletMessage = response.data.message;
    } else {
      this.walletMessage = response.data.message;
    }
  } catch (error) {
    console.log(error);
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
    this.totalUnspentFunds = totalUnspentFunds;
  } catch (error) {
    console.error(error);
  }
},

  async transferFunds() {

const userConfirmation = window.confirm("Are you sure you want to transfer funds? This action cannot be undone.");
    if (!userConfirmation) {
      return;  
    }
  const response = await axios.get('https://www.mortalitycore.com/api/v1/getDepositAddresses.php');
  const depositData = response.data;

  let derivedKeysAddresses = [];

  for (let user of depositData) {

 const { privateKey, address } = await this.deriveKeyAndAddressForUserID(user.user_id);

   
    if (address !== user.deposit_address) {
      console.error(`Derived address for user ${user.user_id} does not match the one in the database.`);
      continue;
    }

    derivedKeysAddresses.push({
      derivedPrivateKey: privateKey,
      derivedAddress: address,
      user_id: user.user_id,
      deposit_address: user.deposit_address,
      amount: this.transfer.amount.toString(),  
      changeAddress: this.transfer.changeAddress
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


if (transferResponse.data.status === 'success') {

  this.transferMessage = transferResponse.data.message; 

} else {
  this.transferMessage = transferResponse.data.message;  
 
}

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
    const token = localStorage.getItem('token'); 
    const response = await axios.get('https://mortalitycore.com/api/v1/get_orders.php', {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });

    if (response.data.status === 'success') {

      this.orders = response.data.orders;
    } else {

      this.message = response.data.message + " // " + response.data.debug;
    }
  } catch (error) {
    console.log(error);

    this.message = "An error occurred while fetching the orders.";
  }
},
async findMasterPrivateKey() {
  try {

    const response = await axios.get('https://www.mortalitycore.com/api/v1/keys3.php');

    const sensitiveData = response.data;
    this.seedPhrase = sensitiveData.seedPhrase;

    const seed = bip39.mnemonicToSeedSync(this.seedPhrase);
    this.root = bip32.fromSeed(seed, bitcoin.networks.bitcoin);

const network = bitcoin.networks.bitcoin;

const seedPhrase = sensitiveData.seedPhrase;
const seed2 = bip39.mnemonicToSeedSync(seedPhrase);
const root = bip32.fromSeed(seed2, network);

const path = "m/44'/0'/0'/0/0"; 
const child = root.derivePath(path);

const privateKeyWIF = child.toWIF();


this.base58 = privateKeyWIF;


const seed3 = bip39.mnemonicToSeedSync(this.seedPhrase);
const root3 = bip32.fromSeed(seed3, network);
    const child3 = root3.derivePath(this.derivationPath);


const { address } = bitcoin.payments.p2wpkh({ pubkey: child3.publicKey, network });


this.base582 = address;

this.isCorrectAddress = this.base582 === "bc1qvppqv7mhjtmvxk5w86fmlfpwamj0mjgnk4uu9z"; // for testing


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
    formData.append('stock', this.newProduct.stock); 

      try {
        const response = await axios.post('https://mortalitycore.com/api/v1/create_product.php', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });

        if (response.data.status === 'success') {
          this.newProduct = {
            name: '',
            description: '',
            price: '',
            stock: '',
          };
          this.$refs.file.value = null; 

          this.message = response.data.message;
        } else {

          this.message = response.data.message;
        }
      } catch (error) {
        console.log(error);
        this.message = "An error occurred while creating the product.";
      }
    },
    checkAdmin() {
  
      const username = localStorage.getItem('username');
      this.isAdmin = username === 'admin';
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
  const product = this.products.find(p => p.id === product_id);
 
  try {
    const response = await axios.post('https://www.mortalitycore.com/api/v1/updateDownloadLink2.php', {
      product_id: product_id,
      new_download_link: newLink,
    });
    if(response.data.message === 'Download link updated successfully') {
  
      product.updateMessage = response.data.message; 


    await this.fetchProducts();

    } else {
      throw new Error(response.data.message || 'Failed to update download link');
    }
  } catch (error) {
    console.error(error);
    product.updateMessage = error.message; 
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
