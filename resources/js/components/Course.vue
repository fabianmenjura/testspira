
<template>
  <div>
    <hr />

    <!-- Button to Open the Modal -->


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
              <label for="name_course">Nombre</label>
              <input
                v-model="course.name_course"
                type="text"
                class="form-control"
                id="name_course"
                placeholder="Nombre"
              />
            </div>
            <div class="my-4">
              <label for="intensidad">Intensidad</label>
              <input
                v-model="course.intensidad"
                type="text"
                class="form-control"
                id="intensidad"
                placeholder="Intensidad"
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
          <th scope="col">Nombre</th>
          <th scope="col">Intensidad</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cou in courses" :key="cou.id">
          <th scope="row">{{ cou.id }}</th>
          <td>{{ cou.name_course }}</td>
          <td>{{ cou.intensidad }}</td>

          <td>
            <button
              @click="
                modificar = true;
                abrirModal(cou);
              "
              class="btn btn-warning"
            >
              Editar
            </button>
          </td>
          <td>
            <button @click="eliminar(cou.id)" class="btn btn-danger">
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
      course: {
        name_course: "",
        intensidad: "",
      },
      modificar: true,
      modal: 0,
      tituloModal: "",
      courses: [],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get("/courses");
      this.courses = res.data;
    },
    async eliminar(id) {
      const res = await axios.delete("/courses/" + id);
      this.listar();
    },
    async guardar() {
      if (this.modificar) {
        const res = await axios.put("/courses/" + this.id, this.course);
        // console.log(this.id);
      } else {
        const res = await axios.post("/courses/", this.course);
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data = {}) {
      this.modal = 1;
      if (this.modificar) {
        this.listar();
        this.id = data.id;
        this.tituloModal = "Modificar curso";
        this.course.id = data.id;
        this.course.name_course = data.name_course;
        this.course.intensidad = data.intensidad;
      } else {
        this.id = 0;
        this.tituloModal = "Crear curso";
        this.course.name_course = "";
        this.course.intensidad = "";
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
