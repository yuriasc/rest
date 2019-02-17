<template>
<div class="container col-md-6">
  <div>
    <h1 class="text-center">Nova Notícia</h1>
    <form @submit.prevent="addPost">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Título:</label>
            <input type="text" class="form-control" v-model="post.titulo">
          </div>
        </div>
        <div class="col-md-8">
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
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Notícia:</label>
            <textarea class="form-control" v-model="post.noticia" rows="5"></textarea>
          </div>
        </div>
      </div><br />
      <div class="form-group">
        <button class="btn btn-primary">Salvar</button>
      </div>
    </form>
  </div>
</div>
</template>

<script>
  export default {
    data(){
      return {
        post:{}
      }
    },
    methods: {
      addPost(){
        let uri = 'http://localhost/api/post/create';
        this.axios.post(uri, this.post)
        .then((response) => {
          console.log('success')
          console.log(response)

          alert('Noticia Cadastrada com sucesso')
          //this.$router.push({name: 'posts'});
        })
        .catch((error) => {
          console.log('error')
          console.log(error.response.data.error)
          alert(error.response.data.error)
        });
      }
    }
  }
</script>
