<template>
<div>
    <div>
        <h1>Tools Page</h1>
    </div>

       <div v-if="isAdmin">
        <h2>Image Cropper Tool</h2>

        <form @submit.prevent="cropImage" enctype="multipart/form-data">
          <div
            id="drag-area"
            @dragover.prevent="dragOver"
            @dragenter.prevent="dragEnter"
            @dragleave.prevent="dragLeave"
            @drop.prevent="dragDrop"
          >
            <label for="image">Drag & Drop to Upload Your Image</label>
            <input id="image" type="file" ref="file" @change="handleFileChange" required hidden>
            <button type="button" onclick="document.getElementById('image').click()">Or Select a File</button>
          </div>

          <label for="name">Image Name:</label>
          <input id="name" v-model="newImage.name" required><br>

          <label for="auto-crop">Auto-crop:</label>
          <input id="auto-crop" type="checkbox" v-model="newImage.autoCrop"><br>

          <button type="submit">Crop Image</button>
          <div v-if="message">{{ message }}</div>
        </form>
        <div>
            <!--<button @click="getImages">Display Images</button>//-->
              <div class="grid-container">
    <div class="item" v-for="image in images" :key="image.name" style="position: relative;">
        <img class="item-image" :src="image.image_url" :alt="image.name">
<div class="delete-button" @click.stop="deleteImage(image)">X</div>

    </div>
</div>

        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
export default {
    
  name: 'ToolsPage',
  data() {
  return {
   newImage: {
        name: '',
        autoCrop: false,  // Default to not auto-cropping
      },
      message: '', // New property for feedback
      isAdmin: false,
      images: [],
  }
    },
     watch: {
    '$route': 'checkAdmin'
  },
  
     created() {
    this.checkAdmin();



    
  },
    methods: {
       dragOver() {},
    dragEnter() {
      document.getElementById('drag-area').classList.add('active');
    },
    dragLeave() {
      document.getElementById('drag-area').classList.remove('active');
    },
    dragDrop(e) {
      document.getElementById('drag-area').classList.remove('active');
      this.uploadFile(e.dataTransfer.files[0]);
    },
uploadFile(file) {
  let dt = new DataTransfer();
  dt.items.add(file);
  this.$refs.file.files = dt.files;
  let filename = file.name;
  let nameWithoutExt = filename.substring(0, filename.lastIndexOf('.'));
  this.newImage.name = nameWithoutExt;

  this.handleFileChange({ target: this.$refs.file });
},


async deleteImage(image) {

    console.log(image);
    console.log(image.id);
    console.log("DELETE IMAGE ");
    try {
        const response = await axios.delete('https://mortalitycore.com/api/v1/delete_image.php', {
            data: { id: image.id },  // Change this line to send the image id instead of the name
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
        });

        if (response.data.status === 'success') {
            console.log("DELETE IMAGE SUCCESS");
            this.images = this.images.filter(i => i.id !== image.id);  // And this line to filter by id instead of name
        } else {
            console.error(response.data.message);
        }
    } catch (error) {
        console.error(error);
    }
},
         async getImages() {
      const response = await axios.get('https://mortalitycore.com/api/v1/get_images.php');
      if (response.data.status === 'success') {
        this.images = response.data.images;
      } else {
        console.error(response.data.message);
      }
    },
   async cropImage() {
    console.log("CROP BEGIN");
      const file = this.$refs.file.files[0];
      const formData = new FormData();
      formData.append('image', file);
      formData.append('name', this.newImage.name);
      formData.append('autoCrop', this.newImage.autoCrop);  // Add this line

console.log("DO WE CROPPO" +this.newImage.autoCrop);
 // Check if an image with the same name already exists
  if (this.images.some(image => image.name === this.newImage.name)) {
    this.message = "An image with this name already exists. Please choose a different name.";
    return;
  }

    try {
        const response = await axios.post('https://mortalitycore.com/api/v1/crop_image.php', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });

        if (response.data.status === 'success') {
          // Clear the form
          
    console.log("CROP COMPLETE");
          this.newImage  = {
            name: '',
            autoCrop: false,
          };
          this.$refs.file.value = null;  // Reset file input

          // Provide success feedback
          this.message = response.data.message;
          this.getImages();
        } else {
          // Provide error feedback
          
    console.log("CROP FAAAIL");
          this.message = response.data.message;
        }
      } catch (error) {
        console.log(error);
        // Provide error feedback
        this.message = "An error occurred while cropping the image.";
      }
    },
      handleFileChange(e) {
    if (e.target.files[0]) {
      let filename = e.target.files[0].name;
      let nameWithoutExt = filename.substring(0, filename.lastIndexOf('.'));
      this.newImage.name = nameWithoutExt;
    }
  },
          checkAdmin() {
      // Check if the current user is the admin
      const username = localStorage.getItem('username');
      this.isAdmin = username === 'admin';
      console.log("WE NAMED YOU " + username);
      
    this.getImages(); // Add this line
    },
        clickHandler() {
            alert('Button clicked in the Tools page!')
        }
    }
}
</script>
<style scoped>
.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 20px;
  padding: 10px; 
  background-color: #1a1a1a; 
  border-radius: 20px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
}

.item {
  border: 1px solid #4a4a4a;
  padding: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #555555;
  border-radius: 10px; 
  transition: transform .2s;
  overflow: hidden;
}

.item:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
  border-color: #888;
}
.delete-button {
  position: absolute;
  top: 0;
  right: 0;
  background: #ff0000;
  color: #ffffff;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  cursor: pointer;
  transition: background 0.3s;
}

.delete-button:hover {
  background: #cc0000;
}

.item-image {
  max-width: 200px;  /* maximum width */
  max-height: 200px;  /* maximum height */
  width: auto;
  height: auto;
  object-fit: contain;  /* ensures that the image maintains its aspect ratio */
  transition: transform .2s;
}


.item:hover .item-image {
  transform: scale(1.1);
}
#drag-area {
  border: 2px dashed #aaa;
  padding: 20px;
  text-align: center;
}

#drag-area.active {
  border-color: #66c2a5;
}

</style>