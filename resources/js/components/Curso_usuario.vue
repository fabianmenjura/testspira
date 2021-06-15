
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
              <label for="name">Seleccione estudiante </label>
              <select v-model="curso_usuario.usuario_id">
                <option v-for="usu in usuarios" :key="usu.id" :value="usu.id">
                  {{ usu.name }} {{ usu.last_name }}
                </option>
              </select>
            </div>
               <div class="my-4">
              <label for="descripcion">Nombre del Curso</label>
              <select v-model="curso_usuario.course_id">
              <option v-for="cour in courses" :key="cour.id" :value="cour.id">{{ cour.name_course }}</option>
              </select>
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
    <div class="card border-primary mb-12">
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
              <th scope="col">#</th>
              <th scope="col">ID</th>
              <th scope="col">Estudiante</th>
              <th scope="col">Curso</th>
              <th scope="col">Intensidad</th>
              <th scope="col" colspan="2" class="text-center">Accion</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="cur_us in curso_usuarios" :key="cur_us.id">
              <th scope="row">{{ cur_us.id }}</th>
              <td>{{ cur_us.usuario_id }}</td>
              <td>{{ cur_us.name }}{{ cur_us.last_name }}</td>
              <td>{{ cur_us.name_course }}</td>
              <td>{{ cur_us.intensidad }}</td>

              <td>
                <button
                  @click="
                    modificar = true;
                    abrirModal(cur_us);
                  "
                  class="btn btn-warning"
                >
                  Editar
                </button>
              </td>
              <td>
                <button @click="eliminar(cur_us.id)" class="btn btn-danger">
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
      curso_usuario: {
        id: 1,
        usuario_id: '',
        course_id: "",
      },
      usuario: {
        id: 1,
        name: "",
        last_name: "",
        phone_number: "",
        email: "",
      },
      course:{
        id:"",
        name_curso:"",
        intensidad:1,
      },
      modificar: true,
      modal: 0,
      tituloModal: "",
      curso_usuarios: [],
      usuarios: [],
      courses: [],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get("/curso_usuarios");
      this.curso_usuarios = res.data;
    },
    async listarUsuarios() {
      const res = await axios.get("/usuarios");
      this.usuarios = res.data;
      //console.log(this.usuarios);
    },
    async listarCursos() {
      const res = await axios.get("/courses");
      this.courses = res.data;
    },
    async eliminar(id) {
      const res = await axios.delete("/curso_usuarios/" + id);
      this.listar();
    },
    async guardar() {
      if (this.modificar) {
        const res = await axios.put("/curso_usuarios/" + this.id, this.curso_usuario);
        // console.log(this.id);
      } else {
        const res = await axios.post("/curso_usuarios/", this.curso_usuario);
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data = {}) {
      this.modal = 1;
      if (this.modificar) {

        this.id = data.id;
        this.tituloModal = "Modificar";
        this.curso_usuario.usuario_id = data.usuario_id;
        this.curso_usuario.course_id = data.course_id;

      } else {
        this.id = 0;
        this.tituloModal = "Asignar curso";
        this.curso_usuario.usuario_id = "";
        this.curso_usuario.course_id = "";

      }
    },
    cerrarModal() {
      this.modal = 0;
    },
  },
  created() {
    this.listar();
    this.listarUsuarios();
    this.listarCursos();
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
