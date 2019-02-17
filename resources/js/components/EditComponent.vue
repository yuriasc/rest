<template>
<div class="container col-md-6">
  <div>
    <h1 class="text-center">Editar Notícia</h1>
    <form @submit.prevent="updatePost">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Título:</label>
            <input type="text" class="form-control" v-model="post.titulo">
          </div>
        </div>
        <!-- <div class="col-md-8">
          <div class="form-group">
            <label>Autor:</label>
            <input type="text" class="form-control" v-model="post.autor">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Data:</label>
            <input type="text" class="form-control" v-mask="'##/##/####'" v-model="post.data">
          </div>
        </div> -->
      </div>
      <!-- <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Notícia:</label>
            <textarea class="form-control" v-model="post.noticia" rows="5"></textarea>
          </div>
        </div>
      </div> -->
      <br />
      <div class="form-group">
        <button class="btn btn-primary">Editar</button>
      </div>
    </form>
  </div>
</div>
</template>

<script>
    export default {

      data() {
        return {
          post: {}
        }
      },
      created() {
        let uri = `http://localhost/api/post/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
          this.post = response.data;
        });
      },
      methods: {
        updatePost() {
          let uri = `http://localhost/api/post/update/${this.$route.params.id}/${this.post.titulo}`;
          console.log(encodeURI(uri))
          this.axios.put(encodeURI(uri), this.post).then((response) => {
            //this.$router.push({name: 'posts'});
          });
        }
      }
    }
</script>
