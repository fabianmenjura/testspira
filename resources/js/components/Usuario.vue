
<template>
  <div>
    <hr />

    <!-- The Modal -->
    <div class="modal" :class="{ mostrar: modal }">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">{{ tituloModal }}</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="my-4">
              <label for="id">ID</label>
              <input
                v-model="usuario.id"
                type="number"
                class="form-control"
                id="id"
                placeholder="id"
              />
            </div>
            <div class="my-4">
              <label for="name">Nombre</label>
              <input
                v-model="usuario.name"
                type="text"
                class="form-control"
                id="name"
                placeholder="Nombre"
              />
            </div>
            <div class="my-4">
              <label for="last_name">Apellido</label>
              <input
                v-model="usuario.last_name"
                type="text"
                class="form-control"
                id="last_name"
                placeholder="Apellido"
              />
            </div>
            <div class="my-4">
              <label for="phone_number">Celular</label>
              <input
                v-model="usuario.phone_number"
                type="number"
                class="form-control"
                id="phone_number"
                placeholder="celular"
              />
            </div>
            <div class="my-4">
              <label for="email">Correo electrónico</label>
              <input
                v-model="usuario.email"
                type="text"
                class="form-control"
                id="email"
                placeholder="email"
              />
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              @click="guardar()"
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="card border-primary mb-12" >
      <div class="card-body">
        <!-- Button to Open the Modal -->
        <button
          @click="
            modificar = false;
            abrirModal();
          "
          type="button"
          class="btn btn-success my-4"
        >
          Nuevo
        </button>

        <table class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>
              <th scope="col">Celular</th>
              <th scope="col">Correo electrónico</th>

              <th scope="col" colspan="2" class="text-center">Accion</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="usu in usuarios" :key="usu.id">
              <th scope="row">{{ usu.id }}</th>
              <td>{{ usu.name }}</td>
              <td>{{ usu.last_name }}</td>
              <td>{{ usu.phone_number }}</td>
              <td>{{ usu.email }}</td>

              <td>
                <button
                  @click="
                    modificar = true;
                    abrirModal(usu);
                  "
                  class="btn btn-warning"
                >
                  Editar
                </button>
              </td>
              <td>
                <button @click="eliminar(usu.id)" class="btn btn-danger">
                  Eliminar
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>



<script>
export default {
  data() {
    return {
      usuario: {
        id: "",
        name: "",
        last_name: "",
        phone_number: "",
        email: "",
      },
      modificar: true,
      modal: 0,
      tituloModal: "",
      usuarios: [],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get("/usuarios");
      this.usuarios = res.data;
    },
    async eliminar(id) {
      const res = await axios.delete("/usuarios/" + id);
      this.listar();
    },
    async guardar() {
      if (this.modificar) {
        const res = await axios.put("/usuarios/" + this.id, this.usuario);
        // console.log(this.id);
      } else {
        const res = await axios.post("/usuarios/", this.usuario);
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data = {}) {
      this.modal = 1;
      if (this.modificar) {
        this.listar();
        this.id = data.id;
        this.tituloModal = "Modificar usuario";
        this.usuario.id = data.id;
        this.usuario.name = data.name;
        this.usuario.last_name = data.last_name;
        this.usuario.phone_number = data.phone_number;
        this.usuario.email = data.email;
      } else {
        this.id = 0;
        this.tituloModal = "Crear usuario";
        this.usuario.id = "";
        this.usuario.name = "";
        this.usuario.last_name = "";
        this.usuario.phone_number = "";
        this.usuario.email = "";
      }
    },
    cerrarModal() {
      this.modal = 0;
    },
  },
  created() {
    this.listar();
  },
};
</script>




<style>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(75, 56, 143, 0.705);
}
</style>
