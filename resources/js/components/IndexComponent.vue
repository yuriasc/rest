<template>
  <div>
    <h1>Posts</h1>
      <div class="row">
        <div class="col-md-10"></div>
      <div class="col-md-2">
        <router-link :to="{ name: 'create' }" class="btn btn-primary">Nova Notícia</router-link>
      </div>
    </div><br />

    <table class="table table-hover">
      <thead>
      <tr>
        <th>ID</th>
        <th>Autor</th>
        <th>Titulo</th>
        <th>Data</th>
        <th>Noticia</th>
        <th>Ações</th>
      </tr>
      </thead>
      <tbody>
        <tr v-for="(post, index) in posts" :key="post.id">
          <td>{{ ++index }}</td>
          <td>{{ post.autor }}</td>
          <td>{{ post.titulo }}</td>
          <td>{{ post.data }}</td>
          <td>{{ post.noticia }}</td>
          <td>
            <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-primary">Edit</router-link>
            <button class="btn btn-danger" @click = "deletePost(post.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
      data() {
        return {
          posts: []
        }
      },
      created() {
      let uri = 'http://localhost/api/posts';
      this.axios.get(uri).then(response => {
        this.posts = response.data.data;
      });
    },
    methods: {
      deletePost(id)
      {
        let uri = `http://localhost/api/post/delete/${id}`;
        this.axios.delete(uri).then(response => {
          this.posts.splice(this.posts.indexOf(id), 1);
        });
      }
    }
  }
</script>
