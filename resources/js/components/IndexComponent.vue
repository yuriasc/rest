<template>
  <div>
    <h1>Notícias</h1>
      <div class="row">
        <div class="col-md-2">
          <router-link :to="{ name: 'create' }" class="btn btn-primary btn-sm">Nova Notícia</router-link>
        </div>
      </div>
    <br />

    <table class="table table-hover">
      <thead>
      <tr>
        <th>#</th>
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
          <td>{{ post.data | moment }}</td>
          <td style="width: 50%">{{ post.noticia }}</td>
          <td>
            <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-primary btn-sm">Edit</router-link>
            <button class="btn btn-danger btn-sm" @click = "deletePost(post.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  import moment from 'moment';

  export default {
    data() {
        return {
          posts: []
        }
      },
      created() {
      let uri = path + '/api/posts';
      this.axios.get(uri).then(response => {
        this.posts = response.data.data;
      });
    },
    filters: {
      moment: function (date) {
        return moment(date).format('DD/MM/YYYY');
      }
    },
    methods: {
      deletePost(id)
      {
        let uri = `${path}/api/post/delete/${id}`;
        this.axios.delete(uri).then(response => {
          this.posts.splice(this.posts.indexOf(id), 1);
        });
      }
    }
  }
</script>
